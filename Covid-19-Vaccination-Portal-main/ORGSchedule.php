<?php
error_reporting(E_ERROR | E_PARSE);
define('browsable', true);

include("object_Account.php");
include("object_Schedule.php");
session_start();

// if logged in account has not register a profile then head to index.php
if (isset($_SESSION['AccountInfo']) == false)
    header("location:javascript://history.go(-1)");
// if not have the right role then return to index
else if ($_SESSION['AccountInfo']->get_role() != 1)
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
    <link rel="stylesheet" href="css/ORGSchedule.css">
    <link rel="stylesheet" href="css/filter-panel.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/ORGSchedule.js"></script>
    <script src="js/WebElements.js"></script>
    <title>Lịch Tiêm</title>
</head>

<body>
    <!-- HEADER -->
    <?php
    include("headerORG.php");
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
        <div class="function-panel">
            <br>
            <?php
            echo '
                    <div class="list-name orgid" id="' . $org->get_id() . '">' . $org->get_name() . '</div>'
            ?>

            <div class="holder-list">
                <div class="list-name" id="list-name-schedule">DANH SÁCH LỊCH TIÊM</div>

                <div class="holder-right">
                    <div class="list-name list-name-registration" id=""></div>
                    <div class="list-name-scheduleinfo"></div>
                </div>
            </div>
            <div class="holder-filter-panel">
                <div class="filter-panel l" id="filter-schedule">
                    <label for="start-date">Từ ngày</label>
                    <input type="date" name="start-date" id="start-date">

                    <label for="end-date">Đến ngày</label>
                    <input type="date" name="end-date" id="end-date">
                </div>

                <div class="filter-panel r" id="filter-registration">
                    <label for="time">Buổi</label>
                    <select type="drop-down" name="time" id="time">
                        <option value="">Tất cả</option>
                        <option value="0">Sáng</option>
                        <option value="1">Chiều</option>
                        <option value="2">Tối</option>
                    </select>

                    <label for="status">Trạng thái</label>
                    <select type="text" name="status" id="status">
                        <option value="">Tất cả</option>
                        <option value="0">Đã đăng ký</option>
                        <option value="1">Đã điểm danh</option>
                        <option value="2">Đã tiêm</option>
                        <option value="3">Đã hủy</option>
                    </select>
                </div>
            </div>

            <div class="panel-list-schedule">



                <div class="holder">
                    <div class="list-schedule" id="list-schedule">
                    </div>

                    <div class="list-registration" id="list-registration">


                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- END FUNCTION PANEL -->
    <br>

    <?php
    include("footer.php");
    include("WebElements.php");
    ?>
</body>

</html>