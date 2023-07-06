$(document).ready(function () {
    // LOAD FRONT END DATA
    menu_title = '<a href="CitizenRegistration.php">Lịch đăng ký tiêm chủng</a>'
    $('#function-navigation-bar-title').html(menu_title)

    homepage = '<a href="index.php">Trang chủ</a>'
    $('#homepage-path').html(homepage)

    subpage = '<a href="CitizenProfile.php">Công dân</a>'
    $('#subpage-path').html(subpage)

    selected_function = '<a href="CitizenRegistration.php">Lịch đăng ký tiêm chủng</a>'
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


    // LOAD REGISTRATION
    LoadRegistration()

    $('#btn-filter-registration').click(function () {
        LoadRegistration()
    })

    function LoadRegistration() {
        status = $('#status').val()
        vaccine = $('#vaccine').val()
        time = $('#time').val()

        $.ajax({
            cache: false,
            url: 'HandleLoadRegistration.php',
            type: 'POST',
            data: { method: 'LoadRegistration', status: status, vaccine: vaccine, time: time },
            success: function (result) {
                if (result.substring(0, 5) == 'ERROR') {    //EXCEPTION
                    alert(result)
                    return
                }
                $('#list-registration').html(result)
            },
            error: function (error) {

            }
        })
    }
    // END LOAD REGISTRATION

    // CANCEL REGISTRATION
    $('#list-registration').on('click', '.btn-cancel-registration', function () {
        if (confirm('Xác nhận hủy đăng ký tiêm chủng?')) {
            SchedID = $(this).parent().parent().parent().attr('id')
                CancelRegistration(SchedID)
        }
    })

    function CancelRegistration(SchedID) {
        $.ajax({
            cache: false,
            url: 'HandleLoadRegistration.php',
            type: 'POST',
            data: { method: 'CancelRegistration', SchedID: SchedID },
            success: function (result) {
                if (result.substring(0, 5) == 'ERROR') {    //EXCEPTION
                    alert(result)
                    return
                }
                if (result == 'CancelRegistration')
                    location.reload()
            },
            error: function (error) {
            }
        })
    }
    // END CANCEL REGISTRATION
})