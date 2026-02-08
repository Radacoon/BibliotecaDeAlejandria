<?php
include 'auth.php';
include 'db.php'; 

// Consultas para el reporte
$total_res = mysqli_query($conn, "SELECT COUNT(*) as t FROM libros");
$total = mysqli_fetch_assoc($total_res)['t'];

$generos = mysqli_query($conn, "SELECT genero, COUNT(*) as c FROM libros GROUP BY genero");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Existencias | La Biblioteca de Alejandría</title>
    <link rel="stylesheet" href="css/style.css?v=<?= time(); ?>">
</head>
<body>

<div class="container">
    <div class="navbar">
        <h2>Archivos y Estadísticas</h2>
        <a href="index.php" class="btn btn-warning">Volver al Inicio</a>
    </div>

    <div class="book-grid" style="grid-template-columns: 1fr;">
        <div class="book-card" style="max-width: 700px; margin: 0 auto;">
            <h1 style="color: var(--primary); margin-top: 0; font-size: 2rem;">Resumen de la Biblioteca</h1>
            <hr style="border: 0; border-top: 1px solid var(--glass-border); margin: 20px 0;">

            <h3 style="color: white; font-weight: 400;">
                Total de libros registrados: <span style="color: var(--accent); font-weight: 700; font-size: 1.8rem;"><?= $total ?></span>
            </h3>

            <h4 style="color: var(--primary); text-transform: uppercase; letter-spacing: 1px; margin-top: 30px;">Libros por Género:</h4>
            
            <ul style="list-style: none; padding: 0; margin-bottom: 40px;">
                <?php while($g = mysqli_fetch_assoc($generos)): ?>
                    <li style="padding: 12px 0; border-bottom: 1px solid var(--glass-border); display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-weight: 400;"><?= htmlspecialchars($g['genero']) ?></span>
                        <span class="btn-primary" style="padding: 4px 12px; border-radius: 15px; font-size: 0.8rem; font-weight: 700;">
                            <?= $g['c'] ?> libros
                        </span>
                    </li>
                <?php endwhile; ?>
            </ul>

            <div style="display: flex; gap: 15px; justify-content: center;">
                <button onclick="window.print()" class="btn btn-success">Imprimir Reporte</button>
            </div>
        </div>
    </div>
</div>

</body>
</html>
