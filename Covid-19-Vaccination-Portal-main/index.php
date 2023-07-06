<?php
error_reporting(E_ERROR | E_PARSE); //Turn off warnings, errors still be alerted.
/* define('browsable', true);  
Define a variable named browsable = true on every php pages that can be accessed by users.
Pages not defined this variable at first are checked the existence of its,
this trick is used to prevent the direct access to separated elements files (such as: header, footer, etc.).
Then the pages can be defined (or not) for the same using purpose.
*/
define('browsable', true);           

/*
These included .php files mean the php code inside is stand right the place it is placed
At the very first lines of the code (before handling almost everything), 
there is an if statement used to check the existence of the variable named 'browsable'.
It means that only pages which defined the 'browsable' variable can access the included code.
Browser can not read these file alone because of the prevention has been set.
*/
include("object_Account.php");
include("object_Citizen.php");
include("object_Organization.php");
session_start();
$citizen = new Citizen();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cổng thông tin tiêm chủng Covid-19</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/index.js"></script>
    <script src="js/WebElements.js"></script>
    <script src="VaccinationStatistics.php"></script>
    <script src="VaccinationStatistics.js"></script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
</head>

<body>
    <!-- HEADER -->
    <div id="return-header">
        <?php
        if (isset($_SESSION['AccountInfo']) && $_SESSION['AccountInfo']->get_status() == 1) {
            switch ((int)$_SESSION['AccountInfo']->get_role()) {
                case 0:
                    if (isset($_SESSION['OrgProfile']) == false) {
                        include("OrgLoadProfile.php");
                    }
                    include("headerMOH.php");
                    break;
                case 1:
                    if (isset($_SESSION['OrgProfile']) == false) {
                        include("OrgLoadProfile.php");
                    }
                    include("headerORG.php");
                    break;
                case 2:
                    if (isset($_SESSION['CitizenProfile']) == false) {
                        include("CitizenLoadProfile.php");
                    }
                    include("headerCitizen.php");
                    break;
                default:
                    include("headerGeneral.php");
                    break;
            }
            // echo '<script>alert("' . $_SESSION['CitizenProfile']->get_fullname() . '")</script>';
        } else
            include("headerGeneral.php");
        ?>
    </div>
    <!-- END HEADER -->

    <!-- SLIDER -->
    <?php
    include("HomepageSlider.php");
    ?>
    <!-- END SLIDER -->

    <?php
    include("SignupLoginForm.php");
    include("WebElements.php");
    include("DataStatistics.php")
    ?>

    
<br>

    <!-- <div class="content">
        <div class="content-alignment-side"></div>
         <div class="content-box">
        </div>
        <div class="content-box"></div>
        <div class="content-box"></div>
        <div class="content-box"></div> -->
        <div class="content-alignment-side"></div>
    </div>
    <br>
    <!-- FOOTER -->
    <?php
    include("footer.php")
    ?>
    <!-- END FOOTER -->


    <?php
    // echo '<script>alert("' . $citizen->get_ID() . '")</script>';
    ?>
</body>
<script src="VaccinationStatistics.js"></script>

</html>