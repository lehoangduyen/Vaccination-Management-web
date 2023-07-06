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
else if ($_SESSION['AccountInfo']->get_role() > 1)
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
    <link rel="stylesheet" href="css/ORGProfile.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/ORGProfile.js"></script>
    <script src="js/WebElements.js"></script>
    <title>Thông tin đơn vị tiêm chủng</title>
</head>

<body>
    <!-- HEADER -->
    <?php
    if ($_SESSION['AccountInfo']->get_role() == 0)
        include("headerMOH.php");
    else
        include("headerORG.php");
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
            <br>
            <div class="panel-target-citizen">
                <!-- <p>Đối tượng: </p> -->
                <?php echo '<p class="">Đơn vị: ' . $org->get_name() . '</p>' ?>
            </div>
            <br>

            <div class="info-panel" id="info-panel">
                <div class="row1">
                    <div>
                        <label for="id">Mã đơn vị tiêm chủng <span>(*)</span></label><br>
                        <?php echo '<input type="text" name="id" required value="' . $org->get_id() . '" disabled>' ?><br>
                        <hr>
                    </div>

                    <div class="item_name">
                        <label for="name">Tên đơn vị tiêm chủng <span>(*)</span></label><br>
                        <?php echo '<input type="text" name="name" required value="' . $org->get_name() . '">' ?><br>
                        <hr>
                    </div>
                </div>

                <div class="row2">
                    <div>
                        <label for="city">Tỉnh/Thành phố <span>(*)</span></label><br>
                        <select name="city" id="select-province" disabled>
                            <?php echo '<option value="">' . $org->get_provincename() . '</option>';
                            $str = file_get_contents('local.json');
                            $local = json_decode($str, true); // decode the JSON into an associative array
                            $provincecode = -1;
                            for ($i = 0; $i < 63; $i++) {
                                if ($local[$i]['name'] != $org->get_provincename())
                                    echo '<option value="' . $i . '">' . $local[$i]['name'] . '</option>';
                                else
                                    $provincecode = $i;
                            }
                            echo '<script>$("#select-province option:first-child").val(' . $provincecode . ')</script>';
                            ?>
                        </select>
                        <hr>
                    </div>

                    <div>
                        <label for="district">Quận/Huyện <span>(*)</span></label><br>
                        <select name="district" id="select-district">
                            <?php
                            echo '<option value="">' . $org->get_districtname() . '</option>';
                            $districtcode = -1;
                            $i = 0;
                            while (isset($local[$provincecode]['districts'][$i])) {
                                if ($local[$provincecode]['districts'][$i]['name'] != $org->get_districtname())
                                    echo '<option value="' . $i . '">' . $local[$provincecode]['districts'][$i]['name'] . '</option>';
                                else
                                    $districtcode = $i;
                                $i++;
                            }
                            echo '<script>$("#select-district option:first-child").val(' . $districtcode . ')</script>';
                            ?>
                        </select>
                        <hr>
                    </div>

                    <div>
                        <label for="town">Xã/Phường/Thị trấn <span>(*)</span></label><br>
                        <select name="town" id="select-town">
                            <?php
                            echo '<option value="">' . $org->get_townname() . '</option>';
                            $towncode = -1;
                            $i = 0;
                            while (isset($local[$provincecode]['districts'][$districtcode]['wards'][$i])) {
                                if ($local[$provincecode]['districts'][$districtcode]['wards'][$i]['name'] != $org->get_townname())
                                    echo '<option value="' . $i . '">' . $local[$provincecode]['districts'][$districtcode]['wards'][$i]['name'] . '</option>';
                                else
                                    $towncode = $i;
                                $i++;
                            }
                            echo '<script>$("#select-town option:first-child").val(' . $towncode . ')</script>';
                            ?>
                        </select>
                        <hr>
                    </div>
                </div>

                <div class="row3">
                    <label for="street">Số nhà, tên đường, khu phố/ấp <span>(*)</span></label><br>
                    <?php echo '<input type="text" name="street" required value="' . $org->get_street() . '">' ?><br>
                    <hr>
                </div>

                <div class="group_btn">
                    <button class="btn-medium-filled" id="update-profile">Cập nhật</button>
                    <button class="btn-medium-bordered" id="cancel-update-profile">Hủy bỏ</button>
                </div>
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