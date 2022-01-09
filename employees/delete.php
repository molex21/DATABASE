<?php declare(strict_types=1);

if(isset($_POST['cancel'])) {
    header("location: list.php");
} else if (isset($_POST['delete'])) {
    $conn = require "../database.php";

    $stn = $conn->prepare("delete from employees where employeeNumber = :employeeNumber");
    $stn-> execute(array(':employeeNumber' => $_POST['employeeNumber']));

    $stn = null;
    $conn = null;

    header("location: list.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar empleado</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body class="t_empleados">
    <form class="caja4" action="delete.php" method="post">  
        <input type="hidden" name="employeeNumber" value="<?=$_GET['employeeNumber']?>">

        <p class="importante">¿Seguro que quiere borrar el empleado con código <?=$_GET['employeeNumber']?>?</p>
    <input class="formbuts" type="submit" name="delete" value="Eliminar"><br>
    <input class="formbuts" type="submit" name="cancel" value="Cancelar">
    </form>
</body>
</html>