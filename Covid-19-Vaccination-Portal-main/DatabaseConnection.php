<?php
error_reporting(E_ERROR | E_PARSE);
if (!defined('browsable')) {
    header("location:javascript://history.go(-1)");
}

$connection = oci_connect('covid19_vaccination_infogate', 'covid19_vaccination_infogate', 'localhost/orcl', 'UTF8');
if (!$connection) {
    // $e = oci_error();
    // trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    // echo "<script>alert('!')</script>";
    $exception = oci_error($command);                           //catch exception
    echo 'ERROR: ' . $exception['code'] . ' - ' . $exception['message'];
    return;
}
?>
