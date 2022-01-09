<?php declare (strict_types=1);

if (isset($_POST['cancel'])) {  
    header("location: list.php");
    die();
}

$conn = require "../database.php";

if (isset($_POST['save'])) { 
    $employee = array(
        'employeeNumber' => $_POST['employeeNumber'],
        'lastName'       => $_POST['lastName'],
        'firstName'       => $_POST['firstName'],
        'officeCode'     => $_POST['officeCode'],
        'reportsTo'     => $_POST['reportsTo'],
        'email'      => $_POST['email'],
        'extension'      => $_POST['extension'],
        'jobTitle'      => $_POST['jobTitle']

    );

    
    $errores = array();
    if (strlen($employee['lastName'])<=0) {
        $errores['lastName']= 'Se debe indicar el apellido';
    }

    if (count($errores)== 0) {    
        if (strlen($employee['employeeNumber']) >0) {
            $stm = $conn->prepare("update employees set firstName=:firstName , lastName=:lastName, officeCode=:officeCode,
                                          employeeNumber=:employeeNumber, reportsTo=:reportsTo, email=:email, extension=:extension, jobTitle=:jobTitle
                                   where employeeNumber=:employeeNumber");
        }else {  
            $stm = $conn->prepare("select max(employeeNumber) as maxEmployeeNumber from employees");
            $stm->execute();
            $result = $stm->fetch();

            $employee['employeeNumber'] = $result['maxEmployeeNumber'] +  1;

            $stm = $conn->prepare("insert into employees (employeeNumber, lastName, firstName, officeCode, reportsTo, email, extension, jobTitle) 
                                          values (:employeeNumber, :lastName, :firstName, :officeCode, :reportsTo, :email, :extension, :jobTitle)");   
        }
        
        $stm->execute($employee);
        $stm = null;
        $conn = null;

        header("location: show.php?employeeNumber=".$employee['employeeNumber']);
        die();

    }

} else if (isset($_GET['employeeNumber'])) { 

    $stm= $conn->prepare("select * from employees where employeeNumber=:employeeNumber");
    $stm->execute(array(':employeeNumber' => $_GET['employeeNumber']));

    $employee = $stm->fetch();
 
} else { 
    $employee = array(
        'employeeNumber' => '',
        'lastName'       => '',
        'firstName'     => '',
        'officeCode'    => '',
        'reportsTo'     => '',
        'email'     => '',
        'extension'     => '',
        'jobTitle'     => ''
    );
}

$stm = $conn->prepare("select * from offices");
$stm -> execute();
$offices = $stm->fetchAll();

$stm = $conn->prepare("select * from employees");
$stm->execute();
$employees= $stm->fetchAll();

$stm = null;
$conn = null;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Empleado</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body class="t_empleados">
    <?php if (isset($errores) && count($errores) > 0): ?>
        <p>Existen errores:</p>
        <?php foreach ($errores as $error): ?>
            <li><?=$error?></li>
        <?php endforeach; ?>
    <?php endif; ?>

    <form class="caja4" action="form.php" method="post">
    <h1>Editar Empleado</h1>
        <input type="hidden" name="employeeNumber" value="<?=$employee['employeeNumber']?>">
        <p class="importante">
            <label for="employeeNumber">Nº Empleado: <?=$employee['employeeNumber']?></label>            
        </p>
        <p>
            
            <input type="text" name="lastName" id="lastName" value="<?=$employee['lastName']?>">
            <label for="lastName">Apellido</label>
        </p>
        <p>
            
            <input type="text" name="firstName" id="firstName" value="<?=$employee['firstName']?>">
            <label for="firstName">Nombre</label>
        </p>
        <p>
            <label for="extension">Extensión</label>
            <input type="text" name="extension" id="extension" value="<?=$employee['extension']?>">
        </p>
        <p>
            <label for="email">Correo</label>
            <input type="text" name="email" id="email" value="<?=$employee['email']?>">
        </p>
        <p>
            <label for="officeCode">Código de oficina</label>
            <select name="officeCode">
                <?php foreach($offices as $office): ?>
                    <option value="<?=$office['officeCode']?>" 
                            <?=$employee['officeCode']==$office['officeCode']? 'selected': ''?>>
                        <?= $office['officeCode'].'-'.$office['city']?>
                    </option>
                <?php endforeach; ?>
            </select>
        </p>

        <p>
            <label for="reportsTo">Responsable</label>
            <select name="reportsTo">
                <?php foreach($employees as $e): ?>
                    <option value="<?=$e['employeeNumber']?>" 
                            <?=$e['employeeNumber']==$employee['reportsTo']? 'selected': ''?>>
                        <?= $e['firstName'].'-'.$e['reportsTo']?>
                    </option>
                <?php endforeach; ?>
            </select>
        </p>


        <p>
            <label for="jobTitle">Titulo</label>
            <input type="text" name="jobTitle" id="jobTitle" value="<?=$employee['jobTitle']?>">
        </p>

        <input class="formbuts"  type="submit" name="save" value="Guardar"><br>
        <input  class="formbuts" type="submit" name="cancel" value="Cancelar">
    </form>
</div>
</body>
</html>