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
    <link rel="stylesheet" href="css/ORGCreatePost.css">
    <link rel="stylesheet" href="css/filter-panel.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/ORGCreatePost.js"></script>
    <script src="js/WebElements.js"></script>
    <title>Văn bản</title>
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

            <div class="panel-list-post">
                <?php
                echo '
                    <div class="list-name orgid" id="' . $org->get_id() . '">' . $org->get_name() . '</div>'
                ?>
                <div class="holder">
                    <div class="panel-update-post" id="panel-update-post">
                        <div class="title">THIẾT LẬP THÔNG BÁO</div>
                        <div class="container">
                            <div class="container-select-date-vaccine">
                                <label for="post-date" class="">Ngày đăng thông báo</label>
                                <input id="post-date" type="date" min="<?php echo date("Y-m-d"); ?>">

                                <label for="serial" class="">Số hiệu thông báo</label>
                                <input id="serial" type="text">

                                <label for="title" class="">Tiêu đề thông báo</label>
                                <input id="title" type="text">
                            </div>
                            <div class="container-update-value">
                                <label for="file-text" class="">Tải lên file nội dung (.txt)</label>
                                <input type="file" id="input-browse-text" name="input-browse-text">
                                <textarea id="outputtext"  rows="4" cols="50"></textarea>

                                <label for="file-image" class="">Tải lên file hình ảnh (.jpg)</label>
                                <input type="file" id="input-browse-image" name="input-browse-image" onchange="readURL(this);">
                                <img id="outputimage" src="#" alt="your image" />
                            </div>
                        </div>
                        <button class="btn-medium-bordered" id="btn-confirm-create-post">Xác nhận</button>

                    </div>
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