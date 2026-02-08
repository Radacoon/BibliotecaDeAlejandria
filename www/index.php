<?php 
session_start();
include 'db.php'; 

// Lógica de Eliminación
if (isset($_POST['eliminar_id']) && isset($_SESSION['user']) && $_SESSION['user'] === 'alex') {
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

        <div style="display: flex; gap: 12px; align-items: center;">
            <?php if (isset($_SESSION['user']) && $_SESSION['user'] === 'alex'): ?>
                <a href="registro.php" class="btn btn-success">Añadir Libro</a>
                <a href="reporte.php" class="btn btn-warning">Ver Reporte</a>
                <a href="logout.php" class="btn" style="background: #e74c3c; color: white;">Salir</a>
            <?php else: ?>
                <a href="login.php" class="btn btn-primary">Admin Login</a>
            <?php endif; ?>
        </div>
    </div>

    <?php if (isset($_GET['leer'])): ?>
        <div class="book-card" style="margin-bottom: 30px; border: 1px solid rgba(255,255,255,0.2);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                <h3 style="margin: 0;"><?= htmlspecialchars($_GET['leer']) ?></h3>
                <a href="index.php" class="btn btn-danger" style="text-decoration: none; padding: 5px 15px;">Cerrar Lector</a>
            </div>
            <iframe src="uploads/<?= htmlspecialchars($_GET['leer']) ?>" width="100%" height="600px" style="border: none; border-radius: 8px; background: #fff;"></iframe>
        </div>
    <?php endif; ?>

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
                    <a href="index.php?leer=<?= urlencode($l['archivo_pdf']) ?>" class="pdf-link">Leer Documento</a>
                    
                    <?php if (isset($_SESSION['user']) && $_SESSION['user'] === 'alex'): ?>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 10px;">
                            <a href="editar.php?id=<?= $l['id'] ?>" class="btn btn-warning" style="justify-content:center;">Modificar</a>
                            <form method="POST" onsubmit="return confirm('¿Deseas eliminar este registro?')">
                                <input type="hidden" name="eliminar_id" value="<?= $l['id'] ?>">
                                <button type="submit" class="btn btn-danger" style="width: 100%; justify-content:center;">Eliminar</button>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

</body>
</html>
