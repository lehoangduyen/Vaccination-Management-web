<?php
error_reporting(E_ERROR | E_PARSE);
if (!defined('browsable')) {
    header("location:javascript://history.go(-1)");
}
?>

<link rel="stylesheet" href="css/function-navigation-bar.css">

<div class="function-navigation-bar">
    <div class="function-title" id="function-navigation-bar-title">
    </div>
    <div class="nav-directory">
        <div class="directory" id="homepage-path">
        </div>

        <div class="dicrectory">&nbsp;/&nbsp;</div>

        <div class="directory" id="subpage-path">
        </div>

        <div class="dicrectory">&nbsp;/&nbsp;</div>

        <div class="directory-selected" id="selected-function-path">
        </div>
    </div>
</div>