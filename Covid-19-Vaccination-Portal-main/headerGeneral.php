<?php
error_reporting(E_ERROR | E_PARSE);
if (!defined('browsable')) {
    header("location:javascript://history.go(-1)");
}
?>

<link rel="stylesheet" href="css/style.css">
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
                <!-- <a href="MedicalFormSubmit.php">
                    <li class="menu-section">Khai báo</li>
                </a> -->
            </ul>
        </div>
        <button class="btn-login" id="btn-login">Đăng nhập</btn>
    </div>
</div>

<div class="header-virtual"></div>