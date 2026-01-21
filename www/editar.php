<?php 
include 'db.php'; 

// Obtener datos actuales
$id = mysqli_real_escape_string($conn, $_GET['id']);
$res = mysqli_query($conn, "SELECT * FROM libros WHERE id=$id");
$l = mysqli_fetch_assoc($res);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $t = mysqli_real_escape_string($conn, $_POST['titulo']);
    $a = mysqli_real_escape_string($conn, $_POST['autor']);
    $g = mysqli_real_escape_string($conn, $_POST['genero']);

    $sql = "UPDATE libros SET titulo='$t', autor='$a', genero='$g' WHERE id=$id";
    mysqli_query($conn, $sql);
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Obra | La Biblioteca de Alejandría</title>
    <link rel="stylesheet" href="css/style.css?v=<?= time(); ?>">
</head>
<body>

<div class="container">
    <div class="navbar">
        <h2>Corrección de Archivos</h2>
        <a href="index.php" class="btn btn-warning">Cancelar</a>
    </div>

    <div class="book-card" style="max-width: 500px; margin: 0 auto;">
        <form method="POST" style="display: flex; flex-direction: column; gap: 20px;">
            <h2 style="text-align: center; color: var(--accent); margin-top: 0;">Modificar Datos</h2>
            
            <div>
                <label style="display: block; margin-bottom: 8px; color: var(--primary); font-weight: 700;">Título</label>
                <input type="text" name="titulo" class="search-box" style="width: 100%; box-sizing: border-box;" 
                       value="<?= htmlspecialchars($l['titulo']) ?>" required>
            </div>

            <div>
                <label style="display: block; margin-bottom: 8px; color: var(--primary); font-weight: 700;">Autor</label>
                <input type="text" name="autor" class="search-box" style="width: 100%; box-sizing: border-box;" 
                       value="<?= htmlspecialchars($l['autor']) ?>" required>
            </div>

            <div>
                <label style="display: block; margin-bottom: 8px; color: var(--primary); font-weight: 700;">Género</label>
                <select name="genero" class="search-box" style="width: 100%; box-sizing: border-box; background: rgba(0,0,0,0.3); color: white;">
                    <option value="Ficción" <?= $l['genero'] == 'Ficción' ? 'selected' : '' ?>>Ficción</option>
                    <option value="Historia" <?= $l['genero'] == 'Historia' ? 'selected' : '' ?>>Historia</option>
                    <option value="Educativo" <?= $l['genero'] == 'Educativo' ? 'selected' : '' ?>>Educativo</option>
                    <option value="Tecnología" <?= $l['genero'] == 'Tecnología' ? 'selected' : '' ?>>Tecnología</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success" style="width: 100%; justify-content: center; margin-top: 10px;">
                Actualizar Registro
            </button>
        </form>
    </div>
</div>

</body>
</html>
