<?php
error_reporting(E_ERROR | E_PARSE);
if (!defined('browsable')) {
    header("location:javascript://history.go(-1)");
}
?>

<div class="form-popup" id="form-popup-confirm">
    <p class="form-message"></p>
    <div class="holder-btn">
        <button class="btn-medium-filled btn-confirm">OK</button>
    </div>
</div>

<div class="form-popup" id="form-popup-option">
    <p class="form-message"></p>
    <div class="holder-btn">
        <button class="btn-medium-filled btn-confirm">Xác nhận</button>
        <button class="btn-medium-bordered btn-cancel">Hủy</button>
    </div>
</div>

<div class="form-popup" id="form-popup-option-cancel-registration">
    <p class="form-message"></p>
    <div class="holder-btn">
        <button class="btn-medium-filled btn-confirm">Xác nhận</button>
        <button class="btn-medium-bordered btn-cancel">Hủy</button>
    </div>
</div>

<!-- FADED COVER -->
<div class="gradient-bg-faded" id="gradient-bg-faded"></div>