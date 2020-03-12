<?php

require_once('vendor/autoload.php');

use PhpShow\Calculator\Calculator;

if(isset($_POST['calculate'])) {
    $firstVariable = $_POST['first'];
    $secondVariable= $_POST['second'];
    $operation = $_POST['operation'];
    
    $calculate = new Calculator($firstVariable, $secondVariable, $operation);
    $result = $calculate->validate()->getResult();
    
    if(array_key_exists('errors', $result)) {
        $result['first'] = $firstVariable;
        $result['second'] = $secondVariable;
        $result['operation'] = $operation;
    }
    $result = urlencode(json_encode($result));
    
    header('location:index.php?result='.$result);
}
