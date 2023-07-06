<?php
error_reporting(E_ERROR | E_PARSE);
if (!defined('browsable')) {
    header("location:javascript://history.go(-1)");
}
?>

<!-- LOGIN FORM -->
<link rel="stylesheet" href="css/SignupLoginForm.css">

<div class="form-container" id="form-container-login">
    <form class="form form-login" id="form-login" method="POST" action="HandleLogin.php">
        <p class="btn-close" id="btn-close-form-login">X</p>
        <p class="title">Đăng nhập</p>
        <br><br>
        <label for="username"><b>SĐT/Tên tài khoản</b></label>
        <input type="text" name="username" required>
        <hr class="form-hr">
        <div class="message msg1"></div>
        <br><br>

        <label for="password"><b>Mật khẩu</b></label>
        <input type="password" name="password" required>
        <hr class="form-hr">
        <div class="message msg2"></div>

        <div class="btn-linked-page page-reg-acc page-forgot-pass">
            <p id="btn-forgot-password" href="#">Quên mật khẩu</p>
            <p id="btn-create-account">Tạo tài khoản</p>
        </div>
        <br><br>
        <div class="btn-long" id="btn-login-in-form-login">Đăng nhập</div>
    </form>
</div>
<!-- END LOGIN FORM -->

<!-- REGISTRATION ACCOUNT FORM -->
<div class="form-container" id="form-container-reg-acc">
    <form class="form form-reg-acc" id="form-reg-acc" action="/action_page.php">
        <p class="btn-close" id="btn-close-form-reg-acc">X</p>
        <p class="title">Đăng ký</p>
        <br><br>
        <label for="phone_number"><b>Số điện thoại</b></label>
        <input type="tel" name="phone_number" pattern="[0-9]{4}-[0-9]{3}-[0-9]{4}" required>
        <hr class="form-hr">
        <div class="message msg1" value=""></div>
        <br><br>
        <label for="password"><b>Mật khẩu</b></label>
        <input type="password" name="password" required>
        <hr class="form-hr">
        <div class="message msg2"></div>
        <br><br>
        <label for="repeat-password"><b>Nhập lại mật khẩu</b></label>
        <input type="password" name="repeat-password" required>
        <hr class="form-hr">
        <div class="message msg3"></div>
        <br><br>
        <div class="btn-long" id="btn-reg-acc">Đăng ký</div>
        <div class="btn-linked-page page-login">
            <p id="btn-login-in-form-reg-acc">Đăng nhập</p>
        </div>
        <br>
    </form>
</div>
<!-- END REGISTRATION ACCOUNT FORM -->

<!-- REGISTRATION PERSONAL PROFILE FORM -->
<div class="container-reg-profile" id="container-reg-profile">
    <p class="title">Đăng ký thông tin cá nhân</p>

    <div class="row1">
        <div>
            <label for="lastname">Họ và tên đệm</label><br>
            <input type="text" name="lastname" required><br>
            <hr class="form-hr">
            <div class="message msg1"></div>
        </div>

        <div>
            <label for="firstname">Tên <span>(*)</span></label><br>
            <input type="text" name="firstname" required><br>
            <hr class="form-hr">
            <div class="message msg2"></div>
        </div>

        <div>
            <label for="gender">Giới tính <span>(*)</span></label><br>
            <select name="gender" id="">
                <option value="1">Nam</option>
                <option value="0">Nữ</option>
                <option value="2">Khác</option>
            </select>
            <hr class="form-hr">
            <div class="message msg3"></div>
        </div>
    </div>

    <div class="row2">
        <div>
            <label for="id">Mã định danh <span>(*)</span></label><br>
            <input type="text" name="id" required><br>
            <hr class="form-hr">
            <div class="message msg4"></div>
        </div>

        <div>
            <label for="birthday">Ngày tháng năm sinh <span>(*)</span></label><br>
            <input type="date" name="birthday" required><br>
            <hr class="form-hr">
            <div class="message msg5"></div>
        </div>

        <div>
            <label for="hometown">Quê quán <span>(*)</span></label><br>
            <select name="hometown" id="select-hometown">
                <option value=""></option>
            </select>
            <hr class="form-hr">
            <div class="message msg6"></div>
        </div>
    </div>

    <p>Địa chỉ thường trú:</p>

    <div class="row3">
        <div>
            <label for="city">Tỉnh/Thành phố <span>(*)</span></label><br>
            <select name="city" id="select-province">
                <option value=""></option>
            </select>
            <hr class="form-hr">
            <div class="message msg7"></div>
        </div>

        <div>
            <label for="district">Quận/Huyện <span>(*)</span></label><br>
            <select name="district" id="select-district">
                <option value=""></option>
            </select>
            <hr class="form-hr">
            <div class="message msg8"></div>
        </div>

        <div>
            <label for="town">Xã/Phường/Thị trấn <span>(*)</span></label><br>
            <select name="town" id="select-town">
                <option value=""></option>
            </select>
            <hr class="form-hr">
            <div class="message msg9"></div>
        </div>
    </div>

    <div class="row4">
        <label for="street">Số nhà, tên đường, khu phố/ấp</label><br>
        <input type="text" name="street" required><br>
        <hr class="form-hr">
        <div class="message msg10"></div>
    </div>

    <div class="row5">
        <label for="email">Email</label><br>
        <input type="text" name="email" required><br>
        <hr class="form-hr">
        <div class="message msg11"></div>
    </div>

    <div class="row6">
        <div class="note">
            <span>Lưu ý:</span>
            <ul>
                <li>Việc đăng ký thông tin hoàn toàn bảo mật và phục vụ cho chiến dịch tiêm chủng Vắc xin COVID-19.</li>
                <li>Xin vui lòng kiểm tra kỹ các thông tin bắt buộc(VD: Họ và tên, Ngày tháng năm sinh, Số điện thoại,
                    CCCD/Mã định danh công dân/HC ...)</li>
                <li>Bằng việc nhấn nút "Đăng kí", bạn hoàn toàn hiểu và đồng ý chịu trách nhiệm với các thông tin đã
                    cung cấp.</li>
            </ul>
        </div>

        <div class="group_button">
            <button class="btn-long" id="btn-reg-profile">Đăng ký</button>
            <button class="btn-long-bordered" id="btn-close-form-reg-profile">Hủy bỏ</button>
        </div>
    </div>
</div>

<!-- END REGISTRATION PERSONAL PROFILE FORM -->

<!-- FORGOT PASSWORD FORM -->
<div class="form container-forgot-password" id="container-forgot-password">
    <p class="title">Quên mật khẩu</p>
    <br>
    <div class="fg">
        <label for="username">SĐT/Tên tài khoản</label>
        <input type="text" name="username" required>
        <hr class="form-hr">
        <div class="message msg1"></div>
    </div>

    <div class="verifind_account fg">
        <label for="capcha">Nhập mã xác nhận</label>
        <input type="text" name="capcha" required>
        <hr class="form-hr">
        <div class="message msg2"></div>
    </div>
    <div class="new_password fg">
        <label for="password">Mật khẩu mới</label>
        <input type="password" name="password" required>
        <hr class="form-hr">
        <br>
        <div class="message msg3"></div>
        <label for="repeat-password">Nhập lại mật khẩu mới</label>
        <input type="password" name="repeat-password" required>
        <hr class="form-hr">
        <div class="message msg4"></div>
    </div>

    <br>
    <div class="btn-long" id="btn-reset-password">Xác nhận</div>

</div>
<!-- END FORGOT PASSWORD FORM -->