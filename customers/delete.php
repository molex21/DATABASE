<?php declare(strict_types=1);

if(isset($_POST['cancel'])) {
    header("location: list.php");
} else if (isset($_POST['delete'])) {
    $conn = require "../database.php";

    $stn = $conn->prepare("delete from customers where customerNumber = :customerNumber");
    $stn-> execute(array(':customerNumber' => $_POST['customerNumber']));

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
    <title>Eliminar oficina</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body class="t_clientes">

    <form class="caja4" action="delete.php" method="post">  
        <input type="hidden" name="customerNumber" value="<?=$_GET['customerNumber']?>">

        <p class="importante">¿Seguro que quiere borrar el cliente con código <?=$_GET['customerNumber']?>?</p>
    <input class="formbuts" type="submit" name="delete" value="Eliminar"><br>
    <input class="formbuts" type="submit" name="cancel" value="Cancelar">
    </form>
</body>
</html>