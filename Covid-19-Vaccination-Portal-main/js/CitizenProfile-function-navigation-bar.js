$(document).ready(function(){
    $('#function-menu-title').text('Trang công dân')

    menu = '<br><a href="CitizenAccountInfo.php"><li>Thông tin tài khoản</li></a>'
    menu += '<br><a href="CitizenProfile.php"><li>Thông tin công dân</li></a>'
    menu += '<br><a href="CitizenRegistration.php"><li>Lịch đăng ký tiêm chủng</li></a>'
    menu += '<br><a href="CitizenCertificate.php"><li>Chứng nhận tiêm chủng</li></a>'
    menu += '<br><a href="CitizenVaccinationProfile.php"><li>Tra cứu thông tin</li></a>'
    menu += '<br><a href="#"><li>Thêm người thân</li></a>'
    
    $('#function-menu-list').find('ul').html(menu)
})


