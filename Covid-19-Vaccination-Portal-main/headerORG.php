<?php
error_reporting(E_ERROR | E_PARSE);
if (!defined('browsable')) {
    header("location:javascript://history.go(-1)");
}
?>

<link rel="stylesheet" href="css/header.css">
<script src="js/header.js"></script>

<!-- HEADER -->
<div class="header">
    <a class="title" href="index.php">
        <img src="image/CVM-Logo.png" alt="CVM-Logo">
        <span>CỔNG THÔNG TIN TIÊM CHỦNG COVID-19</span>
    </a>

    <div class="nav">
        <div>
            <ul>
                <a href="index.php">
                    <li class="menu-section">Trang chủ</li>
                </a>
                
                <a href="ORGSchedule.php">
                    <li class="menu-section" id="menu-section-schedule">Lịch tiêm</li>
                </a>

                <a href="VaccinationStatistics.php">
                    <li class="menu-section">Thống kê</li>
                </a>
            </ul>
        </div>
        <a class="avatar" href="#">
            <img src="image/Avatar-ORG.png" alt="Avata đơn vị tiêm chủng">
        </a>
    </div>

    <!-- DROP DOWN MENU PROFILE -->
    <div class="drop-down-menu" id="drop-down-menu-profile">
        <div class="holder">
            <ul>
                <a href="ORGAccountInfo.php">
                    <li>Thông tin tài khoản</li>
                </a>

                <a href="ORGProfile.php">
                    <li>Thông tin tổ chức</li>
                </a>

                <a href="" id="btn-logout">
                    <li>Đăng xuất</li>
                </a>
            </ul>
        </div>
    </div>
    <!-- END DROP DOWN MENU PROFILE -->

    <!-- DROP DOWN MENU SCHEDULE -->
    <div class="drop-down-menu" id="drop-down-menu-schedule">
        <div class="holder">
            <ul>
                <a href="ORGSchedule.php">
                    <li>Danh sách lịch tiêm</li>
                </a>

                <a href="ORGCreateSchedule.php">
                    <li>Tạo lịch tiêm chủng</li>
                </a>
            </ul>
        </div>
    </div>
    <!-- END DROP DOWN MENU SCHEDULE -->

    <!-- DROP DOWN MENU POST -->
    <div class="drop-down-menu" id="drop-down-menu-post">
        <div class="holder">
            <ul>
                <a href="">
                    <li>Danh sách thông báo</li>
                </a>

                <a href="ORGCreatePost.php">
                    <li>Thiết lập thông báo</li>
                </a>
            </ul>
        </div>
    </div>
    <!-- END DROP DOWN MENU POST -->
</div>

<div class="header-virtual"></div>
<!-- END HEADER -->