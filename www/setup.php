<?php
include 'db.php';

mysqli_query($conn, "DROP TABLE IF EXISTS libros");

$sql = "CREATE TABLE libros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    autor VARCHAR(255) NOT NULL,
    genero VARCHAR(100) NOT NULL,
    fecha_publicacion DATE,
    archivo_pdf VARCHAR(255),
    UNIQUE(titulo, autor)
) ENGINE=InnoDB;";

if (mysqli_query($conn, $sql)) {
    echo "Estructura actualizada";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
