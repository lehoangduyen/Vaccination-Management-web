<?php
error_reporting(E_ERROR | E_PARSE);
define('browsable', true);

include("DatabaseConnection.php");
// include("object_Account.php");
// include("object_News.php");
session_start();

$sql = "select * from News where ID = :serial;"; //SQL string
$command = oci_parse($connection, $sql);                    //Prepare statement before execute
oci_bind_by_name($command, ':serial', $_POST['serial']);    //bind parameters
$r = oci_execute($command);                                     //execute
if (!$r) {                                                    

    $sql = "alter session set NLS_DATE_FORMAT='YYYY-MM-DD'";
    $command = oci_parse($connection, $sql);
    $r = oci_execute($command, OCI_NO_AUTO_COMMIT);
    if (!$r) {
        $exception = oci_error($command);
        echo 'ERROR: ' . $exception['code'] . ' - ' . $exception['message'];
        return;
    }

    if ($_POST['browseimage'] == ''){
        $sql = "begin NEWS_INSERT_RECORD(:serial, :orgid, :title, :date, :browsetext, null); end;";
        echo'ok1';
        return;
    }

    if ($_POST['browsetext'] == ''){
        $sql = "begin NEWS_INSERT_RECORD(:serial, :orgid, :title, :date, null, :browseimage); end;";
    }

    if ($_POST['browseimage'] != '' && $_POST['browsetext'] != ''){
        $sql = "begin NEWS_INSERT_RECORD(:serial, :orgid, :title, :date, :browsetext, utl_raw.cast_to_raw(:browseimage)); end;";
        echo'ok3';
        return;
    }

    $command = oci_parse($connection, $sql);
    oci_bind_by_name($command, ':serial', $_POST['serial']);
    oci_bind_by_name($command, ':orgid', $_POST['orgid']);
    oci_bind_by_name($command, ':title', $_POST['title']);
    oci_bind_by_name($command, ':date', $_POST['date']);
    oci_bind_by_name($command, ':browsetext', $_POST['browsetext']);
    oci_bind_by_name($command, ':browseimage', $_POST['browseimage']);

    $r = oci_execute($command);
    if (!$r) {
        $exception = oci_error($command);
        echo 'ERROR: ' . $exception['code'] . ' - ' . $exception['message'];
        return;
    }
}
else {
    echo 'HadID';
    return;
    // $exception = oci_error($command);
    // echo 'ERROR: ' . $exception['code'] . ' - ' . $exception['message'];
    // return;

    $sql = "alter session set NLS_DATE_FORMAT='YYYY-MM-DD'";
    $command = oci_parse($connection, $sql);
    $r = oci_execute($command, OCI_NO_AUTO_COMMIT);
    if (!$r) {
        $exception = oci_error($command);
        echo 'ERROR: ' . $exception['code'] . ' - ' . $exception['message'];
        return;
    }

    if ($_POST['browseimage'] == ''){
        $sql = "begin NEWS_INSERT_RECORD(:serial, :orgid, :title, :date, :browsetext, null); end;";
        echo'ok1';
        return;
    }

    if ($_POST['browsetext'] == ''){
        $sql = "begin NEWS_INSERT_RECORD(:serial, :orgid, :title, :date, null, utl_raw.cast_to_raw(:browseimage)); end;";
        echo'ok2';
        return;
    }

    if ($_POST['browseimage'] != '' && $_POST['browsetext'] != ''){
        $sql = "begin NEWS_INSERT_RECORD(:serial, :orgid, :title, :date, :browsetext, utl_raw.cast_to_raw(:browseimage)); end;";
        echo'ok3';
        return;
    }

    $command = oci_parse($connection, $sql);
    oci_bind_by_name($command, ':serial', $_POST['serial']);
    oci_bind_by_name($command, ':orgid', $_POST['orgid']);
    oci_bind_by_name($command, ':title', $_POST['title']);
    oci_bind_by_name($command, ':date', $_POST['date']);
    oci_bind_by_name($command, ':browsetext', $_POST['browsetext']);
    oci_bind_by_name($command, ':browseimage', $_POST['browseimage']);

    $r = oci_execute($command);
    if (!$r) {
        $exception = oci_error($command);
        echo 'ERROR: ' . $exception['code'] . ' - ' . $exception['message'];
        return;
    }
}



    