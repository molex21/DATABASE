<?php declare(strict_types=1);

$conn = require "../database.php";

$stm = $conn->query("select * from offices order by officeCode");
$stm->execute();
$offices = $stm->fetchAll();

$stm = null;
$conn = null;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oficinas</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body class="t_oficinas" style="font-size:<?= isset($_COOKIE['style']['size'])? $_COOKIE['style']['size'] : '16'?>px">
    <h1 class="caja3">Listado de oficinas</h1>

    <a href="form.php"><button class="button">Nueva Oficina</button></a>
    <a href="../opciones.php"><button  class="button2">Atrás</button></a><br><br>
    <a href="default.php"><button  class="button2">Reestablecer tamaño de letra</button></a>
    <a href="form_font.php"><button class="button">Cambiar Tamaño de Letra</button></a><br><br><br>
  
    <table>
        <tr class="uppercase">
            <th>Cód. Oficina</th><th>Ciudad</th><th>Teléfono</th><th>Dirección1</th><th>Dirección2</th><th>Estado</th><th>País</th><th>Código Postal</th><th>Territorio</th>
        </tr>

        <?php foreach($offices as $office): ?>
            <tr> 
                <td>
                    <a class="a" href="show.php?officeCode=<?=$office['officeCode']?>">
                        <?=$office['officeCode']?>
                    </a>
                </td>
                <td><?=$office['city']?></td>
                <td><?=$office['phone']?></td>
                <td><?=$office['addressLine1']?></td>
                <td><?=$office['addressLine2']?></td>
                <td><?=$office['state']?></td>
                <td><?=$office['country']?></td>
                <td><?=$office['postalCode']?></td>
                <td><?=$office['territory']?></td>

            </tr>
            
            <?php endforeach; ?>
        </table>


</body>
</html>