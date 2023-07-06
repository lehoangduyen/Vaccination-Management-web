<?php
error_reporting(E_ERROR | E_PARSE);
define('browsable', true);

include("object_Account.php");
include("object_Citizen.php");
session_start();

// if logged in account has not register a profile then head to index.php
if (isset($_SESSION['AccountInfo']) == false)
    header("location:javascript://history.go(-1)");
// if not have the right role then return to index
else if ($_SESSION['AccountInfo']->get_role() != 2)
    header("location:javascript://history.go(-1)");

// if there is not any profile was queried then head to index
if (isset($_SESSION['CitizenProfile']) == false)
    header("location:javascript://history.go(-1)");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/CitizenVaccinationProfile.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/CitizenVaccinationProfile.js"></script>
    <script src="js/WebElements.js"></script>
    <title>Tra cứu thông tin tiêm chủng công dân</title>


</head>

<body>
    <!-- Header -->
    <?php
    include("headerCitizen.php")
    ?>
    <!-- End Header -->

    <!-- NAV FUNCTION -->
    <?php
    include("function-navigation-bar.php");
    ?>
    <!-- END NAV FUNCTION -->
    <br>

    <!-- Func Panel -->
    <div class="holder-function-panel">
        <!-- MENU -->
        <?php
        include("function-menu.php");
        ?>
        <!-- END MENU -->

        <div class="function-panel">
            <br>

            <div class="panel-target-citizen">
                <p>Thông tin tiêm chủng</p>
            </div>

            <br>
            <div class="panel-search-citizen">
                <div class="filter-panel">
                    <label class="text" name="CMND/CCCD" id="CMND/CCCD">CMND/CCCD:</label>
                    <input type="text">

                    <label>Tỉnh/Thành phố:</label>
                    <input type="text" name="Province" id="province">
                </div>

                <button class="btn-medium-bordered-icon">
                    <img src="image/filter-magnifier.png" alt="filter-magnifier">
                    Tìm kiếm
                </button>
            </div>

            <br>

            <div class="panel-vaccinationprofile">
                <div class="panel-infovaccination">
                    <label>Mũi:</label>
                    <label>Vaccine: </label>
                    <br>
                    <label>Đơn vị tiêm chủng:</label>
                    <br>
                    <label>Lịch tiêm:</label>
                </div>

            </div>
        </div>
    </div>
    <br>



    <!-- FOOTER -->
    <?php
    include("footer.php");
    ?>
    <!-- END FOOTER -->
</body>

</html>