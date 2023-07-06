<?php
error_reporting(E_ERROR | E_PARSE);
define('browsable', true);

session_start();

if (isset($_POST['method'])) {
    $method = $_POST['method'];
    $method();
} else
header("location:javascript://history.go(-1)");


function CheckExist()
{
    include("DatabaseConnection.php");

    $sql = "select * from ACCOUNT where Username = :username";
    $command = oci_parse($connection, $sql);
    oci_bind_by_name($command, ':username', $_POST['username']);
    $r = oci_execute($command);
    if (!$r) {
        echo 'ERROR: ' . $exception['code'] . ' - ' . $exception['message'];
        return;
    }

    $row = oci_fetch_array($command, OCI_ASSOC + OCI_RETURN_NULLS);
    if ($row == true)
        echo 'Account Existed!';
}

function RegisterAccount()
{
    include("DatabaseConnection.php");
    $sql = "begin ACC_INSERT_RECORD(:username, :password, 2, 0); end;";
    $command = oci_parse($connection, $sql);
    oci_bind_by_name($command, ':username', $_POST['username']);
    oci_bind_by_name($command, ':password', $_POST['password']);

    $r = oci_execute($command);
    if (!$r) {
        $exception = oci_error($command);
        echo 'ERROR: ' . $exception['code'] . ' - ' . $exception['message'];
        return;
    }
    setcookie('username', $_POST['username']);
    echo 'Account Created!';
}

function RegisterProfile()
{
    include("DatabaseConnection.php");

    $sql = "alter session set NLS_DATE_FORMAT='YYYY-MM-DD'";
    $command = oci_parse($connection, $sql);
    $r = oci_execute($command, OCI_NO_AUTO_COMMIT);
    if (!$r) {
        $exception = oci_error($command);
        echo 'ERROR: ' . $exception['code'] . ' - ' . $exception['message'];
        return;
    }

    $sql = "begin CITIZEN_INSERT_RECORD(:id, :lastname, :firstname, :birthday, :gender, "
        . ":hometown, :province, :district, :town, :street, :phone, :email); end;";

    $command = oci_parse($connection, $sql);
    oci_bind_by_name($command, ':id', $_POST['id']);
    oci_bind_by_name($command, ':lastname', $_POST['lastname']);
    oci_bind_by_name($command, ':firstname', $_POST['firstname']);
    oci_bind_by_name($command, ':birthday', $_POST['birthday']);
    oci_bind_by_name($command, ':gender', $_POST['gender']);
    oci_bind_by_name($command, ':hometown', $_POST['hometown']);
    oci_bind_by_name($command, ':province', $_POST['province']);
    oci_bind_by_name($command, ':district', $_POST['district']);
    oci_bind_by_name($command, ':town', $_POST['town']);
    oci_bind_by_name($command, ':street', $_POST['street']);
    oci_bind_by_name($command, ':phone', $_COOKIE['username']);
    oci_bind_by_name($command, ':email', $_POST['email']);

    $r = oci_execute($command, OCI_NO_AUTO_COMMIT);
    if (!$r) {
        $exception = oci_error($command);
        echo 'ERROR: ' . $exception['code'] . ' - ' . $exception['message'];
        return;
    }

    $sql = "update ACCOUNT set Status = 1 where username = :username";
    $command = oci_parse($connection, $sql);
    oci_bind_by_name($command, ':username', $_COOKIE['username']);
    $r = oci_execute($command);
    if (!$r) {
        $exception = oci_error($command);
        echo 'ERROR: ' . $exception['code'] . ' - ' . $exception['message'];
        return;
    }

    setcookie('username', '');
    echo 'Profile Created!';
}
