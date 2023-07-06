$(document).ready(function () {
    // LOAD FRONT END DATA
    menu_title = '<a href="ORGProfile.php">Thông tin đơn vị</a>';
    $('#function-navigation-bar-title').html(menu_title);

    homepage = '<a href="index.php">Trang chủ</a>';
    $('#homepage-path').html(homepage);

    subpage = '<a href="ORGProfile.php">Đơn vị</a>'
    $('#subpage-path').html(subpage);

    selected_function = '<a href="ORGProfile.php">Thông tin đơn vị</a>';
    $('#selected-function-path').html(selected_function);

    $('#function-menu-title').text('Trang đơn vị');

    menu = '<br><a href="ORGAccountInfo.php"><li>Thông tin tài khoản</li></a>';
    menu += '<br><a href="ORGProfile.php"><li>Thông tin đơn vị</li></a>';

    $('#function-menu-list').find('ul').html(menu);
    // END LOAD FRONT END DATA

    $("#cancel-update-profile").click(function () {
        location.reload();
    })

    $("#update-profile").click(function () {
        $('.message').html("");

        name = $('#info-panel input[name="name"]').val();
        if (name == "") {
            $('.msg2').html('Nhập tên đơn vị!');
            return;
        }
        district = $('#select-district').find('option:selected').text();
        if (district == "") {
            $('.msg8').html('Nhập quận/huyện thường trú');
            return;
        }
        town = $('#select-town').find('option:selected').text();
        if (town == "") {
            $('.msg9').html('Nhập xã/phường thường/thị trấn trú!');
            return;
        }
        street = $('#info-panel').find('input[name="street"]').val();

        $.ajax({
            cache: false,
            url: "HandleUpdateProfile.php",
            type: "POST",
            data: {
                method: 'UpdateOrgProfile', name: name, district: district, town: town, street: street
            },
            success: function (result) {
                $('.form-message').text('Cập nhật thông tin thành công!');
                $('#form-popup-confirm').css('display', 'block');
                $('.gradient-bg-faded').css('display', 'block');
                location.reload();
            },
            error: function () {

            }
        })
    })
})

