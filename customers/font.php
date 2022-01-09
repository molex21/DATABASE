<?php declare(strict_types=1);

setcookie("style[size]", $_POST["size"], 0, "", "", false, true);

header("location: list.php");
exit();
?>