$(document).ready(function () {
    // LOAD FRONT END DATA
    menu_title = '<a href="CitizenCertificate.php">Chứng nhận tiêm chủng</a>'
    $('#function-navigation-bar-title').html(menu_title)

    homepage = '<a href="index.php">Trang chủ</a>'
    $('#homepage-path').html(homepage)

    subpage = '<a href="CitizenProfile.php">Công dân</a>'
    $('#subpage-path').html(subpage)

    selected_function = '<a href="CitizenCertificate.php">Chứng nhận tiêm chủng</a>'
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

    LoadInjection()
    function LoadInjection() {
        $.ajax({
            cache: false,
            url: 'HandleLoadCertificate.php',
            type: 'POST',
            data: { method: 'LoadInjection' },
            success: function (result) {
                $('#list-injection').html(result)
                cert = $('#list-injection').find('.status').attr('id')
                switch (parseInt(cert)) {
                    case 0:
                        $('.certificate').css('background', '#D2001A')
                        break
                    case 1:
                        $('.certificate').css('background', '#F7EC09')
                        break
                    default:
                        $('.certificate').css('background', '#3EC70B')
                        break
                }
            },
            error: function (error) {
            }
        })
    }
})