<?php
include 'auth.php';
include 'db.php'; 
$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $file = $_FILES['pdf'];

    if ($file['error'] !== UPLOAD_ERR_OK) {
        $errores = [
            1 => 'El archivo excede el límite de PHP.',
            2 => 'El archivo excede el límite del formulario.',
            3 => 'El archivo se subió parcialmente.',
            4 => 'No se subió ningún archivo.',
            6 => 'Falta la carpeta temporal.',
            7 => 'Error al escribir en el disco.',
        ];
        $msg = "Error de subida: " . ($errores[$file['error']] ?? 'Error desconocido');
    } else {
        $directorio_destino = __DIR__ . "/uploads/";
        $nombre_final = time() . "_" . basename($file['name']);
        $ruta_completa = $directorio_destino . $nombre_final;

        if (move_uploaded_file($file['tmp_name'], $ruta_completa)) {
            $titulo = mysqli_real_escape_string($conn, $_POST['titulo']);
            $autor = mysqli_real_escape_string($conn, $_POST['autor']);
            $genero = mysqli_real_escape_string($conn, $_POST['genero']);

            $sql = "INSERT INTO libros (titulo, autor, genero, archivo_pdf) 
                    VALUES ('$titulo', '$autor', '$genero', '$nombre_final')";
            mysqli_query($conn, $sql);
            header("Location: index.php");
            exit;
        } else {
            $msg = "Error crítico: Verifica que la carpeta uploads exista y tenga permisos.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Obra | La Biblioteca de Alejandría</title>
    <link rel="stylesheet" href="css/style.css?v=<?= time(); ?>">
</head>
<body>

<div class="container">
    <div class="navbar">
        <h2>Añadir a los Archivos</h2>
        <a href="index.php" class="btn btn-warning">Volver</a>
    </div>

    <div class="book-card" style="max-width: 500px; margin: 0 auto;">
        <form method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 20px;">
            <h2 style="text-align: center; color: var(--primary); margin-top: 0;">Registrar Libro</h2>
            
            <?php if($msg) echo "<p style='color: #ff6b6b; text-align: center; font-weight: bold;'>$msg</p>"; ?>

            <div>
                <label style="display: block; margin-bottom: 8px;">Título</label>
                <input type="text" name="titulo" class="search-box" style="width: 100%; box-sizing: border-box;" placeholder="Ej: El nombre de la rosa" required>
            </div>

            <div>
                <label style="display: block; margin-bottom: 8px;">Autor</label>
                <input type="text" name="autor" class="search-box" style="width: 100%; box-sizing: border-box;" placeholder="Ej: Umberto Eco" required>
            </div>

            <div>
                <label style="display: block; margin-bottom: 8px;">Género</label>
                <select name="genero" class="search-box" style="width: 100%; box-sizing: border-box; background: rgba(0,0,0,0.3);">
                    <option value="Ficción">Ficción</option>
                    <option value="Historia">Historia</option>
                    <option value="Educativo">Educativo</option>
                    <option value="Tecnología">Tecnología</option>
                </select>
            </div>

            <div>
                <label style="display: block; margin-bottom: 8px;">Archivo (PDF)</label>
                <input type="file" name="pdf" accept=".pdf" style="color: white; font-size: 0.8rem;" required>
            </div>

            <button type="submit" class="btn btn-success" style="width: 100%; justify-content: center; margin-top: 10px;">
                Guardar Libro
            </button>
        </form>
    </div>
</div>

</body>
</html>
