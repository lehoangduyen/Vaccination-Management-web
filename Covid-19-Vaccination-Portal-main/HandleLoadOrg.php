<?php
error_reporting(E_ERROR | E_PARSE);
define('browsable', true);

if (isset($_POST['method'])) {
    $method = $_POST['method'];
    $method();
} else
    header("location:javascript://history.go(-1)");

function LoadOrg()
{
    include("DatabaseConnection.php");

    $sql = "select * from ORGANIZATION where 1=1 ";

    if ($_POST['province'] != "") {
        $sql .= " and ProvinceName = :province";
    }

    if ($_POST['district'] != "") {
        $sql .= " and DistrictName = :district";
    }

    if ($_POST['town'] != "") {
        $sql .= " and TownName = :town";
    }

    $command = oci_parse($connection, $sql);
    if ($_POST['province'] != "")
        oci_bind_by_name($command, ':province', $_POST['province']);
    if ($_POST['district'] != "")
        oci_bind_by_name($command, ':district', $_POST['district']);
    if ($_POST['town'] != "")
        oci_bind_by_name($command, ':town', $_POST['town']);

    $r = oci_execute($command);
    if (!$r) {
        $exception = oci_error($command);
        echo '<script>ERROR: ' . $exception['code'] . ' - ' . $exception['message'] . '</script>';
        return;
    }

    $result = "";
    while (($row = oci_fetch_array($command, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
        $result .= '
            <div class="organization" id="' . $row['ID'] . '">
                <p class="obj-org-name">'  . $row['NAME'] . '</p>
                <div class="holder-obj-attr">
                    <div class="obj-attr">
                        <p class="id-org">ID: ' . $row['ID']. '</p>
                        <p class="attr-location">K/v: ' . $row['PROVINCENAME'] . ' - ' . $row['DISTRICTNAME'] . ' - ' . $row['TOWNNAME'] . '</p>
                        <p class="attr-address">Đ/c: ' . $row['STREET'] . '</p>
                    </div>
                </div>
            </div>';
    }

    echo $result;
}
