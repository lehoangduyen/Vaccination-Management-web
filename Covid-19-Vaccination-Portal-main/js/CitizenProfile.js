$(document).ready(function () {
    // LOAD FRONT END DATA
    menu_title = '<a href="CitizenProfile.php">Thông tin công dân</a>'
    $('#function-navigation-bar-title').html(menu_title)

    homepage = '<a href="index.php">Trang chủ</a>'
    $('#homepage-path').html(homepage)

    subpage = '<a href="CitizenProfile.php">Công dân</a>'
    $('#subpage-path').html(subpage)

    selected_function = '<a href="CitizenProfile.php">Thông tin công dân</a>'
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

    $('#cancel-update-profile').click(function () {
        location.reload()
    })

    $('#update-profile').click(function () {
        $('.message').html('')

        lastname = $('#info-panel').find('input[name="lastname"]').val()
        firstname = $('#info-panel').find('input[name="firstname"]').val()
        if (firstname == '') {
            $('.msg2').html('Nhập tên người dùng!')
            return
        }
        gender = $('#info-panel').find('select[name="gender"] option:selected').val()
        id = $('#info-panel').find('input[name="id"]').val()
        if (id == '') {
            $('.msg4').html('Nhập mã định danh!')
            return
        }
        birthday = $('#info-panel').find('input[name="birthday"]').val()
        if (birthday == '') {
            $('.msg5').html('Nhập ngày sinh!')
            return
        }
        hometown = $('#select-hometown').find('option:selected').text()
        if (hometown == '') {
            $('.msg6').html('Nhập quê quán!')
            return
        }
        province = $('#select-province').find('option:selected').text()
        if (province == '') {
            $('.msg7').html('Nhập tỉnh/thành phố thường trú!')
            return
        }
        district = $('#select-district').find('option:selected').text()
        if (district == '') {
            $('.msg8').html('Nhập quận/huyện thường trú')
            return
        }
        town = $('#select-town').find('option:selected').text()
        if (town == '') {
            $('.msg9').html('Nhập xã/phường thường/thị trấn trú!')
            return
        }
        street = $('#info-panel').find('input[name="street"]').val()
        email = $('#info-panel').find('input[name="email"]').val()

        $.ajax({
            cache: false,
            url: 'HandleUpdateProfile.php',
            type: 'POST',
            data: {
                method: 'UpdateCitizenProfile', lastname: lastname, firstname: firstname,
                gender: gender, id: id, birthday: birthday, hometown: hometown, province: province,
                district: district, town: town, street: street, email: email
            },
            success: function (result) {
                if (result.substring(0, 5) == 'ERROR') {    //EXCEPTION
                    alert(result)
                    return
                }
                switch (result) {
                    case 'UpdateCitizenProfile':
                    case 'UpdateOrgProfile':
                        $('.form-message').text('Cập nhật thông tin thành công!')
                        break
                    case '':
                        $('.form-message').text('Lỗi chưa xác định!')
                        break
                    default:
                        alert(result)
                        break
                }

                $('#form-popup-confirm').css('display', 'grid')
                $('#gradient-bg-faded').css('display', 'block')

                $('#form-popup-confirm').find('.btn-confirm').click(function () {
                    location.reload()
                })
            },
            error: function () {
            }
        })
    })
})

