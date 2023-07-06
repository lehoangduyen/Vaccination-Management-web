<?php
error_reporting(E_ERROR | E_PARSE);
define('browsable', true);

include("object_Injection.php");
session_start();

if (isset($_POST['method'])) {
    $method = $_POST['method'];
    $method();
} else
    header("location:javascript://history.go(-1)");

function LoadInjection()
{
    include("DatabaseConnection.php");
    $sql = "select InjNO, DoseType, OnDate, VaccineID, Name from
    (select * from INJECTION where CitizenID = :citizenid) INJ
    join
    (
        select SCHED.ID  as ID, OnDate, VaccineID, Name  from
        (select ID, OrgID, OnDate, VaccineID, Serial from SCHEDULE) SCHED
        join
        (select ID, Name from ORGANIZATION) ORG
        on SCHED.OrgID = ORG.ID
    ) SCHED_ORG
    on INJ.SchedID = SCHED_ORG.ID";

    $command = oci_parse($connection, $sql);
    oci_bind_by_name($command, ':citizenid', $_SESSION['CitizenProfile']->get_id());
    $r = oci_execute($command);
    if (!$r) {
        $exception = oci_error($command);
        echo 'ERROR: ' . $exception['code'] . ' - ' . $exception['message'];
        return;
    }

    $result = "";
    $count = 0;
    while (($row = oci_fetch_array($command, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
        $count++;
        $dosetype = "";
        switch ($row['DOSETYPE']) {
            case "basic":
                $dosetype = "Cơ bản";
                break;
            case "booster":
                $dosetype = "Tăng cường";
                break;
            case "repeat":
                $dosetype = "Nhắc lại";
                break;
            default:
                $dosetype = "";
                break;
        }
        $date = date_create($row['ONDATE']);


        $result .=
            '<div class="injection">
        <p>Mũi ' . $row['INJNO'] . ' (' . $dosetype . ')</p>
        <p>Vaccine: ' . $row['VACCINEID'] . '</p>
        <p>Đơn vị tiêm chủng: ' . $row['NAME'] . '</p>
        <p>Lịch tiêm ngày: ' . date_format($date, "d-m-Y") . '</p>
        </div>';
    }

    switch ($count) {
        case 0:
            echo '<p class="status" id="0">Chưa thực hiện tiêm chủng vaccine Covid-19</p>';
            break;
        case 1:
            echo '<p class="status" id="1">Chưa tiêm đủ liều cơ bản vaccine Covid-19</p>';
            break;
        default:
            echo '<p class="status" id="' . $count . '">Đã tiêm đủ liều cơ bản vaccine Covid-19</p>';
            break;
    }

    echo $result;
}
