<?php
error_reporting(E_ERROR | E_PARSE);
if (!defined('browsable')) {
    header("location:javascript://history.go(-1)");
}

$org = new Organization();
include("DatabaseConnection.php");
$sql = "select * from Organization where ID = :username";
$command = oci_parse($connection, $sql);
oci_bind_by_name($command, ':username', $_SESSION['AccountInfo']->get_username());
oci_execute($command);

while (($row = oci_fetch_array($command, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
    $org->set_ID($row['ID']);
    $org->set_name($row['NAME']);
    $org->set_provincename($row['PROVINCENAME']);
    $org->set_districtname($row['DISTRICTNAME']);
    $org->set_townname($row['TOWNNAME']);
    $org->set_street($row['STREET']);
}
$_SESSION['OrgProfile'] = new Organization();
$_SESSION['OrgProfile'] = $org;
?>

