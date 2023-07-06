<?php
error_reporting(E_ERROR | E_PARSE);
define('browsable', true);

include("object_Account.php");
session_start();

include("DatabaseConnection.php");                           //Connection String

$sql = "select * from ACCOUNT where Username = :username"; //SQL string
$command = oci_parse($connection, $sql);                    //Prepare statement before execute
oci_bind_by_name($command, ':username', $_POST['username']);    //bind parameters
$r = oci_execute($command);                                     //execute
if (!$r) {                                                      //if false (error)
    $exception = oci_error($command);                           //catch exception
    echo 'ERROR: ' . $exception['code'] . ' - ' . $exception['message'];
    return;
}

$row = oci_fetch_array($command, OCI_ASSOC + OCI_RETURN_NULLS);
if ($row == false) {
    echo 'NoAccount';    // no account existed
} else {
    // if (isset($_POST['method'])) {
    //     $method = $_POST['method'];
    //     $method();
    // }
}

function SendEmail()
{
    include("DatabaseConnection.php");                           //Connection String

    $sql = "select Email from CITIZEN where Phone=:username"; //SQL string
    $command = oci_parse($connection, $sql);                    //Prepare statement before execute
    oci_bind_by_name($command, ':username', $_POST['username']);    //bind parameters
    $r = oci_execute($command);                                     //execute
    if (!$r) {                                                      //if false (error)
        $exception = oci_error($command);                           //catch exception
        echo 'ERROR: ' . $exception['code'] . ' - ' . $exception['message'];
        return;
    }

    $row = oci_fetch_array($command, OCI_ASSOC + OCI_RETURN_NULLS);
    $Email = $row['Email'];
    echo $Email;
    // the message
    $msg = "TEST";

    // use wordwrap() if lines are longer than 70 characters
    $msg = wordwrap($msg, 70);

    // send email
    // mail($Email, "Gui Mail", $msg);
}
