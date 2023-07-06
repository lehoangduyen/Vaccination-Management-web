$(document).ready(function () {
    // LOAD FRONT END DATA
    menu_title = '<a href="CitizenVaccinationProfile.php">Tra cứu thông tin</a>'
    $('#function-navigation-bar-title').html(menu_title)

    homepage = '<a href="index.php">Trang chủ</a>'
    $('#homepage-path').html(homepage)

    subpage = '<a href="CitizenProfile.php">Công dân</a>'
    $('#subpage-path').html(subpage)

    selected_function = '<a href="CitizenVaccinationProfile.php">Tra cứu thông tin</a>'
    $('#selected-function-path').html(selected_function)

    $('#function-menu-title').text('Trang công dân')

    menu = '<br><a href="CitizenAccountInfo.php"><li>Thông tin tài khoản</li></a>'
    menu += '<br><a href="CitizenProfile.php"><li>Thông tin công dân</li></a>'
    menu += '<br><a href="CitizenRegistration.php"><li>Lịch đăng ký tiêm chủng</li></a>'
    menu += '<br><a href="CitizenCertificate.php"><li>Chứng nhận tiêm chủng</li></a>'
    menu += '<br><a href="CitizenVaccinationProfile.php"><li>Tra cứu thông tin</li></a>'
    menu += '<br><a href="CitizenRelative.php"><li>Thêm người thân</li></a>'

    $('#function-menu-list').find('ul').html(menu)
    // END LOAD FRONT END DATA
})