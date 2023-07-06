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
// if not have the right role then return to index
else if ($_SESSION['AccountInfo']->get_role() != 2)
    header("location:javascript://history.go(-1)");

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
    <link rel="stylesheet" href="css/MedicalFormList.css">
    <link rel="stylesheet" href="css/filter-panel.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/MedicalFormList.js"></script>
    <script src="js/index.js"></script>
    <script src="js/WebElements.js"></script>
    <title>Danh sách tờ khai</title>
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

            <div class="filter-panel-medical" id="filter-form_list">
                <div class="select-date">
                    <label for="form-date">Tờ khai trong vòng:</label>
                    <select type="text" name="form-date" id="form-date">
                        <option value=7>7 ngày</option>
                        <option value=15>15 ngày</option>
                        <option value=30>30 ngày</option>
                        <option value=60>60 ngày</option>
                    </select>
                </div>
                <button class="btn-medium-bordered-icon btn-filter" id="btn-filter-org">
                    Tìm kiếm
                </button>
            </div>

            <div class="panel-list" id="panel-list">
                <div class="holder-form-medical" id="holder-form-medical">
                    <!-- <div class="form-medical">
                        <p class="title">Đối tượng: Đặnghiệp Cường</p>
                        <p class="date">Ngày thực hiện khai báo</p>
                        <p class="detail">Sức khỏe bình thường</p>
                    </div>
                    <div class="form-medical">
                        <p class="title">Đối tượng: Đặng Cường</p>
                        <p class="date">Ngày thực hiện khai báo</p>
                        <p class="detail">Sức khỏe bình thường</p>
                    </div> -->
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