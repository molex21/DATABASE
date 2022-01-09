<?php declare(strict_types=1);

$conn = require "../database.php";

$stm = $conn->query("select * from employees order by employeeNumber");
$stm->execute();
$employees = $stm->fetchAll();

$stm = null;
$conn = null;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <title>Empleado</title>
</head>
<body class="t_empleados" style="font-size:<?= isset($_COOKIE['style']['size'])? $_COOKIE['style']['size'] : '16'?>px">
    <h1 class="caja3">Listado de Empledos</h1>

    <a href="form.php"><button class="button">Nuevo Empleado</button></a>
    <a href="../opciones.php"><button  class="button2">Atrás</button></a><br><br>
    <a href="default.php"><button  class="button2">Reestablecer tamaño de letra</button></a>
    <a href="form_font.php"><button class="button">Cambiar Tamaño de Letra</button></a><br><br><br>
   
    <table>
        <tr class="uppercase">
            <th>Nº Empleado</th><th>Apellido</th><th>Nombre</th><th>Extensión</th><th>Correo</th><th>Cód. Oficina</th><th>Responsable</th><th>Título</th>
        </tr>

        <?php foreach($employees as $employee): ?>
            <tr> 
                <td>
                    <a class="a" href="show.php?employeeNumber=<?=$employee['employeeNumber']?>">
                        <?=$employee['employeeNumber']?>
                    </a>
                </td>
                <td><?=$employee['lastName']?></td>
                <td><?=$employee['firstName']?></td>
                <td><?=$employee['extension']?></td>
                <td><?=$employee['email']?></td>
                <td><?=$employee['officeCode']?></td>
                <td><?=$employee['reportsTo']?></td>
                <td><?=$employee['jobTitle']?></td>
              
            </tr>
            
            <?php endforeach; ?>
        </table>


</body>
</html>