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

                <a href="MedicalFormSubmit.php">
                    <li class="menu-section">Khai báo</li>
                </a>

                <a href="CitizenVaccination.php">
                    <li class="menu-section">Tiêm chủng</li>
                </a>
            </ul>
        </div>

        <a class="avatar" href="#">
            <img src="image/Avatar-Citizen.png" alt="Avata công dân">
        </a>
    </div>

    <!-- DROP DOWN MENU PROFILE -->
    <div class="drop-down-menu" id="drop-down-menu-profile">
        <div class="holder">
            <ul>
                <a href="CitizenAccountInfo.php">
                    <li>Thông tin tài khoản</li>
                </a>

                <a href="CitizenProfile.php">
                    <li>Thông tin công dân</li>
                </a>

                <a href="CitizenRegistration.php">
                    <li>Lịch đăng ký</li>
                </a>

                <a href="CitizenCertificate.php">
                    <li>Chứng nhận</li>
                </a>

                <a href="CitizenVaccinationProfile.php">
                    <li>Tra cứu</li>
                </a>

                <a href="CitizenRelative.php">
                    <li>Thêm người thân</li>
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