<?php
error_reporting(E_ERROR | E_PARSE);
define('browsable', true);

include("object_Citizen.php");
session_start();

if (isset($_POST['method'])) {
    $citizen = $_SESSION['CitizenProfile'];
    $method = $_POST['method'];
    $method();
} else
    header("location:javascript://history.go(-1)");


function CheckRegistration()
{
    global $citizen;
    include("DatabaseConnection.php");
    $sql = "begin REG_BEFORE_INSERT_RECORD(:citizenid, :checkbooster, :dosetype); end;";
    $command = oci_parse($connection, $sql);
    oci_bind_by_name($command, ':citizenid', $citizen->get_id());
    $_COOKIE['checkbooster'] = 0;
    oci_bind_by_name($command, ':checkbooster', $_COOKIE['checkbooster']);
    $_COOKIE['dosetype'] = '';
    oci_bind_by_name($command, ':dosetype', $_COOKIE['dosetype'], 10); //last parameter is max-lenght for parameter out

    $r = oci_execute($command);
    if (!$r) {
        $exception = oci_error($command);
        echo 'ERROR: ' . $exception['code'] . ' - ' . $exception['message'];
        return;
    }

    echo $_COOKIE['checkbooster'];
    unset($_COOKIE['checkbooster']);

    echo 'CheckRegistration';
}

function RegisterVaccination()
{
    global $citizen;
    include("DatabaseConnection.php");
    $sql = "begin REG_INSERT_RECORD(:citizenid, :schedid, :time, :dosetype); end;";
    $command = oci_parse($connection, $sql);
    oci_bind_by_name($command, ':citizenid', $citizen->get_id());
    oci_bind_by_name($command, ':schedid', $_POST['SchedID']);
    oci_bind_by_name($command, ':time', $_POST['time']);

    if ($_POST['dosetype'] == '')
        oci_bind_by_name($command, ':dosetype', $_COOKIE['dosetype']);
    else
        oci_bind_by_name($command, ':dosetype', $_POST['dosetype']);

    $r = oci_execute($command);
    if (!$r) {
        $exception = oci_error($command);
        echo 'ERROR: ' . $exception['code'] . ' - ' . $exception['message'];
        return;
    }

    unset($_COOKIE['dosetype']);

    echo 'RegisterVaccination';
}
