<?php
error_reporting(E_ERROR | E_PARSE);
if (!defined('browsable')) {
    header("location:javascript://history.go(-1)");
}
?>

<link rel="stylesheet" href="css/header.css">
<script src="js/header.js"></script>

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

                <a href="VaccinationStatistics.php">
                    <li class="menu-section">Thống kê</li>
                </a>

                <a href="SearchInformation.php">
                    <li class="menu-section">Tra cứu</li>
                </a>

                <a href="MOHManageOrg.php">
                    <li class="menu-section">Các đơn vị</li>
                </a>
            </ul>
        </div>

        <a class="avatar" href="#">
            <img src="image/Avatar-MOH.png" alt="Avata Bộ Y Tế">
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
                    <li>Thông tin đơn vị</li>
                </a>

                <a href="ORGProfile.php">
                    <li>Văn bản</li>
                </a>

                <a href="" id="btn-logout">
                    <li>Đăng xuất</li>
                </a>
            </ul>
        </div>
    </div>
    <!-- END DROP DOWN MENU PROFILE -->
</div>

<div class="header-virtual"></div>
<!-- END HEADER -->