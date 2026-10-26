<?php
header('Content-Type: application/json');
include 'conexion.php';

$datos = json_decode(file_get_contents("php://input"), true);

if ($datos) {
    $nombre = $conexion->real_escape_string($datos['nombre']);
    $email = $conexion->real_escape_string($datos['email']);
    $telefono = $conexion->real_escape_string($datos['telefono']);
    $cantidad = intval($datos['cantidad']);
    $categoria = $conexion->real_escape_string($datos['categoria']);
    $modalidad = $conexion->real_escape_string($datos['modalidad']);
    
    $cupon = 'DON-AR-' . strtoupper(substr(uniqid(), -6));

    $sql_donante = "INSERT INTO donantes (nombre, email, telefono) VALUES ('$nombre', '$email', '$telefono')";
    
    if ($conexion->query($sql_donante) === TRUE) {
        $donante_id = $conexion->insert_id;

        $sql_donacion = "INSERT INTO donaciones (donante_id, codigo_cupon, cantidad_libros, categoria, estado, modalidad) 
                         VALUES ($donante_id, '$cupon', $cantidad, '$categoria', 'Pendiente', '$modalidad')";
        
        if ($conexion->query($sql_donacion) === TRUE) {
            echo json_encode(["success" => true, "cupon" => $cupon]);
        } else {
            echo json_encode(["success" => false, "error" => $conexion->error]);
        }
    } else {
        echo json_encode(["success" => false, "error" => $conexion->error]);
    }
}
$conexion->close();
?>