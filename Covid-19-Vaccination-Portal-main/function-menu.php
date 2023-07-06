<?php
error_reporting(E_ERROR | E_PARSE);
if (!defined('browsable')) {
    header("location:javascript://history.go(-1)");
}
?>

<link rel="stylesheet" href="css/function-menu.css">

<div class="function-menu-panel">
    <br><br>
    <div class="title" id="function-menu-title"></div>
    <div class="title-bg"></div>
    <br>
    <div class="menu" id="function-menu-list">
        <ul class="list">
        </ul>
    </div>
</div>