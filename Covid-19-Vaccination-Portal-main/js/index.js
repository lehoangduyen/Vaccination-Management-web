$(document).ready(function () {
    $('#btn-login').click(function () {
        $('#gradient-bg-faded').css('display', 'block');
        $('#form-container-login').css('display', 'block');
    })

    $('#btn-close-form-login').click(function () {
        $('#gradient-bg-faded').css('display', 'none');
        $('#form-container-login').css('display', 'none');
        $(this).parent().find('.message').text("");
    })

    $('#btn-create-account').click(function () {
        $('#form-container-login').css('display', 'none');
        $('#form-container-reg-acc').css('display', 'block');
    })

    $('#btn-close-form-reg-acc').click(function () {
        $('#form-container-reg-acc').css('display', 'none');
        $('#gradient-bg-faded').css('display', 'none');
        $(this).parent().find('.message').text("");
    })

    $('#btn-login-in-form-reg-acc').click(function () {
        $('#form-container-reg-acc').css('display', 'none');
        $('#form-container-login').css('display', 'block');
    })

    $('#btn-close-form-reg-profile').click(function () {
        $('#container-reg-profile').css('display', 'none');
        $('#gradient-bg-faded').css('display', 'none');
        $(this).parent().find('.message').text("");
    })

    $('#btn-forgot-password').click(function () {
        $('#form-container-login').css('display', 'none');
        $('#container-forgot-password').css('display', 'grid');
        $(this).parent().find('.message').text("");
    })

    // LOAD LOCAL LIST DATA ON SELECT
    $.getJSON('local.json', function (data) {
        i = 0;
        province = data[i];
        while (typeof (province) != 'undefined' && province !== null) {
            $('#select-hometown').append('<option value="' + i + '">' + province.name + '</option>');
            $('#select-province').append('<option value="' + i + '">' + province.name + '</option>');
            i++;
            province = data[i];
        }
    })
    // END LOAD LOCAL LIST DATA SELECT

    $('#close_reg_person_profile').click(function () {
        $('.container-reg-profile').css('display', 'none');
    })

    // HANDLE LOGIN
    $('#btn-login-in-form-login').click(function () {
        $('#form-container-login').find('.msg1').text('');
        $('#form-container-login').find('.msg2').text('');

        username = $('#form-login').find('input[name="username"').val().toLowerCase();
        if (username == '') {
            $('#form-login').find('.msg1').text('Nhập SĐT/Tên tài khoản!');
            return;
        }
        password = $('#form-login').find('input[name="password"').val();
        if (password == '') {
            $('#form-login').find('.msg2').text('Nhập mật khẩu!');
            return;
        }
        $.ajax({
            cache: false,
            url: 'HandleLogin.php',
            type: 'POST',
            data: { username: username, password: password },
            success: function (result) {    //button click to login
                if (result.substring(0, 5) == 'ERROR') {    //EXCEPTION
                    alert(result);
                    return;
                }
                if (result == 'NoAccount') {    //No Account Existed
                    $('#form-container-login').find('.msg1').text('Tài khoản không tồn tại!');
                    return;
                }
                if (result == 'NoProfile') {    //No Profile Existed
                    $('#form-container-login').css('display', 'none');
                    $('#gradient-bg-faded').css('display', 'block');
                    $('.container-reg-profile').css('display', 'block');
                    return;
                }
                if (result == 'incorrect password') {   //Incorrect Password
                    $('#form-container-login').find('.msg2').text('Sai mật khẩu!');
                    return;
                }
                location.reload(true);
            },
            error: function (error) {
                $('body').html(error);
            }
        });

    })

    //HANDLE REGISTER ACCOUNT
    $('#btn-reg-acc').click(function () {   //button click register account
        $('#form-container-login').css('display', 'none');

        $('#form-reg-acc').find('.msg1').text('');
        $('#form-reg-acc').find('.msg2').text('');
        $('#form-reg-acc').find('.msg3').text('');
        username = $('#form-reg-acc input[name="phone_number"]').val().toLowerCase();
        if (username == '') {
            $('#form-reg-acc').find('.msg1').text('Nhập số điện thoại!');
            return;
        }

        $.ajax({
            cache: false,
            url: 'HandleRegAcc.php',
            type: 'POST',
            data: { method: 'CheckExist', username: username },
            success: function (result) {    //check if account existed
                if (result.substring(0, 5) == 'ERROR') {    //EXCEPTION
                    alert(result);
                    return;
                }

                if (result == 'Account Existed!') {     //account existed
                    $('#form-reg-acc').find('.msg1').text('Số điện thoại đã được sử dụng!');
                }
                else {                                  //register account
                    password = $('#form-reg-acc input[name="password"]').val();
                    if (password == '') {
                        $('#form-reg-acc').find('.msg2').text('Nhập mật khẩu!');
                        return;
                    }
                    repeat_password = $('#form-reg-acc input[name="repeat-password"]').val();
                    if (repeat_password == '') {
                        $('#form-reg-acc').find('.msg3').text('Nhập lại mật khẩu!');
                        return;
                    }

                    $.ajax({
                        cache: false,
                        type: 'POST',
                        data: { method: 'RegisterAccount', username: username, password: password },
                        url: 'HandleRegAcc.php',
                        success: function (result) {
                            if (result.substring(0, 5) == 'ERROR') {
                                alert(result);
                                return;
                            }
                        },
                        error: function (error) {
                            $('body').html(error);
                        }
                    })
                    $('.container-reg-profile').css('display', 'block');
                }
            },
            error: function (error) {
                $('body').html(error);
            }
        })
    })

    // HANDLE REGISTER USER PROFILE
    $('#btn-reg-profile').click(function () {       //button click register profile
        $('.message').html("");

        lastname = $('#container-reg-profile').find('input[name="lastname"]').val();
        firstname = $('#container-reg-profile').find('input[name="firstname"]').val();
        if (firstname == "") {
            $('.msg2').html('Nhập tên người dùng!');
            return;
        }
        gender = $('#container-reg-profile').find('select[name="gender"] option:selected').val();
        id = $('#container-reg-profile').find('input[name="id"]').val();
        if (id == "") {
            $('.msg4').html('Nhập mã định danh!');
            return;
        }
        birthday = $('#container-reg-profile').find('input[name="birthday"]').val();
        if (birthday == "") {
            $('.msg5').html('Nhập ngày sinh!');
            return;
        }
        hometown = $('#select-hometown').find('option:selected').text();
        if (hometown == "") {
            $('.msg6').html('Nhập quê quán!');
            return;
        }
        province = $('#select-province').find('option:selected').text();
        if (province == "") {
            $('.msg7').html('Nhập tỉnh/thành phố thường trú!');
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
        street = $('#container-reg-profile').find('input[name="street"]').val();
        email = $('#container-reg-profile').find('input[name="email"]').val();

        $.ajax({
            cache: false,
            url: 'HandleRegAcc.php',
            type: 'POST',
            data: {
                method: 'RegisterProfile', lastname: lastname, firstname: firstname,
                gender: gender, id: id, birthday: birthday, hometown: hometown, province: province,
                district: district, town: town, street: street, email: email
            },
            success: function (result) {
                if (result.substring(0, 5) == 'ERROR') {    //EXCEPTION
                    alert(result);
                    return;
                }
                if (result == 'Profile Created!') {
                    $('#container-reg-profile').css('display', 'none');
                    $('.form-message').text('Đăng ký thông tin tài khoản thành công!');
                    $('#form-popup-confirm').css('display', 'block');
                }
            },
            error: function (error) {
                $('body').html(error);
            }
        })
    })

    //HANDLE FORGOT PASSWORD
    $('#btn-reset-password').click(function () {
        $('#container-forgot-password').find('.message').text("");

        username = $('#container-forgot-password').find('input[name="username"').val();
        if (username == '') {
            $('#container-forgot-password').find('.msg1').text('Nhập SĐT/Tên tài khoản!');
            return;
        }

        capcha = $('#container-forgot-password').find('input[name="capcha"').val();
        if (username == '') {
            $('#container-forgot-password').find('.msg2').text('Nhập mã xác nhận!');
            return;
        }

        $.ajax({
            cache: false,
            url: 'HandleForgotPassword.php',
            type: 'POST',
            data: { method: 'SendEmail', username: username},
            success: function (result) {    //button click to login
                if (result.substring(0, 5) == 'ERROR') {    //EXCEPTION
                    alert(result);
                    return;
                }
                if (result == 'NoAccount') {    //No Account Existed
                    $('#container-forgot-password').find('.message').text('Tài khoản không tồn tại!');
                    return;
                }
                alert(1);
            },
            error: function (error) {
                $('body').html(error);
            }
        });
    })
})