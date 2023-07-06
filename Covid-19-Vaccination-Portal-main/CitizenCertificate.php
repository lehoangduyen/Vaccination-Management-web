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

$citizen = $_SESSION['CitizenProfile'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/CitizenCertificate.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/CitizenCertificate.js"></script>
    <script src="js/WebElements.js"></script>
    <title>Chứng nhận tiêm chủng</title>
</head>

<body>
    <!-- HEADER -->
    <?php
    include("headerCitizen.php");
    ?>
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
            <div class="panel-target-citizen">
                <p>Đối tượng: </p>
                <select name="" id="">
                    <option value="<?php echo $citizen->get_id() ?>"><?php echo $citizen->get_lastname() . ' ' . $citizen->get_firstname() ?></option>
                </select>
            </div>
            <br>

            <div class="panel-certificate">
                <div class="info">
                    <img src="image/Avata-Ceritificate.png" alt="">
                    <p id="name"><?php echo $citizen->get_lastname() . ' ' . $citizen->get_firstname() ?></p>
                    <p id="sex_birthday"><?php echo $citizen->get_gender() ?></p>
                    <p id="birthday"><?php $date=date_create($citizen->get_birthday());
                     echo date_format($date,"d-m-Y") ?></p>
                </div>

                <div class="certificate">
                    <div class="list-injection" id="list-injection">
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <br>
    <?php
    include("footer.php")
    ?>

</body>

</html>