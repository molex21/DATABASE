<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
<a class="CER" href="../index.html">Canela en Rama SL®</a>
    <div class="index">
    <h1> Inicio de sesión </h1>
    <?php if (isset($_SESSION['message'])): ?>
        <p class="red">
            <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
        </p>
    <?php endif; ?>
    <form class="caja" action="login.php" method="POST">
        <input type="text" name="user" placeholder="Usuario">
        <input type="password" name="pass" placeholder="Contraseña">
        <input class="but" type="submit" value="Enviar">
    </form> 
    </div> 
</body>
</html>