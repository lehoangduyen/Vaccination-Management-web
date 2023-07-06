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
    <link rel="stylesheet" href="css/CitizenAccountInfo.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/WebElements.js"></script>
    <script src="js/CitizenAccountInfo.js"></script>
    <script src="js/AccountUpdate.js"></script>
    <title>Thông tin tài khoản</title>
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

    <div class="holder-function-panel">
        <!-- MENU -->
        <?php
        include("function-menu.php");
        ?>
        <!-- END MENU -->

        <!-- FUNCTIONAL PANEL -->
        <div class="function-panel">
            <div class="accinfo-panel">
                <div class="frame">
                    <div class="account">
                        <br>
                        <p>Tài khoản</p>
                        <br>
                        <label for="phone">Số điện thoại</label><br>
                        <?php echo'<input type="text" name="phone" required value="'.$citizen->get_phone().'">' ?><br>
                        <hr>
                        <div class="message msg1"></div>
                        <br>
                        <label for="password">Nhập mật khẩu hiện tại</label><br>
                        <input type="password" name="password" required value=""><br>
                        <hr>
                        <div class="message msg2"></div>
                    </div>
                </div>

                <div class="frame">
                    <div class="change-pass">
                        <br>
                        <p>Đổi mật khẩu</p>
                        <br>
                        <label for="new-password">Mật khẩu mới</label><br>
                        <input type="password" name="new-password" required value=""><br>
                        <hr>
                        <div class="message msg1"></div>
                        <br>
                        <label for="repeat-new-password">Nhập mật khẩu mới</label><br>
                        <input type="password" name="repeat-new-password" required value=""><br>
                        <hr>
                        <div class="message msg2"></div>
                    </div>
                </div>
            </div>

            <div class="group_btn">
                <button class="btn-medium-filled" id="update-account-info">Cập nhật</button>
                <button class="btn-medium-bordered" id="cancel-update-account-info">Hủy bỏ</button>
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