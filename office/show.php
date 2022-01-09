<?php declare(strict_types=1);

$conn = require "../database.php";

$stm = $conn->prepare("select * from offices where officeCode = :officeCode");
$stm->execute(array(':officeCode' => $_GET['officeCode']));

$office = $stm->fetch();

$stm = null;
$conn = null;

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oficina</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body class="t_oficinas">
    <div class="caja4"> 
    <a href="list.php"><button class="button2">Atrás</button></a><br>   
    <h1>Oficina</h1>
    <p class="importante">
        Código de Oficina: <?=$office['officeCode'] ?>
    </p>
    <p>
        Ciudad: <?=$office['city'] ?>
    </p>
    <p>
        Teléfono: <?=$office['phone'] ?>
    </p><p>
        Dirección 1: <?=$office['addressLine1'] ?>
    </p><p>
        Dirección 2: <?=$office['addressLine2'] ?>
    </p><p>
        Estado: <?=$office['state'] ?>
    </p><p>
        País: <?=$office['country'] ?>
    </p><p>
        Código postal: <?=$office['postalCode'] ?>
    </p>
    <p>
        Territorio: <?=$office['territory'] ?>
    </p>
    <p>
    <a class="formbuts" href="form.php?officeCode=<?=$office['officeCode']?>">Modificar</a>
    </p>
    <p>
    <a class="formbuts" href="delete.php?officeCode=<?=$office['officeCode']?>">Eliminar</a>
    </p>

</body>
</html>