-- =====================================================
-- Museo de Retratos Páginas Abiertas
-- Base de datos para XAMPP (MySQL / MariaDB)
-- Importar desde phpMyAdmin: pestaña "Importar" > elegir este archivo
-- =====================================================

CREATE DATABASE IF NOT EXISTS museo_retratos
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE museo_retratos;

SET NAMES utf8mb4;

DROP TABLE IF EXISTS retratos;
DROP TABLE IF EXISTS salas;

-- Salas del museo (Sala I realistas, Sala II bizarros)
CREATE TABLE salas (
  id          INT UNSIGNED NOT NULL AUTO_INCREMENT,
  slug        VARCHAR(30)  NOT NULL,
  nombre      VARCHAR(80)  NOT NULL,
  descripcion TEXT         NOT NULL,
  orden       TINYINT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (id),
  UNIQUE KEY uq_salas_slug (slug)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Retratos. "tipo" solo se usa en los bizarros y "parametros" guarda
-- (en JSON) los colores y rasgos con los que se dibuja cada retrato en SVG.
CREATE TABLE retratos (
  id         INT UNSIGNED NOT NULL AUTO_INCREMENT,
  sala_id    INT UNSIGNED NOT NULL,
  titulo     VARCHAR(120) NOT NULL,
  anio       SMALLINT UNSIGNED NOT NULL,
  tecnica    VARCHAR(120) NOT NULL,
  historia   TEXT         NOT NULL,
  tipo       VARCHAR(30)  NULL,
  parametros JSON         NOT NULL,
  imagen     VARCHAR(255) NULL,
  me_gusta   INT UNSIGNED NOT NULL DEFAULT 0,
  vistas     INT UNSIGNED NOT NULL DEFAULT 0,
  orden      SMALLINT UNSIGNED NOT NULL DEFAULT 0,
  activo     TINYINT(1)   NOT NULL DEFAULT 1,
  creado_en  TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  KEY idx_retratos_sala (sala_id, orden),
  CONSTRAINT fk_retratos_sala FOREIGN KEY (sala_id) REFERENCES salas (id)
    ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------- Salas ----------
INSERT INTO salas (id, slug, nombre, descripcion, orden) VALUES
  (1, 'realistas', 'Sala I · Realistas', 'Sala I. Rostros que parecen salidos de la escuela de al lado: maestras, libreros, lectores y gente que le debe algo a un buen libro.', 1),
  (2, 'bizarros', 'Sala II · Bizarros', 'Sala II. Aquí los retratos perdieron la compostura: ojos de más, cabezas de libro, cafés con corona y un cactus muy educado.', 2);

-- ---------- Retratos ----------
INSERT INTO retratos (sala_id, titulo, anio, tecnica, historia, tipo, parametros, orden) VALUES
  (1, 'Elvira, la maestra de Susques', 1987, 'Óleo sobre tela de pizarrón', 'Dio clases durante cuarenta años en una escuela de tres aulas a 3.600 metros de altura. Dicen que nunca se quedó sin un cuento para el recreo, y que sus alumnos aprendieron a leer antes que a caminar con zapatillas.', NULL, '{"bg":["#6b7f5e","#2f3b2a"],"skin":"#d9a47c","hair":"bun","hairColor":"#8a8478","eye":"#4a2e17","cloth":"#2f4f6f","collar":{"type":"shirt","color":"#f4ead2"},"glasses":true,"mouth":"smile","age":0.8}', 1),
  (1, 'Don Anselmo, el librero', 1962, 'Óleo sobre lomo de enciclopedia', 'Atendió el mismo mostrador de la calle Corrientes durante medio siglo. Sabía de memoria dónde estaba cada libro y jamás vendió uno sin antes contar de qué se trataba.', NULL, '{"bg":["#8c5a3a","#3a2314"],"skin":"#e0b08a","hair":"tufts","hairColor":"#eeeae0","eye":"#3a4a5a","cloth":"#5a3a1f","collar":{"type":"shirt","color":"#d8c796"},"glasses":true,"beard":true,"mouth":"smile","age":1}', 2),
  (1, 'Lucía, lectora de la tarde', 2019, 'Acrílico sobre servilleta', 'Llega todos los días a las cuatro, pide un cortado y desaparece dentro de una novela. Ya nadie se anima a avisarle cuando se enfría el café.', NULL, '{"bg":["#c9a15a","#5a3d1a"],"skin":"#c98f68","hair":"long","hairColor":"#2b1b12","eye":"#4a2e17","cloth":"#2e5a44","collar":{"type":"round"},"mouth":"smile","age":0}', 3),
  (1, 'El gaucho pensativo', 1934, 'Óleo sobre cuero curtido', 'Cabalgó tres días para llegar a un pueblo con biblioteca. Se sentó, abrió un libro de poesía al revés y, según cuentan, igual lloró de emoción.', NULL, '{"bg":["#5b6b78","#1f2a33"],"skin":"#b97c55","hair":"tufts","hairColor":"#2a1a10","eye":"#2a1a0a","cloth":"#a5352b","collar":{"type":"poncho","color":"#f1d9a0"},"mustache":true,"hat":"#2a2018","mouth":"neutral","age":0.5}', 4),
  (1, 'Camila y su cuaderno', 2021, 'Témpera sobre hoja rayada', 'Escribió su primer cuento en una escuela rural a la que llegaron libros donados. El cuento se llama "La vaca que quería ser maestra".', NULL, '{"bg":["#a6c7b5","#3d6b57"],"skin":"#e2b08c","hair":"braids","hairColor":"#6b3b1c","eye":"#3a5a3a","cloth":"#e0a82e","collar":{"type":"round"},"mouth":"smile","age":0,"ribbon":"#d9456b"}', 5),
  (1, 'Marisol, barista de guardia', 2024, 'Óleo sobre granos de café', 'Molió el primer café del día durante diez años y recibió a cada donante con una sonrisa y un descuento del diez por ciento.', NULL, '{"bg":["#d9b27c","#6b4a2a"],"skin":"#9b6a4a","hair":"curly","hairColor":"#1d1410","eye":"#2a1a0a","cloth":"#3b2a22","collar":{"type":"scarf","color":"#d97706"},"mouth":"smile","age":0}', 6),
  (2, 'El Cíclope Lector', 1903, 'Óleo sobre página 404', 'Con un solo ojo lee el doble de rápido, o eso dice. Su único problema es que los libros de dos tomos le salen más caros.', 'cyclops', '{"bg":["#3d5a80","#1b2838"]}', 7),
  (2, 'Madame Tres Ojos', 1971, 'Collage de ilusiones ópticas', 'Con el tercer ojo lee el final antes de empezar el libro. Nunca la invitan a los clubes de lectura porque cuenta todo.', 'tresojos', '{"bg":["#ffd98a","#a8553a"]}', 8),
  (2, 'El Señor Libro', 1888, 'Tinta y marcapáginas sobre cartón', 'Nadie sabe si es el libro quien tiene cabeza de persona o la persona quien se convirtió en libro. Lo único cierto es que tiene un final sorprendente.', 'libro', '{"bg":["#2f6b5a","#12302a"]}', 9),
  (2, 'La Condesa de la Taza', 1999, 'Porcelana sobre porcelana', 'Ofrece una audiencia cada mañana a las ocho. Quien llega sin pedir un café recibe una mirada que enfría hasta el más caliente.', 'taza', '{"bg":["#b9a0d6","#4a2f6b"]}', 10),
  (2, 'Don Narizotas', 1756, 'Óleo sobre pañuelo', 'Huele un libro nuevo a tres cuadras de distancia. Su nariz fue declarada patrimonio olfativo de la librería.', 'narizotas', '{"bg":["#9bc4a6","#35604a"]}', 11),
  (2, 'El Búho Catedrático', 1945, 'Plumas y tiza sobre pizarra', 'Dicta cátedra de madrugada ante un público de polillas. Aprobó con diez a todos sus alumnos porque nadie preguntó nada.', 'buho', '{"bg":["#f2c572","#a2541c"]}', 12),
  (2, 'Cactus de la Quebrada', 2012, 'Óleo sobre poncho', 'Aguanta meses sin agua y igual se ríe. Su secreto: un buen libro cada sábado y un mate a la sombra.', 'cactus', '{"bg":["#8fd3e8","#2c6a8a"]}', 13),
  (2, 'La Derretida de Mediodía', 1983, 'Acuarela, demasiada agua', 'Posó para su retrato en pleno enero, a las dos de la tarde, sin ventilador. El pintor terminó la obra antes de que se la llevara el desagüe.', 'derretida', '{"bg":["#f4a259","#a1362b"]}', 14);
