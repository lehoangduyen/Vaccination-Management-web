<?php
if (!defined('browsable')) {
    header("location:javascript://history.go(-1)");
}
error_reporting(E_ERROR | E_PARSE);

$username = $_SESSION['AccountInfo']->get_username();

$citizen = new Citizen();
include("DatabaseConnection.php");
$sql = "select ID, LastName, FirstName, TO_CHAR( Birthday, 'YYYY-MM-DD' ) Birthday, Gender,"
    . "Hometown, ProvinceName, DistrictName, TownName, Street,"
    . "Phone, Email, Guardian, Avatar "
    . "from CITIZEN where Phone= :username";
$command = oci_parse($connection, $sql);
oci_bind_by_name($command, ':username', $username);
oci_execute($command);

while (($row = oci_fetch_array($command, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
    $citizen->set_lastname($row['LASTNAME']);
    $citizen->set_firstname($row['FIRSTNAME']);
    $citizen->set_id($row['ID']);
    $citizen->set_birthday($row['BIRTHDAY']);
    $citizen->set_gender($row['GENDER']);
    $citizen->set_hometown($row['HOMETOWN']);
    $citizen->set_provincename($row['PROVINCENAME']);
    $citizen->set_districtname($row['DISTRICTNAME']);
    $citizen->set_townname($row['TOWNNAME']);
    $citizen->set_street($row['STREET']);
    $citizen->set_phone($row['PHONE']);
    $citizen->set_email($row['EMAIL']);
    $citizen->set_guardian($row['GUARDIAN']);
    $citizen->set_avatar($row['AVATAR']);
}
$_SESSION['CitizenProfile'] = new Citizen();
$_SESSION['CitizenProfile'] = $citizen;
?>