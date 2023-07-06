<?php
error_reporting(E_ERROR | E_PARSE);
if (!defined('browsable')) {
    header("location:javascript://history.go(-1)");
}
?>

<link rel="stylesheet" href="css/HomepageSlider.css">

<div class="slider">

    <div class="slideshow-container">

        <div class="mySlides fade">
            <img src="image/banner_with_flag.png" style="width:100%">
        </div>

        <div class="mySlides fade">
            <img src="image/banner_covid19.png" style="width:100%">
        </div>

        <div class="mySlides fade">
            <img src="image/banner_vaccine.png" style="width:100%">
        </div>

        <div class="mySlides fade">
            <img src="image/banner_codong.png" style="width:100%">
        </div>

    </div>

    <div class="frame-slider_dot" style="text-align:center">
        <span class="slider_dot"></span>
        <span class="slider_dot"></span>
        <span class="slider_dot"></span>
        <span class="slider_dot"></span>
    </div>

    <script type="text/javascript" src="js/main.js"></script>
</div>