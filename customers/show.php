<?php declare(strict_types=1);

$conn = require "../database.php";

$stm = $conn->prepare("select * from customers where customerNumber = :customerNumber");
$stm->execute(array(':customerNumber' => $_GET['customerNumber']));

$customer = $stm->fetch();

$stm = null;
$conn = null;

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cliente</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body class="t_clientes">
    
    <div class="caja4">
    <a href="list.php"><button class="button2">Atrás</button></a><br>
    <h1>Cliente</h1>
    <p class="importante">
    Nº cliente: <?=$customer['customerNumber'] ?>
    </p>
    <p>
    Nombre: <?=$customer['customerName'] ?>
    </p>
    <p>
    Apellido: <?=$customer['contactLastName'] ?>
    </p><p>
    Nombre: <?=$customer['contactFirstName'] ?>
    </p><p>
    Teléfono: <?=$customer['phone'] ?>
    </p><p>
    Dirección 1: <?=$customer['addressLine1'] ?>
    </p><p>
    Dirección 2: <?=$customer['addressLine2'] ?>
    </p><p>
    Ciudad: <?=$customer['city'] ?>
    </p>
    <p>
    Estado: <?=$customer['state'] ?>
    </p>
    <p>
    Cod. Postal: <?=$customer['postalCode'] ?>
    </p>
    <p>
    País: <?=$customer['country'] ?>
    </p>
    <p>
    Nº de representante venta: <?=$customer['salesRepEmployeeNumber'] ?>
    </p>
    <p>
    Límite de Crédito: <?=$customer['creditLimit'] ?>
    </p>
    <p>
        <a class="formbuts" href="form.php?customerNumber=<?=$customer['customerNumber']?>">Modificar</a>
    </p>
    <p>
         <a class="formbuts" href="delete.php?customerNumber=<?=$customer['customerNumber']?>">Eliminar</a>
    </p>
    </div>
</body>
</html>