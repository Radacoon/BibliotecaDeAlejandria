<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'alex') {

    die("<div style='text-align:center; margin-top:100px; font-family:sans-serif; color:#fff; background:#1a1a1a; height:100vh; padding-top:50px;'>
            <h1 style='color:#e74c3c;'>ACCESO DENEGADO</h1>
            <p>Debes iniciar sesión como administrador para ver esta sección.</p>
            <a href='login.php' style='color:#3498db; text-decoration:none;'>Ir al Login</a>
         </div>");
}
?>
