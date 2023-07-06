<?php
error_reporting(E_ERROR | E_PARSE);
define('browsable', true);

include("object_Form.php");
session_start();

include("DatabaseConnection.php");

$sql = "select * from FORM where CitizenID = :citizenid and (to_date(filleddate,'DD-MM-YYYY') > (to_date(CURRENT_DATE,'DD-MM-YYYY') - :formdate)) order by FilledDate desc, ID desc"; //SQL string
$command = oci_parse($connection, $sql);                    //Prepare statement before execute
oci_bind_by_name($command, ':citizenid', $_SESSION['CitizenProfile']->get_id());
oci_bind_by_name($command, ':formdate', $_POST['formdate']);
$r = oci_execute($command);                                     //execute
if (!$r) {                                                      //if false (error)
    $exception = oci_error($command);                           //catch exception
    echo 'ERROR: ' . $exception['code'] . ' - ' . $exception['message'];
    return;
}

$result = "";
while (($row = oci_fetch_array($command, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {

    $form = new Form();
    $form->set_filleddate($row['FILLEDDATE']);
    $form->set_choice($row['CHOICE']);
    $form->set_id($row['ID']);
    $date = date_create($form->get_filleddate());

    if ($form->get_choice() == "0000") {
        $result .=
            '<div class="form-medical">               
                    <p class="title">Đối tượng: ' . $_SESSION['CitizenProfile']->get_fullname() . ' (ID: ' . $_SESSION['CitizenProfile']->get_id() .')</p>
                    <p class="date">Ngày thực hiện khai báo: ' . date_format($date,"d-m-Y") . '</p>
                    <p class="detail-good">Sức khỏe bình thường - Đạt điều kiện sức khỏe tiêm chủng</p>                               
            </div>';
    } else {
        $result .=
            '<div class="form-medical">               
                    <p class="title">Đối tượng: ' . $_SESSION['CitizenProfile']->get_fullname() . ' (ID: ' . $_SESSION['CitizenProfile']->get_id() .')</p>
                    <p class="date">Ngày thực hiện khai báo: ' . date_format($date,"d-m-Y") . '</p>
                    <p class="detail-bad">Sức khỏe không tốt/không đảm bảo</p>                 
            </div>';
                
    }
}
echo $result;
return;
