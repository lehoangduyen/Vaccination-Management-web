$(document).ready(function () {
    // LOAD FRONT END DATA
    headerNav = '<a href="index.php">'
        + '<li class="menu-section">Trang chủ</li>'
        + '</a>'
        + '<a href="#">'
        + '<li class="menu-section">Lịch tiêm</li>'
        + '</a>'
        + '<a href="#">'
        + '<li class="menu-section">Tiêm chủng</li>'
        + '</a>'
        + '<a href="#">'
        + '<li class="menu-section">Thống kê</li>'
        + '</a>'

    $('.header .nav ul').html(headerNav)

    user_button = '<button class="btn-login" id="btn-login">Đăng nhập</btn>'
    $('.header .nav').append(user_button)
    // END LOAD FRONT END DATA
})