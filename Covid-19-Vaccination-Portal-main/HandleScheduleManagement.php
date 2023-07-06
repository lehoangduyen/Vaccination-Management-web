<?php
error_reporting(E_ERROR | E_PARSE);
define('browsable', true);

include("object_Account.php");
include("object_Register.php");
session_start();

if (isset($_POST['method'])) {
    $method = $_POST['method'];
    if ($method == 'LoadSchedule')
        $method($_POST['orgid']);
    else
        $method();
} else
    header("location:javascript://history.go(-1)");

function LoadScheduleRegistration()
{
    include("DatabaseConnection.php");

    $sql = "select LastName, FirstName, Gender, BirthYear, ID, Phone, Time, NO, Status, Image from (
        (select Time, NO, Status, Image, CitizenID from REGISTER where SchedID = :schedid and Status < 3) REG
        inner join
        (select LastName, FirstName, Gender, EXTRACT(year from Birthday) as BirthYear, ID, Phone from CITIZEN) CITIZEN
        on REG.CitizenID = CITIZEN.ID
        )
        where 1=1";
    if($_POST['time'] != null)
    $sql .= " and Time =:time";

    if($_POST['status'] != null)
    $sql .= " and Status =:status";

    $sql .= " order by Time, NO";

    $command = oci_parse($connection, $sql);
    oci_bind_by_name($command, ':schedid', $_POST['SchedID']);

    if($_POST['time'] != null)
    oci_bind_by_name($command, ':time', $_POST['time']);

    if($_POST['status'] != null)
    oci_bind_by_name($command, ':status', $_POST['status']);

    $r = oci_execute($command);
    if (!$r) {
        $exception = oci_error($command);
        echo '<script>ERROR: ' . $exception['code'] . ' - ' . $exception['message'] . '</script>';
        return;
    }

    $result = "";
    while (($row = oci_fetch_array($command, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
        $reg = new Register();
        $reg->get_citizen()->set_lastname($row['LASTNAME']);
        $reg->get_citizen()->set_firstname($row['FIRSTNAME']);
        $reg->get_citizen()->set_gender($row['GENDER']);
        $reg->get_citizen()->set_birthday($row['BIRTHYEAR']);
        $reg->get_citizen()->set_id($row['ID']);
        $reg->get_citizen()->set_phone($row['PHONE']);
        $reg->set_time($row['TIME']);
        $reg->set_no($row['NO']);
        $reg->set_status($row['STATUS']);
        $reg->set_image($row['IMAGE']);
        // && date_create($_POST['date']) < date_create(date('Y-m-d'))
        if ($row['STATUS']  < 2) {
            $interaction = '<select class="select-status" name="">';
            if ($row['STATUS'] == 0)
                $interaction .= '<option value="1">Điểm danh</option><option value="3">Đã hủy</option>';
            else
                $interaction .= '<option value="2">Đã tiêm</option><option value="3">Đã hủy</option>';
            $interaction .= '</select><br><button class="btn-medium-filled btn-update-registration">Cập nhật</button>';
        } else // == 2   
            $interaction = '';

        $result .=
            '<div class="registration" id="' . $_POST['SchedID'] . '">
                <p class="obj-name" id="' . $reg->get_citizen()->get_id() . '">' . $reg->get_citizen()->get_fullname() . ' - ' . $reg->get_citizen()->get_gender() . ' - ' . $reg->get_citizen()->get_birthday() . ' (ID:' . $reg->get_citizen()->get_id() . ')</p>
                <div class="hoder-obj-attr">
                    <div class="obj-attr">
                        <p class="attr-sdt">SĐT: ' . $reg->get_citizen()->get_phone() . '</p>
                        <div class="attr-detail">
                            <p>Buổi: ' . $reg->get_time() . '</p>
                            <p>STT: ' . $reg->get_no() . '</p>
                            <p>Tình trạng: ' . $reg->get_status() . ' </p>
                        </div>
                    </div>
                    <div class="interactive-area">
                        ' . $interaction . '
                    </div>
                </div>
            </div>';
    }

    echo $result;
}

function UpdateRegistrationStatus()
{
    include("DatabaseConnection.php");

    $sql = "begin REG_UPDATE_STATUS(:citizenid, :schedid, :status); end;";

    $command = oci_parse($connection, $sql);
    oci_bind_by_name($command, ':citizenid', $_POST['citizenid']);
    oci_bind_by_name($command, ':schedid', $_POST['SchedID']);
    oci_bind_by_name($command, ':status', $_POST['status']);

    $r = oci_execute($command);
    if (!$r) {
        $exception = oci_error($command);
        echo 'ERROR: ' . $exception['code'] . ' - ' . $exception['message'];
        return;
    }

    echo $_POST['status'];
}

function LockSchedule()
{
    include("DatabaseConnection.php");

    $sql = "select * from SCHEDULE where ID = :id for update";

    $command = oci_parse($connection, $sql);
    oci_bind_by_name($command, ':id', $_POST['SchedID']);

    $r = oci_execute($command);
    if (!$r) {
        $exception = oci_error($command, OCI_NO_AUTO_COMMIT);
        echo 'ERROR: ' . $exception['code'] . ' - ' . $exception['message'];
        return;
    }
}

function SelectScheduleValue()
{
    include("DatabaseConnection.php");

    $sql = "select LimitDay, LimitNoon, LimitNight from SCHEDULE where ID = :id";

    $command = oci_parse($connection, $sql);
    oci_bind_by_name($command, ':id', $_POST['SchedID']);

    $r = oci_execute($command);
    if (!$r) {
        $exception = oci_error($command);
        echo 'ERROR: ' . $exception['code'] . ' - ' . $exception['message'];
        return;
    }

    while (($row = oci_fetch_array($command, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
        $_COOKIE['LimitDay'] = $row['LIMITDAY'];
        $_COOKIE['LimitNoon'] = $row['LIMITNOON'];
        $_COOKIE['LimitNight'] = $row['LIMITNIGHT'];
    }

    echo $_COOKIE['LimitDay'];
}

function UpdateSchedule()
{
    include("DatabaseConnection.php");

    $sql = "begin SCHED_UPDATE_RECORD(:id, :day, :noon, :night); end;";

    if ($_POST['limitday'] == -1)
        $_POST['limitday'] = $_COOKIE['LimitDay'];
    if ($_POST['limitnoon'] == -1)
        $_POST['limitnoon'] = $_COOKIE['LimitNoon'];
    if ($_POST['limitnight'] == -1)
        $_POST['limitnight'] = $_COOKIE['LimitNight'];

    unset($_COOKIE['LimitDay']);
    unset($_COOKIE['LimitNoon']);
    unset($_COOKIE['LimitNight']);

    $command = oci_parse($connection, $sql);
    oci_bind_by_name($command, ':id', $_POST['SchedID']);
    oci_bind_by_name($command, ':day', $_POST['limitday']);
    oci_bind_by_name($command, ':noon', $_POST['limitnoon']);
    oci_bind_by_name($command, ':night', $_POST['limitnight']);

    $r = oci_execute($command);
    if (!$r) {
        $exception = oci_error($command);
        echo 'ERROR: ' . $exception['code'] . ' - ' . $exception['message'];
        return;
    }

    echo 'UpdateSchedule';
}

function CancelSchedule()
{
    include("DatabaseConnection.php");

    $sql = "begin SCHED_CANCEL_SCHED(:schedid); end;";

    $command = oci_parse($connection, $sql);
    oci_bind_by_name($command, ':schedid', $_POST['SchedID']);

    $r = oci_execute($command);
    if (!$r) {
        $exception = oci_error($command);
        echo 'ERROR: ' . $exception['code'] . ' - ' . $exception['message'];
        return;
    }

    echo 'CancelSchedule';
}

function CreateSchedule()
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

    $sql = "begin SCHED_INSERT_RECORD(:orgid, :date, :vaccine, :serial, :day, :noon, :night); end;";

    $command = oci_parse($connection, $sql);
    oci_bind_by_name($command, ':orgid', $_POST['orgid']);
    oci_bind_by_name($command, ':date', $_POST['date']);
    oci_bind_by_name($command, ':vaccine', $_POST['vaccine']);
    oci_bind_by_name($command, ':serial', $_POST['serial']);
    oci_bind_by_name($command, ':day', $_POST['limitday']);
    oci_bind_by_name($command, ':noon', $_POST['limitnoon']);
    oci_bind_by_name($command, ':night', $_POST['limitnight']);

    $r = oci_execute($command);
    if (!$r) {
        $exception = oci_error($command);
        echo 'ERROR: ' . $exception['code'] . ' - ' . $exception['message'];
        return;
    }

    echo 'CreateSchedule';
}
