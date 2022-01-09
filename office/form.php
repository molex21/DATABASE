<?php declare(strict_types=1);

if(isset($_POST['cancel'])) {
    header("location: list.php");

} else if (isset($_POST['save'])) {
    $office = array(
        'currentOfficeCode' => $_POST['currentOfficeCode'],
        'officeCode' => $_POST['officeCode'],
        'city' => $_POST['city'],
        'phone' => $_POST['phone'],
        'addressLine1' => $_POST['addressLine1'],
        'addressLine2' => $_POST['addressLine2'],
        'state' => $_POST['state'],
        'country' => $_POST['country'],
        'postalCode' => $_POST['postalCode'],
        'territory' => $_POST['territory']
    );

    $errores = array();

    if(strlen($office['city']) <= 0) {
        $errores['city'] = 'Se debe indicar la ciudad';
        
    }

    if(count($errores) == 0){
    $conn = require "../database.php";

    if (strlen($office['currentOfficeCode']) > 0 ) {
        $stn = $conn->prepare("update offices set city=:city, officeCode=:officeCode, phone=:phone, addressLine1=:addressLine1, addressLine2=:addressLine2, state=:state, country=:country, postalCode=:postalCode, territory=:territory where officeCode=:currentOfficeCode");
        $params = $office;
    } else {
        $stn = $conn->prepare("select max(CAST(officeCode AS UNSIGNED)) as maxOfficeCode from offices");
        $stn->execute();
        $result=$stn->fetch();
        
        $office['officeCode'] = $result['maxOfficeCode'] + 1;

        $stn = $conn->prepare("insert into offices (officeCode, city, phone, addressLine1, addressLine2, state, country, postalCode, territory) values (:officeCode, :city, :phone, :addressLine1, :addressLine2, :state, :country, :postalCode, :territory)");

        $params = array_slice($office,1);

    }

    $stn->execute($params);
    $stn = null;
    $conn = null;
    header("location: show.php?officeCode=".$office['officeCode']);
}
} else if (isset($_GET['officeCode'])) {
    $conn = require "../database.php";

    $stn = $conn->prepare("select * from offices where officeCode = :officeCode");
    $stn-> execute(array(':officeCode' => $_GET['officeCode']));

    $office = $stn->fetch();
    $office['currentOfficeCode'] = $office['officeCode'];

    $stn = null;
    $conn = null;
}else {
    $office= array(
        'currentOfficeCode' => '',
        'officeCode' => '',
        'city' => '',
        'phone' => '',
        'addressLine1' => '',
        'addressLine2' => '',
        'state' => '',
        'country' => '',
        'postalCode' => '',
        'territory' => ''
    );
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar oficina</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body class="t_oficinas">
    
    <?php if (isset($errores) && count($errores)>0): ?>
        <p>Existen errores:</p>
        <?php foreach($errores as $error): ?>
            <li><?=$error?></li>
        <?php endforeach;?>
    <?php endif;?>

    <form class="caja4" action="form.php" method="post">  
    <h1>Editar Oficina</h1>
        <input type="hidden" name="currentOfficeCode" value="<?=$office['currentOfficeCode']?>">
    <p class="importante">
        <label for="officeCode">Código de oficina: <?=$office['officeCode']?></label >
        <input type="hidden" name="officeCode" id="officeCode" value="<?=$office['officeCode']?>" readonly>
    </p>
    <p>
        <label for="city">Ciudad</label>
        <input type="text" name="city" id="city" value="<?=$office['city']?>">
    </p>
    <p>
        <label for="phone">Telefono</label>
        <input type="text" name="phone" id="phone" value="<?=$office['phone']?>">
    </p>
    <p>
        <label for="addressLine1">Dirección1</label>
        <input type="text" name="addressLine1" id="addressLine1" value="<?=$office['addressLine1']?>">
    </p>
    <p>
        <label for="addressLine2">Dirección2</label>
        <input type="text" name="addressLine2" id="addressLine2" value="<?=$office['addressLine2']?>">
    </p>
    <p>
        <label for="state">Estado</label>
        <input type="text" name="state" id="state" value="<?=$office['state']?>">
    </p>
    <p>
        <label for="country">País</label>
        <input type="text" name="country" id="country" value="<?=$office['country']?>">
    </p>
    <p>
        <label for="postalCode">Código postal</label>
        <input type="text" name="postalCode" id="postalCode" value="<?=$office['postalCode']?>">
    </p>
    <p>
        <label for="territory">Territorio</label>
        <input type="text" name="territory" id="territory" value="<?=$office['territory']?>">
    </p>

    <input class="formbuts" type="submit" name="save" value="Guardar"><br>
    <input class="formbuts" type="submit" name="cancel" value="Cancelar">
    </form>
</body>
</html>