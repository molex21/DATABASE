<?php declare(strict_types=1);
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: sesiones/form_login.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Opciones</title>
</head>
<body class="styles2">
<a href="sesiones/logout.php"> <button  class="button">Cerrar sesión </button></a>
<a class="CER" href="index.html">Canela en Rama SL®</a>
    <h1 class="caja2">
        <div>!Hola! <?=$_SESSION['user']?>, !Has iniciado sesión correctamente!</div><br>
            ¿A qué parte de Canela en Rama quieres acceder?
    </h1>


    <form class="opciones" action="customers/list.php">
    <button class="op1" >CLIENTES<br><img width="100px" height="100px" src="img/cliente.png" > </button>
    </form>
    <form class="opciones" action="office/list.php">
    <button class="op2" >OFICINAS<br><img width="100px" height="100px" src="img/office.png"> </button>
    </form>
    <form class="opciones" action="employees/list.php">
    <button class="op3" >EMPLEADOS<br><img width="100px" height="100px" src="img/empleado.png" > </button>
    </form>
    
</body>
</html>