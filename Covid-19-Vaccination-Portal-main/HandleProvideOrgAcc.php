<?php
error_reporting(E_ERROR | E_PARSE);
define('browsable', true);

if (isset($_POST['method'])) {
    $method = $_POST['method'];
    $method();
} else
    header("location:javascript://history.go(-1)");

function ProvideAccount() {
    include("DatabaseConnection.php");

    $sql = "begin ACC_CREATE_ORG(:quantity, :code, :province); end;";
    $command = oci_parse($connection, $sql);
    oci_bind_by_name($command, ':quantity', $_POST['quantity']);
    oci_bind_by_name($command, ':code', $_POST['code']);
    oci_bind_by_name($command, ':province', $_POST['province']);
    $r = oci_execute($command);                                     //execute
    
    if (!$r) {                                                      //if false (error)
        $exception = oci_error($command);                           //catch exception
        echo 'ERROR: ' . $exception['code'] . ' - ' . $exception['message'];
        return;
    } 
        
    echo 'ProvideAccount';
}