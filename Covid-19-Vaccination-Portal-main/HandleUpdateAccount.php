<?php
error_reporting(E_ERROR | E_PARSE);
define('browsable', true);

include("object_Account.php");
include("object_Citizen.php");
session_start();

/*
The If statement is used as a checkpoint of the right request.
Only the requests from jQuery 
*/
if (isset($_POST['method'])) {
    if ($_POST['password'] != $_SESSION['AccountInfo']->get_password()) {
        echo 'Password is incorrect!';
        return;
    }

    ChangePassword();

    if ($_SESSION['AccountInfo']->get_role() == 2)
    {
        UpdateAccount();
    }   
} else
    header("location:javascript://history.go(-1)");


function ChangePassword()
{
    if ($_POST['new_password'] == "" || $_POST['new_password'] == $_SESSION['AccountInfo']->get_password()) {
        echo '!ChangePassword';        
        return;
    }
    include("DatabaseConnection.php");
    $sql = "begin ACC_UPDATE_PASSWORD(:username, :password, :newpassword); end;";
    $command = oci_parse($connection, $sql);
    oci_bind_by_name($command, ':username', $_SESSION['AccountInfo']->get_username());
    oci_bind_by_name($command, ':password', $_POST['password']);
    oci_bind_by_name($command, ':newpassword', $_POST['new_password']);

    $r = oci_execute($command);
    if (!$r) {
        $exception = oci_error($command);
        echo 'ERROR: ' . $exception['code'] . ' - ' . $exception['message'];
        return;
    }

    $_SESSION['AccountInfo']->set_password($_POST['new_password']);

    echo 'ChangePassword';
}

function UpdateAccount()
{
    if ($_POST['phone'] == $_SESSION['AccountInfo']->get_username()){
        echo '!UpdateAccount';        
        return;
    }

    include("DatabaseConnection.php");

    $sql = "alter session set NLS_DATE_FORMAT='YYYY-MM-DD'";
    $command = oci_parse($connection, $sql);
    $r = oci_execute($command, OCI_NO_AUTO_COMMIT);
    if (!$r) {
        $exception = oci_error($command);
        echo 'ERROR: ' . $exception['code'] . ' - ' . $exception['message'];
        return;
    }

    $sql = "begin CITIZEN_UPDATE_RECORD(:oldid, :id, :lastname, :firstname, :birthday, :gender, "
        . ":hometown, :province, :district, :town, :street, :phone, :oldphone, :email); end;";

    $command = oci_parse($connection, $sql);
    oci_bind_by_name($command, ':oldid', $_SESSION['CitizenProfile']->get_id());
    oci_bind_by_name($command, ':id', $_SESSION['CitizenProfile']->get_id());
    oci_bind_by_name($command, ':lastname', $_SESSION['CitizenProfile']->get_lastname());
    oci_bind_by_name($command, ':firstname', $_SESSION['CitizenProfile']->get_firstname());
    oci_bind_by_name($command, ':birthday', $_SESSION['CitizenProfile']->get_birthday());
    oci_bind_by_name($command, ':gender', $_SESSION['CitizenProfile']->get_gender(1));
    oci_bind_by_name($command, ':hometown', $_SESSION['CitizenProfile']->get_hometown());
    oci_bind_by_name($command, ':province', $_SESSION['CitizenProfile']->get_provincename());
    oci_bind_by_name($command, ':district', $_SESSION['CitizenProfile']->get_districtname());
    oci_bind_by_name($command, ':town', $_SESSION['CitizenProfile']->get_townname());
    oci_bind_by_name($command, ':street', $_SESSION['CitizenProfile']->get_street());
    oci_bind_by_name($command, ':phone', $_POST['phone']);
    oci_bind_by_name($command, ':oldphone', $_SESSION['CitizenProfile']->get_phone());
    oci_bind_by_name($command, ':email', $_SESSION['CitizenProfile']->get_email());

    $r = oci_execute($command);
    if (!$r) {
        $exception = oci_error($command);
        echo 'ERROR: ' . $exception['code'] . ' - ' . $exception['message'];
        return;
    }

    $_SESSION['CitizenProfile']->set_phone($_POST['phone']);
    $_SESSION['AccountInfo']->set_username($_POST['phone']);
  
    echo 'UpdateAccount';
}
