<?php 
include 'db.php'; 

// Lógica de Eliminación
if (isset($_POST['eliminar_id'])) {
    $id = mysqli_real_escape_string($conn, $_POST['eliminar_id']);
    $res = mysqli_query($conn, "SELECT archivo_pdf FROM libros WHERE id=$id");
    $libro = mysqli_fetch_assoc($res);
    if ($libro) { unlink("uploads/" . $libro['archivo_pdf']); }
    mysqli_query($conn, "DELETE FROM libros WHERE id=$id");
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>La Biblioteca de Alejandría Online</title>
    <link rel="stylesheet" href="css/style.css?v=<?= time(); ?>">
</head>
<body>

<div class="container">
    <div class="navbar">
        <h2>La Biblioteca de Alejandría Online</h2>
        
        <form action="index.php" method="GET" class="search-box">
            <input type="text" name="q" placeholder="Buscar por título o autor..." 
                   value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>">
            <button type="submit" class="btn btn-primary">Buscar</button>
            <a href="index.php" class="btn" style="color: var(--md-text); font-size: 12px;">Limpiar</a>
        </form>

        <div style="display: flex; gap: 12px;">
            <a href="registro.php" class="btn btn-success">Añadir Libro</a>
            <a href="reporte.php" class="btn btn-warning">Ver Reporte</a>
        </div>
    </div>

    <div class="book-grid">
        <?php
        $q = isset($_GET['q']) ? mysqli_real_escape_string($conn, $_GET['q']) : '';
        $sql = "SELECT * FROM libros WHERE titulo LIKE '%$q%' OR autor LIKE '%$q%' ORDER BY id DESC";
        $res = mysqli_query($conn, $sql);

        while($l = mysqli_fetch_assoc($res)): ?>
            <div class="book-card">
                <div>
                    <h3><?= htmlspecialchars($l['titulo']) ?></h3>
                    <p><strong>Autor:</strong> <?= htmlspecialchars($l['autor']) ?></p>
                    <p><small>Género: <?= htmlspecialchars($l['genero']) ?></small></p>
                </div>
                
                <div style="margin-top: 25px;">
                    <a href="uploads/<?= $l['archivo_pdf'] ?>" target="_blank" class="pdf-link">Leer Documento</a>
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                        <a href="editar.php?id=<?= $l['id'] ?>" class="btn btn-warning" style="justify-content:center;">Modificar</a>
                        <form method="POST" onsubmit="return confirm('¿Deseas eliminar este registro?')">
                            <input type="hidden" name="eliminar_id" value="<?= $l['id'] ?>">
                            <button type="submit" class="btn btn-danger" style="width: 100%; justify-content:center;">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

</body>
</html>
