<?php declare(strict_types=1);

$conn = require "../database.php";

$stm = $conn->query("select * from customers order by customerNumber");
$stm->execute();
$customers = $stm->fetchAll();

$stm = null;
$conn = null;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body class="t_clientes" style="font-size:<?= isset($_COOKIE['style']['size'])? $_COOKIE['style']['size'] : '16'?>px">  
<h1 class="caja3">Listado de Clientes</h1>

<a href="form.php"><button class="button">Nuevo Cliente</button></a>
<a href="../opciones.php"><button  class="button2">Atrás</button></a><br><br>
<a href="default.php"><button  class="button2">Reestablecer tamaño de letra</button></a>
<a href="form_font.php"><button class="button">Cambiar Tamaño de Letra</button></a><br><br><br>


    <table>
        <tr class="uppercase">
            <th>Nº CLIENTE</th><th>NOMBRE EMPRESA</th><th>APELLIDO</th><th>NOMBRE REPRESENTANTE</th><th>Teléfono</th><th>Dirección 1</th><th>Dirección 2</th><th>Ciudad</th><th>Estado</th><th>Cod. Postal</th><th>País</th><th>Nº de representante venta</th><th>Límite de Crédito</th>
        </tr>

        <?php foreach($customers as $customer): ?>
            <tr> 
                <th>
                    <a class="a" href="show.php?customerNumber=<?=$customer['customerNumber']?>">
                        <?=$customer['customerNumber']?>
                    </a>
                </th>
                <td><?=$customer['customerName']?></td>
                <td><?=$customer['contactLastName']?></td>
                <td><?=$customer['contactFirstName']?></td>
                <td><?=$customer['phone']?></td>
                <td><?=$customer['addressLine1']?></td>
                <td><?=$customer['addressLine2']?></td>
                <td><?=$customer['city']?></td>
                <td><?=$customer['state']?></td>
                <td><?=$customer['postalCode']?></td>
                <td><?=$customer['country']?></td>
                <td><?=$customer['salesRepEmployeeNumber']?></td>
                <td><?=$customer['creditLimit']?></td>

            </tr>
            
            <?php endforeach; ?>
        </table>

</body>
</html>