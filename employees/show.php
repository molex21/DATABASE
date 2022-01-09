<?php declare(strict_types=1);

$conn = require "../database.php";

$stm = $conn->prepare("select * from employees where employeeNumber = :employeeNumber");
$stm->execute(array(':employeeNumber' => $_GET['employeeNumber']));

$employee = $stm->fetch();

$stm = null;
$conn = null;

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleado</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body class="t_empleados">
    <div class="caja4">
    <a href="list.php"><button class="button2">Atrás</button></a><br>
    <h1>Empleado</h1>
    <p class="importante">
        Nº Empleado: <?=$employee['employeeNumber'] ?>
    </p>
    <p>
        Apellido: <?=$employee['lastName'] ?>
    </p>
    <p>
        Nombre: <?=$employee['firstName'] ?>
    </p><p>
        Extensión: <?=$employee['extension'] ?>
    </p><p>
        Correo: <?=$employee['email'] ?>
    </p><p>
        Código de oficina: <?=$employee['officeCode'] ?>
    </p><p>
        Responsable: <?=$employee['reportsTo'] ?>
    </p><p>
        Titulo: <?=$employee['jobTitle'] ?>
    </p>
    <p>
        <a class="formbuts"  href="form.php?employeeNumber=<?=$employee['employeeNumber']?>">Modificar</a>
    </p>
    <p>
    <a  class="formbuts"  href="delete.php?employeeNumber=<?=$employee['employeeNumber']?>">Eliminar</a>
    </p>

</body>
</html>