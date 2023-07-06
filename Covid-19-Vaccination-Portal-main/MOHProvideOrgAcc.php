<?php
error_reporting(E_ERROR | E_PARSE);
define('browsable', true);

include("object_Account.php");
include("object_Organization.php");
session_start();

// if logged in account has not register a profile then head to index.php
if (isset($_SESSION['AccountInfo']) == false)
    header("location:javascript://history.go(-1)");
// if not have the right role then return to index
else if ($_SESSION['AccountInfo']->get_role() != 0)
    header("location:javascript://history.go(-1)");

// if there is not any profile was queried then head to index
if (isset($_SESSION['OrgProfile']) == false)
    header("location:javascript://history.go(-1)");

$org = $_SESSION['OrgProfile'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/btn.css">
    <link rel="stylesheet" href="css/filter-panel.css">
    <link rel="stylesheet" href="css/MOHProvideAccount.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/MOHProvideOrgAcc.js"></script>
    <script src="js/index.js"></script>
    <script src="js/WebElements.js"></script>
    <title>Cấp tài khoản đơn vị tiêm chủng</title>
</head>

<body>
    <!-- HEADER -->
    <?php
    include("headerMOH.php");
    ?>
    <!-- END HEADER -->

    <!-- NAV FUNCTION -->
    <?php
    include("function-navigation-bar.php");
    ?>
    <!-- END NAV FUNCTION -->
    <br>

    <div class="holder-function-panel">
        <!-- MENU -->
        <?php
        include("function-menu.php");
        ?>
        <!-- END MENU -->

        <!-- FUNCTIONAL PANEL -->
        <div class="function-panel">
            <div class="provide-panel">
                <div class="frame">
                    <div class="provide-account">
                        <p>Tạo tài khoản đơn vị</p>
                        <label for="city">Tỉnh/Thành phố </label><br>
                        <select name="city" id="select-province">
                            <?php
                            $str = file_get_contents('local.json');
                            $local = json_decode($str, true); // decode the JSON into an associative array
                            $provincecode = -1;
                            for ($i = 0; $i < 63; $i++) {
                                echo '<option value="' . $i . '">' . $local[$i]['name'] . '</option>';
                            }
                            ?>
                        </select>
                        <hr>
                        <br>
                        <label for="num">Số lượng tài khoản cần tạo</label><br>
                        <input type="text" name="num" id="account-quantity" required value=""><br>
                        <hr>
                    </div>
                </div>
            </div>

            <div class="group_btn">
                <button class="btn-medium-filled" id="btn-confirm-acc-creation">Xác nhận</button>
                <button class="btn-medium-bordered" id="close_reg_person_profile">Hủy bỏ</button>
            </div>

        </div>
    </div>

    <br>
    <?php
    include("footer.php");
    include("WebElements.php");
    ?>
</body>

</html>