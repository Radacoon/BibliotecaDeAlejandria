<?php
session_start();
include 'db.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validación directa para Alex
    if ($usuario === 'alex' && $password === 'wasd') {
        $_SESSION['user'] = 'alex';
        header("Location: index.php");
        exit;
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Biblioteca</title>
    <link rel="stylesheet" href="css/style.css?v=<?= time(); ?>">
</head>
<body>
    <div class="container" style="max-width: 400px; margin-top: 100px;">
        <div class="book-card" style="padding: 30px;">
            <h2 style="text-align: center; margin-bottom: 20px;">Acceso Admin</h2>
            
            <?php if ($error): ?>
                <p style="color: #e74c3c; text-align: center;"><?= $error ?></p>
            <?php endif; ?>

            <form method="POST" style="display: flex; flex-direction: column; gap: 15px;">
                <input type="text" name="usuario" placeholder="Usuario" required 
                       style="padding: 10px; border-radius: 5px; border: 1px solid #ddd;">
                
                <input type="password" name="password" placeholder="Contraseña" required 
                       style="padding: 10px; border-radius: 5px; border: 1px solid #ddd;">
                
                <button type="submit" class="btn btn-primary" style="justify-content: center;">Entrar</button>
                <a href="index.php" style="text-align: center; font-size: 12px; color: var(--md-text);">Volver al Inicio</a>
            </form>
        </div>
    </div>
</body>
</html>
