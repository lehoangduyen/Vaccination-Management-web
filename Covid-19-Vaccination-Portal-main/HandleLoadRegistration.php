<?php
error_reporting(E_ERROR | E_PARSE);
define('browsable', true);

include("object_Register.php");
session_start();

if (isset($_POST['method'])) {
    $method = $_POST['method'];
    $method();
} else
    header("location:javascript://history.go(-1)");


function LoadRegistration()
{
    include("DatabaseConnection.php");
    $sql = "select SchedID, Name, ProvinceName, DistrictName, TownName, Street, TO_CHAR(OnDate, 'YYYY-MM-DD') OnDate, Time, NO, VaccineID, Serial, Status, DoseType, Image from (
        (select SchedID, Time, NO, Status, REG.DoseType, OrgID, OnDate, VaccineID, Serial, Image from (
            (select ID, SchedID, NO, Time, Status, DoseType, Image from REGISTER where CitizenID = :citizenid) REG
            inner join
            (select ID, OrgID, OnDate, VaccineID, Serial from SCHEDULE) SCHED
            on
            REG.SchedID = SCHED.ID)
        ) REG_SCHED
        inner join
        (select ID, Name, ProvinceName, DistrictName, TownName, Street from ORGANIZATION) ORG
        on REG_SCHED.OrgID = ORG.ID
    )
    where 1=1";
    if ($_POST['status'] != -1)
        $sql .= " and Status = :status";
    if ($_POST['vaccine'] != -1)
        $sql .= " and VaccineID = :vaccine";
    if ($_POST['time'] != -1)
        $sql .= " and Time = :time";
    $sql .= " order by Status";

    $command = oci_parse($connection, $sql);
    oci_bind_by_name($command, ':citizenid', $_SESSION['CitizenProfile']->get_id());
    if ($_POST['status'] != -1)
        oci_bind_by_name($command, ':status', $_POST['status']);
    if ($_POST['vaccine'] != -1)
        oci_bind_by_name($command, ':vaccine', $_POST['vaccine']);
    if ($_POST['time'] != -1)
        oci_bind_by_name($command, ':time', $_POST['time']);
    $r = oci_execute($command);
    if (!$r) {
        $exception = oci_error($command);
        echo 'ERROR: ' . $exception['code'] . ' - ' . $exception['message'];
        return;
    }
    $Cregistration = new Register();

    $result = "";
    while (($row = oci_fetch_array($command, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
        $Cregistration->get_sched()->set_id($row['SCHEDID']);
        $Cregistration->get_sched()->get_org()->set_name($row['NAME']);
        $Cregistration->get_sched()->get_org()->set_provincename($row['PROVINCENAME']);
        $Cregistration->get_sched()->get_org()->set_districtname($row['DISTRICTNAME']);
        $Cregistration->get_sched()->get_org()->set_townname($row['TOWNNAME']);
        $Cregistration->get_sched()->get_org()->set_street($row['STREET']);
        $Cregistration->get_sched()->set_ondate($row['ONDATE']);
        $Cregistration->set_time($row['TIME']);
        $Cregistration->set_NO($row['NO']);
        $Cregistration->get_sched()->set_vaccine($row['VACCINEID']);
        $Cregistration->get_sched()->set_serial($row['SERIAL']);
        $Cregistration->set_status($row['STATUS']);
        $Cregistration->set_dosetype($row['DOSETYPE']);
        $Cregistration->set_image($row['IMAGE']);

        if ((int)$Cregistration->get_status(1) < 2)
            $CancelButton = '<div class="interactive-area">
            <button class="btn-medium-bordered btn-cancel-registration">Hủy</button>
            </div>';
        else
            $CancelButton = '';

        $result .= '
        <div class="registration" id="' . $Cregistration->get_sched()->get_id() . '">
            <p class="obj-org-name">' . $Cregistration->get_sched()->get_org()->get_name() . '</p>
            <div class="holder-obj-attr">
                <div class="obj-attr">
                    <p class="attr-address">Đ/c: '
            . $Cregistration->get_sched()->get_org()->get_provincename() . ', '
            . $Cregistration->get_sched()->get_org()->get_districtname() . ', '
            . $Cregistration->get_sched()->get_org()->get_townname()
            . '</p>
                    <p class="attr-date-time-no">Lịch tiêm ngày: ' . $Cregistration->get_sched()->get_ondate()
            . '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Buổi ' . $Cregistration->get_time()
            . '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp STT: ' . $Cregistration->get_no() . '</p>
                    <p class="attr-vaccine-serial">Vaccine: '
            . $Cregistration->get_sched()->get_vaccine() . ' - ' . $Cregistration->get_sched()->get_serial()
            . '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Trạng thái: ' . $Cregistration->get_status() . '</p>
                </div>
                ' . $CancelButton . '             
            </div>
        </div>
        ';
    }
    echo $result;
}

function CancelRegistration()
{
    include("DatabaseConnection.php");
    $sql = "begin REG_UPDATE_STATUS(:citizenid, :schedid, :status); end;";

    $command = oci_parse($connection, $sql);
    oci_bind_by_name($command, ':citizenid', $_SESSION['CitizenProfile']->get_id());
    oci_bind_by_name($command, ':schedid', $_POST['SchedID']);
    $stt = 3;
    oci_bind_by_name($command, ':status', $stt);

    $r = oci_execute($command);
    if (!$r) {
        $exception = oci_error($command);
        echo 'ERROR: ' . $exception['code'] . ' - ' . $exception['message'];
        return;
    }
    echo 'CancelRegistration';
}
