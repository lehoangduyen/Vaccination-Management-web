<?php
error_reporting(E_ERROR | E_PARSE);
define('browsable', true);

include("object_Account.php");
include("object_Schedule.php");
session_start();

if (isset($_POST['method'])) {
    $method = $_POST['method'];
    if ($method == 'LoadSchedule')
        $method($_POST['orgid']);
    else
        $method();
} else
    header("location:javascript://history.go(-1)");

function LoadOrg()
{
    include("DatabaseConnection.php");

    $sql = "select ORG.ID as ID, Name, ProvinceName, DistrictName, TownName, Street, COUNT(SCHED.ID) as C
    from
    (select * from ORGANIZATION where 1=1 ";

    if ($_POST['province'] != "") {
        $sql .= " and ProvinceName = :province";
    }

    if ($_POST['district'] != "") {
        $sql .= " and DistrictName = :district";
    }

    if ($_POST['town'] != "") {
        $sql .= " and TownName = :town";
    }

    $sql .= ") ORG
    inner join
    (select ID, OrgID from SCHEDULE where OnDate > SYSDATE) SCHED
    on ORG.ID = SCHED.OrgID
    group by ORG.ID, Name, ProvinceName, DistrictName, TownName, Street";

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
    switch ($_SESSION['AccountInfo']->get_role()) {
        case 0:
            while (($row = oci_fetch_array($command, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
                echo '@';
                $result .= '
                    <div class="organization" id="' . $row['ID'] . '">
                        <p class="obj-org-name">'  . $row['NAME'] . '</p>
                        <div class="holder-obj-attr">
                            <div class="obj-attr">
                                <p class="id-org">ID: ' . $row['ID'] . '</p>
                                <p class="attr-location">K/v: ' . $row['PROVINCENAME'] . ' - ' . $row['DISTRICTNAME'] . ' - ' . $row['TOWNNAME'] . '</p>
                                <p class="attr-address">Đ/c: ' . $row['STREET'] . '</p>
                            </div>
                        </div>
                    </div>';
            }
            break;
        case 2:
            while (($row = oci_fetch_array($command, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
                $result .= '
                    <div class="organization object" id="' . $row['ID'] . '">
                        <div class="holder-org">
                            <p class="obj-org-name">' . $row['NAME'] . ': ' . $row['C'] . ' lịch</p>
                            <div class="obj-attr">
                                <p class="attr-location">K/v: ' . $row['PROVINCENAME'] . ' - ' . $row['DISTRICTNAME'] . ' - ' . $row['TOWNNAME'] . '</p>
                                <p class="attr-address">Đ/c: ' . $row['STREET'] . '</p>
                            </div>
                        </div>
                        <div class="holder-btn-expand-org">
                            <div class="btn-expand-org"> > </div> 
                        </div>
                    </div>';
            }
            break;
        default:
    }
    echo $result;
}

function LoadSchedule($orgid = "")
{
    if ($orgid == "")
        return;

    include("DatabaseConnection.php");
    $sql = "alter session set NLS_DATE_FORMAT='YYYY-MM-DD'";
    $command = oci_parse($connection, $sql);
    $r = oci_execute($command, OCI_NO_AUTO_COMMIT);
    if (!$r) {
        $exception = oci_error($command);
        echo 'ERROR: ' . $exception['code'] . ' - ' . $exception['message'];
        return;
    }

    $sql = "select * from SCHEDULE where OrgID = :id and OnDate >= SYSDATE";

    if ($_POST['startdate'] != "") {
        $sql .= " and OnDate >= :startdate";
    }

    if ($_POST['enddate'] != "") {
        $sql .= " and OnDate <= :enddate";
    }

    if ($_POST['vaccine'] != "") {
        $sql .= " and VaccineID = :vaccine";
    }

    $sql .= " order by OnDate";

    $command = oci_parse($connection, $sql);

    oci_bind_by_name($command, ':id', $orgid);
    if ($_POST['startdate'] != "")
        oci_bind_by_name($command, ':startdate', $_POST['startdate']);
    if ($_POST['enddate'] != "")
        oci_bind_by_name($command, ':enddate', $_POST['enddate']);
    if ($_POST['vaccine'] != "")
        oci_bind_by_name($command, ':vaccine', $_POST['vaccine']);


    $r = oci_execute($command);
    if (!$r) {
        $exception = oci_error($command);
        echo '<script>ERROR: ' . $exception['code'] . ' - ' . $exception['message'] . '</script>';
        return;
    }

    $result = "";

    while (($row = oci_fetch_array($command, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
        if ($row['LIMITDAY'] + $row['LIMITNOON'] + $row['LIMITNIGHT'])
            $result .=
                '<div class="schedule object" id="' . $row['ID'] . '">
                        <div class="obj-attr">
                            <p class="attr-date">Lịch tiêm ngày: ' . $row['ONDATE'] . '</p>
                            <p class="attr-vaccine">Vaccine: ' . $row['VACCINEID'] . '</p>
                            <p class="attr-serial">Serial: ' . $row['SERIAL'] . '</p>
                        </div>
                        <div class="obj-attr">
                            <p class="attr-daytime">Buổi sáng: ' . $row['DAYREGISTERED'] . '/' . $row['LIMITDAY'] . '</p>
                            <p class="attr-noontime">Buổi trưa: ' . $row['NOONREGISTERED'] . '/' . $row['LIMITNOON'] . '</p>
                            <p class="attr-nighttime">Buổi tối: ' . $row['NIGHTREGISTERED'] . '/' . $row['LIMITNIGHT'] . '</p>
                        </div>
                        <div class="interactive-area">
                            <select class="drop-down-time" name="" id="">
                                <option value="0">Sáng</option>
                                <option value="1">Trưa</option>
                                <option value="2">Tối</option>
                            </select>
                            <br>
                            <button class="btn-medium-filled btn-register-schedule">Đăng ký</button>
                        </div>
                    </div>';
    }
    echo $result;
}

function LoadOrgSchedule()
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

    $sql = "select * from SCHEDULE where OrgID = :id";

    if ($_POST['startdate'] != "") {
        $sql .= " and OnDate >= :startdate";
    }

    if ($_POST['enddate'] != "") {
        $sql .= " and OnDate <= :enddate";
    }

    if ($_POST['vaccine'] != "") {
        $sql .= " and VaccineID = :vaccine";
    }

    $sql .= " order by OnDate";

    $command = oci_parse($connection, $sql);

    oci_bind_by_name($command, ':id', $_SESSION['OrgProfile']->get_id());
    if ($_POST['startdate'] != "")
        oci_bind_by_name($command, ':startdate', $_POST['startdate']);
    if ($_POST['enddate'] != "")
        oci_bind_by_name($command, ':enddate', $_POST['enddate']);
    if ($_POST['vaccine'] != "")
        oci_bind_by_name($command, ':vaccine', $_POST['vaccine']);


    $r = oci_execute($command);
    if (!$r) {
        $exception = oci_error($command);
        echo '<script>ERROR: ' . $exception['code'] . ' - ' . $exception['message'] . '</script>';
        return;
    }

    $result = "";
    while (($row = oci_fetch_array($command, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
        $CancelButton = "";
        if ($row['ONDATE'] > date("Y-m-d"))
            $CancelButton = '<button class="btn-short-bordered btn-cancel">Hủy</button>';

        $result .=
            '<div class="schedule object" id="' . $row['ID'] . '">
                        <div class="holder-schedule">
                            <div class="obj-attr">
                                <p class="attr-date-vaccine-serial">Ngày tiêm: ' . $row['ONDATE'] . ' - Vaccine:
                                ' . $row['VACCINEID'] . ' - ' . $row['SERIAL'] . '</p>
                                <div class="attr-time">'
            . '<p>Buổi sáng: ' . $row['DAYREGISTERED'] . '/</p><p class="day" id="' . $row['LIMITDAY'] . '">' . $row['LIMITDAY'] . '</p>'
            . '<p>&nbsp- Buổi trưa: ' . $row['NOONREGISTERED'] . '/</p><p class="noon" id="' . $row['LIMITNOON'] . '">' . $row['LIMITNOON'] . '</p>'
            . '<p>&nbsp- Buổi tối: ' . $row['NIGHTREGISTERED'] . '/</p><p class="night" id="' . $row['LIMITNIGHT'] . '">' . $row['LIMITNIGHT'] . '</p>'
            . '</div>
                            </div>
                            <div class="interactive-area">
                                <button class="btn-medium-filled btn-registration">Lượt đăng ký</button>
                                <button class="btn-medium-bordered btn-update">Cập nhật</button>
                                ' . $CancelButton . '
                            </div>
                        </div>
                        <div class="holder-btn-expand-schedule">
                            <div class="btn-expand-schedule"> > </div> 
                        </div>
                    </div>';
    }

    echo $result;
}