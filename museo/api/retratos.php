<?php
/**
 * API del Museo de Retratos
 *
 *   GET  api/retratos.php
 *        -> { ok, salas: [...], retratos: [...] }
 *
 *   POST api/retratos.php   (cuerpo JSON)
 *        { "id": 3, "accion": "vista" | "like" | "unlike" }
 *        -> { ok, id, me_gusta, vistas }
 *
 *   POST api/retratos.php   (multipart/form-data, accion=crear)
 *        -> valida y guarda un nuevo retrato con imagen PNG/JPG.
 */
require_once __DIR__ . '/db.php';

try {
    $metodo = $_SERVER['REQUEST_METHOD'] ?? 'GET';

    if ($metodo === 'GET') {
        $salas = db()->query(
            'SELECT slug, nombre, descripcion FROM salas ORDER BY orden, id'
        )->fetchAll();

        $filas = db()->query(
            'SELECT r.id, s.slug AS sala, r.titulo, r.anio, r.tecnica, r.historia, r.imagen,
                    r.tipo, r.parametros, r.me_gusta, r.vistas
               FROM retratos r
               JOIN salas s ON s.id = r.sala_id
              WHERE r.activo = 1
              ORDER BY s.orden, r.orden, r.id'
        )->fetchAll();

        $retratos = array_map(function (array $f): array {
            $f['id']         = (int) $f['id'];
            $f['anio']       = (int) $f['anio'];
            $f['me_gusta']   = (int) $f['me_gusta'];
            $f['vistas']     = (int) $f['vistas'];
            $f['parametros'] = json_decode($f['parametros'], true) ?: [];
            return $f;
        }, $filas);

        responder(['ok' => true, 'salas' => $salas, 'retratos' => $retratos]);
    }

    if ($metodo === 'POST') {
        if (($_POST['accion'] ?? '') === 'crear') {
            $titulo   = is_string($_POST['titulo'] ?? null) ? trim($_POST['titulo']) : '';
            $anio     = filter_var($_POST['anio'] ?? null, FILTER_VALIDATE_INT);
            $tecnica  = is_string($_POST['tecnica'] ?? null) ? trim($_POST['tecnica']) : '';
            $historia = is_string($_POST['historia'] ?? null) ? trim($_POST['historia']) : '';
            $sala     = is_string($_POST['sala'] ?? null) ? $_POST['sala'] : '';

            if ($titulo === '' || mb_strlen($titulo, 'UTF-8') > 120
                || $tecnica === '' || mb_strlen($tecnica, 'UTF-8') > 120
                || $historia === '' || mb_strlen($historia, 'UTF-8') > 10000
                || $anio === false || $anio === null || $anio < 1 || $anio > 9999
                || !in_array($sala, ['realistas', 'bizarros'], true)) {
                responder(['ok' => false, 'error' => 'Completá los datos del retrato con valores válidos.'], 400);
            }

            $archivo = $_FILES['imagen'] ?? null;
            if (!is_array($archivo) || !isset($archivo['error'], $archivo['tmp_name'], $archivo['size'])
                || !is_string($archivo['tmp_name']) || !is_numeric($archivo['size'])) {
                responder(['ok' => false, 'error' => 'Seleccioná una imagen PNG o JPG.'], 400);
            }
            if ($archivo['error'] !== UPLOAD_ERR_OK) {
                $mensaje = $archivo['error'] === UPLOAD_ERR_INI_SIZE || $archivo['error'] === UPLOAD_ERR_FORM_SIZE
                    ? 'La imagen supera el tamaño máximo permitido.'
                    : 'No se pudo recibir la imagen. Volvé a seleccionarla e intentá de nuevo.';
                responder(['ok' => false, 'error' => $mensaje], 400);
            }
            if ($archivo['size'] < 1 || $archivo['size'] > 5 * 1024 * 1024 || !is_uploaded_file($archivo['tmp_name'])) {
                responder(['ok' => false, 'error' => 'La imagen debe pesar hasta 5 MB.'], 400);
            }

            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mime = $finfo->file($archivo['tmp_name']);
            $datosImagen = getimagesize($archivo['tmp_name']);
            $extensiones = ['image/jpeg' => 'jpg', 'image/png' => 'png'];
            if (!isset($extensiones[$mime]) || $datosImagen === false
                || $datosImagen['mime'] !== $mime
                || $datosImagen[0] < 1 || $datosImagen[1] < 1
                || $datosImagen[0] * $datosImagen[1] > 25000000) {
                responder(['ok' => false, 'error' => 'El archivo debe ser una imagen PNG o JPG válida de hasta 25 megapíxeles.'], 400);
            }

            $pdo = db();
            $selSala = $pdo->prepare('SELECT id FROM salas WHERE slug = ?');
            $selSala->execute([$sala]);
            $salaId = $selSala->fetchColumn();
            if (!$salaId) {
                responder(['ok' => false, 'error' => 'La sala seleccionada no existe.'], 400);
            }

            $directorio = __DIR__ . '/../uploads/retratos';
            if (!is_dir($directorio) || !is_writable($directorio)) {
                responder(['ok' => false, 'error' => 'La carpeta de imágenes no existe o no permite escritura.'], 500);
            }
            $nombreArchivo = bin2hex(random_bytes(16)) . '.' . $extensiones[$mime];
            $rutaArchivo = $directorio . '/' . $nombreArchivo;
            $rutaPublica = 'uploads/retratos/' . $nombreArchivo;
            if (!move_uploaded_file($archivo['tmp_name'], $rutaArchivo)) {
                responder(['ok' => false, 'error' => 'No se pudo guardar la imagen en el servidor.'], 500);
            }

            try {
                $orden = $pdo->prepare('SELECT COALESCE(MAX(orden), 0) + 1 FROM retratos WHERE sala_id = ?');
                $orden->execute([$salaId]);
                $insertar = $pdo->prepare(
                    'INSERT INTO retratos (sala_id, titulo, anio, tecnica, historia, tipo, parametros, imagen, orden)
                     VALUES (?, ?, ?, ?, ?, NULL, ?, ?, ?)'
                );
                $insertar->execute([
                    $salaId, $titulo, $anio, $tecnica, $historia, '{}', $rutaPublica, $orden->fetchColumn(),
                ]);
            } catch (PDOException $e) {
                unlink($rutaArchivo);
                throw $e;
            }

            responder(['ok' => true, 'id' => (int) $pdo->lastInsertId(), 'imagen' => $rutaPublica], 201);
        }

        $cuerpo = json_decode(file_get_contents('php://input'), true);
        if (!is_array($cuerpo)) {
            responder(['ok' => false, 'error' => 'El cuerpo de la solicitud no es válido.'], 400);
        }
        $id     = filter_var($cuerpo['id'] ?? null, FILTER_VALIDATE_INT);
        $accion = $cuerpo['accion'] ?? '';

        if ($id === false || $id === null || $id < 1) {
            responder(['ok' => false, 'error' => 'Id de retrato inválido.'], 400);
        }

        $consultas = [
            'vista'  => 'UPDATE retratos SET vistas = vistas + 1 WHERE id = ? AND activo = 1',
            'like'   => 'UPDATE retratos SET me_gusta = me_gusta + 1 WHERE id = ? AND activo = 1',
            'unlike' => 'UPDATE retratos SET me_gusta = GREATEST(me_gusta, 1) - 1 WHERE id = ? AND activo = 1',
        ];

        if (!isset($consultas[$accion])) {
            responder(['ok' => false, 'error' => 'Acción no válida.'], 400);
        }

        $upd = db()->prepare($consultas[$accion]);
        $upd->execute([$id]);

        $sel = db()->prepare('SELECT id, me_gusta, vistas FROM retratos WHERE id = ? AND activo = 1');
        $sel->execute([$id]);
        $fila = $sel->fetch();

        if (!$fila) {
            responder(['ok' => false, 'error' => 'El retrato no existe.'], 404);
        }

        responder([
            'ok'       => true,
            'id'       => (int) $fila['id'],
            'me_gusta' => (int) $fila['me_gusta'],
            'vistas'   => (int) $fila['vistas'],
        ]);
    }

    responder(['ok' => false, 'error' => 'Método no permitido.'], 405);

} catch (PDOException $e) {
    error_log('[museo] ' . $e->getMessage());
    responder([
        'ok'    => false,
        'error' => 'No se pudo conectar con la base de datos. Verificá que MySQL esté iniciado '
                 . 'en XAMPP y que hayas importado database/museo_retratos.sql en phpMyAdmin.',
    ], 500);
}
