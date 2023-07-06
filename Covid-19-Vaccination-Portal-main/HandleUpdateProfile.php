<?php
error_reporting(E_ERROR | E_PARSE);
define('browsable', true);

include("object_Citizen.php");
include("object_Organization.php");

session_start();

if (isset($_POST['method'])) {
    $method = $_POST['method'];
    $method();
} else
    header('Location: ' . $_SERVER['HTTP_REFERER']);

function UpdateCitizenProfile()
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

    $sql = "begin CITIZEN_UPDATE_RECORD(:oldid, :id, :lastname, :firstname, :birthday, :gender, "
        . ":hometown, :province, :district, :town, :street, :phone, :oldphone, :email); end;";

    $command = oci_parse($connection, $sql);
    oci_bind_by_name($command, ':oldid', $_SESSION['CitizenProfile']->get_id());
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
    oci_bind_by_name($command, ':phone', $_SESSION['CitizenProfile']->get_phone());
    oci_bind_by_name($command, ':oldphone', $_SESSION['CitizenProfile']->get_phone());
    oci_bind_by_name($command, ':email', $_POST['email']);

    $r = oci_execute($command);
    if (!$r) {
        $exception = oci_error($command);
        echo 'ERROR: ' . $exception['code'] . ' - ' . $exception['message'];
        return;
    }

    echo 'UpdateCitizenProfile';

    $citizen = new Citizen();
    $citizen->set_id($_POST['id']);
    $citizen->set_lastname($_POST['lastname']);
    $citizen->set_firstname($_POST['firstname']);
    $citizen->set_birthday($_POST['birthday']);
    $citizen->set_gender($_POST['gender']);
    $citizen->set_hometown($_POST['hometown']);
    $citizen->set_provincename($_POST['province']);
    $citizen->set_districtname($_POST['district']);
    $citizen->set_townname($_POST['town']);
    $citizen->set_street($_POST['street']);
    $citizen->set_phone($_SESSION['CitizenProfile']->get_phone());
    $citizen->set_email($_POST['email']);

    $_SESSION['CitizenProfile'] = $citizen;
}

function UpdateOrgProfile()
{
    include("DatabaseConnection.php");

    $sql = "begin ORG_UPDATE_RECORD(:id, :name, :district, :town, :street); end;";

    $command = oci_parse($connection, $sql);
    oci_bind_by_name($command, ':id', $_SESSION['OrgProfile']->get_id());
    oci_bind_by_name($command, ':name', $_POST['name']);
    oci_bind_by_name($command, ':district', $_POST['district']);
    oci_bind_by_name($command, ':town', $_POST['town']);
    oci_bind_by_name($command, ':street', $_POST['street']);

    $r = oci_execute($command);
    if (!$r) {
        $exception = oci_error($command);
        echo 'ERROR: ' . $exception['code'] . ' - ' . $exception['message'];
        return;
    }

    echo 'UpdateOrgProfile';

    $_SESSION['OrgProfile']->set_name($_POST['name']);
    $_SESSION['OrgProfile']->set_districtname($_POST['district']);
    $_SESSION['OrgProfile']->set_townname($_POST['town']);
    $_SESSION['OrgProfile']->set_street($_POST['street']);
}
