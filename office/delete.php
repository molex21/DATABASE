<?php declare(strict_types=1);

if(isset($_POST['cancel'])) {
    header("location: list.php");
} else if (isset($_POST['delete'])) {
    $conn = require "../database.php";

    $stn = $conn->prepare("delete from offices where officeCode = :officeCode");
    $stn-> execute(array(':officeCode' => $_POST['officeCode']));

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
<body class="t_oficinas">

    <form class="caja4" action="delete.php" method="post">  
        <input type="hidden" name="officeCode" value="<?=$_GET['officeCode']?>">

        <p class="importante">¿Seguro que quiere borrar la oficina con código <?=$_GET['officeCode']?>?</p>
  
    <input class="formbuts" type="submit" name="delete" value="Eliminar"><br>
    <input class="formbuts" type="submit" name="cancel" value="Cancelar">
    </form>
</body>
</html>