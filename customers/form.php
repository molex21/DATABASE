<?php declare (strict_types=1);

if (isset($_POST['cancel'])) {  
    header("location: list.php");
    die();
}

$conn = require "../database.php";

if (isset($_POST['save'])) { 
    $customer = array(
        'customerNumber'      => $_POST['customerNumber'],
        'customerName' => $_POST['customerName'],
        'contactLastName'       => $_POST['contactLastName'],
        'contactFirstName'       => $_POST['contactFirstName'],
        'phone'       => $_POST['phone'],
        'addressLine1'     => $_POST['addressLine1'],
        'addressLine2'     => $_POST['addressLine2'],
        'city'      => $_POST['city'],
        'state'      => $_POST['state'],
        'postalCode'      => $_POST['postalCode'],
        'country'      => $_POST['country'],
        'salesRepEmployeeNumber'      => $_POST['salesRepEmployeeNumber'],
        'creditLimit'      => $_POST['creditLimit']

    );

  
    $errores = array();
    if (strlen($customer['contactLastName'])<=0) {
        $errores['contactLastName']= 'Se debe indicar el apellido';
    }

    if (count($errores)== 0) {     
        if (strlen($customer['customerNumber']) >0) {
            $stm = $conn->prepare("update customers set customerNumber=:customerNumber, customerName=:customerName , contactLastName=:contactLastName, contactFirstName=:contactFirstName,
            phone=:phone, addressLine1=:addressLine1, addressLine2=:addressLine2, city=:city, state=:state, postalCode=:postalCode, country=:country, salesRepEmployeeNumber=:salesRepEmployeeNumber, creditLimit=:creditLimit
                                   where customerNumber=:customerNumber");
        }else {  
            $stm = $conn->prepare("select max(customerNumber) as maxCustomerNumber from customers");
            $stm->execute();
            $result = $stm->fetch();

            $customer['customerNumber'] = $result['maxCustomerNumber'] +  1;

            $stm = $conn->prepare("insert into customers (customerNumber, customerName, contactLastName, contactFirstName, phone, addressLine1, addressLine2, city, state, postalCode, country, salesRepEmployeeNumber, creditLimit) 
                                          values (:customerNumber, :customerName, :contactLastName, :contactFirstName, :phone, :addressLine1, :addressLine2, :city, :state, :postalCode, :country, :salesRepEmployeeNumber, :creditLimit)");   
        }
        
        $stm->execute($customer);
        $stm = null;
        $conn = null;

        header("location: show.php?customerNumber=".$customer['customerNumber']);
        die();

    }

} else if (isset($_GET['customerNumber'])) {  
    $stm= $conn->prepare("select * from customers where customerNumber=:customerNumber");
    $stm->execute(array(':customerNumber' => $_GET['customerNumber']));

    $customer = $stm->fetch();
 
} else {  
    $customer = array(
        'customerNumber'      => '',
        'customerName' => '',
        'contactLastName'       => '',
        'contactFirstName'       => '',
        'phone'       => '',
        'addressLine1'     => '',
        'addressLine2'     => '',
        'city'      => '',
        'state'      => '',
        'postalCode'      => '',
        'country'      => '',
        'salesRepEmployeeNumber'      => '',
        'creditLimit'      => ''
    );
}

$stm = $conn->prepare("select * from employees");
$stm -> execute();
$employees = $stm->fetchAll();

$stm = $conn->prepare("select * from customers");
$stm->execute();
$customers= $stm->fetchAll();

$stm = null;
$conn = null;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body class="t_clientes">
    
    <?php if (isset($errores) && count($errores) > 0): ?>
        <p>Existen errores:</p>
        <?php foreach ($errores as $error): ?>
            <li><?=$error?></li>
        <?php endforeach; ?>
    <?php endif; ?>
  
    <form class="caja4" action="form.php" method="post" >
    <h1>Editar Cliente</h1>
            <input type="hidden" name="customerNumber" value="<?=$customer['customerNumber']?>">
        <p class="importante">
            <label for="customerNumber">Nº Cliente: <?=$customer['customerNumber']?></label>            
        </p>
        <p>
            <input type="text" name="customerName" id="customerName" value="<?=$customer['customerName']?>">
            <label for="customerName">Nombre Empresa</label>
        </p>
        <p>

            <input type="text" name="contactLastName" id="contactLastName" value="<?=$customer['contactLastName']?>">
            <label for="contactLastName">Apellido</label>  
        </p>
        <p>

            <input type="text" name="contactFirstName" id="contactFirstName" value="<?=$customer['contactFirstName']?>">
            <label for="contactFirstName">Nombre representante</label>        
        </p>
        <p>

            <input type="text" name="phone" id="phone" value="<?=$customer['phone']?>">
            <label for="phone">Teléfono</label>
        </p>
        <p>

            <input type="text" name="addressLine1" id="addressLine1" value="<?=$customer['addressLine1']?>">
            <label for="addressLine1">Dirección1</label>
        </p>
        <p>

            <input type="text" name="addressLine2" id="addressLine2" value="<?=$customer['addressLine2']?>">
            <label for="addressLine2">Dirección2</label>
        </p>
        <p>

            <input type="text" name="city" id="city" value="<?=$customer['city']?>">
            <label for="city">Ciudad</label>
        </p>
        <p>

            <input type="text" name="state" id="state" value="<?=$customer['state']?>">
            <label for="state">Estado</label>
        </p>
        <p>

            <input type="text" name="postalCode" id="postalCode" value="<?=$customer['postalCode']?>">
            <label for="postalCode">Código Postal</label>
        </p>
        <p>

            <input type="text" name="country" id="country" value="<?=$customer['country']?>">
            <label for="country">País</label>
        </p>
       
        <p>
            <label for="salesRepEmployeeNumber">Nº de representante de venta:</label>
            <select name="salesRepEmployeeNumber">
                <?php foreach($employees as $employee): ?>
                    <option value="<?=$employee['employeeNumber']?>" 
                            <?=$customer['salesRepEmployeeNumber']==$employee['employeeNumber']? 'selected': ''?>>
                        <?= $employee['employeeNumber'].'-'.$employee['employeeNumber']?>
                    </option>
                <?php endforeach; ?>
            </select>
        </p>
           
       <p>
           <label for="creditLimit">Límite de crédito</label>
           <input type="text" name="creditLimit" id="creditLimit" value="<?=$customer['creditLimit']?>">
       </p>

        <input class="formbuts" type="submit" name="save" value="Guardar"><br>
        <input class="formbuts" type="submit" name="cancel" value="Cancelar">
    </form>
    
</body>
</html>