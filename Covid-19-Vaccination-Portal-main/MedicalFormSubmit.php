<?php
error_reporting(E_ERROR | E_PARSE);
define('browsable', true);

include("object_Account.php");
include("object_Citizen.php");
session_start();
$checkUser = true;

// if logged in account has not register a profile then head to index.php
if (isset($_SESSION['AccountInfo']) == false)
    $checkUser = false;
else
    if ($_SESSION['AccountInfo']->get_role() != 2)  //if logged in account was a org acc then header to index.php
    header("location: index.php");

// if there is not any profile was queried then head to index
if (isset($_SESSION['CitizenProfile']) == false)
    $checkUser = false;
else {
    include("CitizenLoadProfile.php");
    $citizen = $_SESSION['CitizenProfile'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/MedicalFormSubmit.css">
    <link rel="stylesheet" href="css/filter-panel.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/MedicalFormSubmit.js"></script>
    <script src="js/index.js"></script>
    <script src="js/WebElements.js"></script>
    <title>Tờ khai y tế</title>
</head>

<body>
    <!-- HEADER -->
    <div id="return-header">
        <?php
        if ($checkUser)
            include("headerCitizen.php");
        else
            include("headerGeneral.php");
        ?>
    </div>

    <!-- END HEADER -->

    <!-- NAV FUNCTION -->
    <?php
    include("function-navigation-bar.php");
    ?>
    <!-- END NAV FUNCTION -->
    <br>

    <!-- FUNCTION PANEL -->
    <div class="holder-function-panel">
        <!-- MENU -->
        <?php
        include("function-menu.php");
        ?>
        <!-- END MENU -->

        <div class="function-panel">
            <br>
            <?php
            if ($checkUser == true)
                echo '
            <div class="panel-target-citizen">
                <p>Đối tượng: </p>
                <select name="" id="">
                    <option value="' . $citizen->get_ID() . '">' . $citizen->get_fullname() . '</option>
                </select>
            </div>'
            ?>
            <br>

            <div class="panel-form-medical">
                <div class="form-medical">
                    <div class="input_date">
                        <label for="input_date">Ngày thực hiện khai báo:
                        </label>
                        <input type="date" id="input-date">
                    </div>
                    <p>Trong vòng 14 ngày qua, Anh/Chị có thấy xuất hiện ít nhất 1 trong các dấu hiệu:
                        ho, khó thở, viêm phổi, đau họng, mệt mỏi không?
                    </p>
                    <div class="form-btn-input">
                        <label for="q1_no">Không</label>
                        <input type="radio" name="q1" id="q1_no" value="0" checked="checked">
                        <label for="q1_yes">Có</label>
                        <input type="radio" name="q1" id="q1_yes" value="1">
                    </div>

                    <p>Trong vòng 14 ngày qua, Anh/Chị có tiếp xúc với Người bệnh hoặc nghi ngờ, mắc bệnh Covid-19 không?
                    </p>
                    <div class="form-btn-input">
                        <label for="q2_no">Không</label>
                        <input type="radio" name="q2" id="q2_no" value="0" checked="checked">
                        <label for="q2_yes">Có</label>
                        <input type="radio" name="q2" id="q2_yes" value="1">
                    </div>

                    <p>Anh/Chị có đang dương tính với Covid-19 không?
                    </p>
                    <div class="form-btn-input">
                        <label for="q3_no">Không</label>
                        <input type="radio" name="q3" id="q3_no" value="0" checked="checked">
                        <label for="q3_yes">Có</label>
                        <input type="radio" name="q3" id="q3_yes" value="1">
                    </div>

                    <p>Anh/Chị có đang là đối tượng trì hoẵn tiêm chủng vaccine Covid-19
                        hoặc đang là đối tượng chống chỉ định tiêm chủng Covid-19 không?
                    </p>
                    <div class="form-btn-input">
                        <label for="q4_no">Không</label>
                        <input type="radio" name="q4" id="q4_no" value="0" checked="checked">
                        <label for="q4_yes">Có</label>
                        <input type="radio" name="q4" id="q4_yes" value="1">
                    </div>
                    <br>
                    <div class="form-btn-input">
                        <button class="btn-medium-filled" id="btn-submit">Xác nhận</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END FUNCTION PANEL -->
    <br>

    <?php
    include("WebElements.php");
    include("SignupLoginForm.php");
    include("footer.php");
    ?>
</body>

</html>