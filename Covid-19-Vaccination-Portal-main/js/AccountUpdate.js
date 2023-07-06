$(document).ready(function () {
    $('#cancel-update-account-info').click(function () {
        location.reload()
    })

    $('#update-account-info').click(function () {
        $('.message').text("")

        phone = $('.account input[name="phone"]').val()
        if (phone == "") {
            $('.account').find('.msg1').text("Nhập số điện thoại!")
            return
        }

        password = $('.account input[name="password"]').val()
        if (password == "") {
            $('.account').find('.msg2').html("Nhập mật khẩu để xác nhận thay đổi<br>thông tin!")
            return
        }

        new_password = $('.change-pass input[name="new-password"]').val()
        repeat_new_password = $('.change-pass input[name="repeat-new-password"]').val()
        if (new_password != repeat_new_password) {
            $('.change-pass').find('.msg2').html("Nhập lại mật khẩu phải giống với<br> mật khẩu!")
            return
        }

        /*
        The jQuery.ajax() function below used to call php code back-end to process a request made by user.
        + 'cache' field set to false means the called php file/page not to be cached 
        (stored the data for future uses) by browser. Because, every request in almost cases must be done
        with the newest data.
        + 'url' field specifies the location of the requested .php file.
        + 'type' field specifies the method to send data to the called php file.
        + 'data' field defines the key-value to be sent to the called php file. So that can make it accessible
        + 'sucess' field defines a function to be called if the request succeeds.
        The parameter result stores the returned data which is returned by return echo header etc. statements.
        + 'error' field defines a function to be called if the request fails.
        The parameter error stores errors.
        */
        $.ajax({
            cache: false,
            url: 'HandleUpdateAccount.php',
            type: "POST",
            /*
            The requests to back-end code must send a key-value to verify that this is a right call.
            The verification can be do by the key-value of the calling method.
            The requested file also should be formated in function-oriented to make a reusable code.
            */
            data: { method: 'HandleUpdateAccount', phone: phone, password: password, new_password: new_password },
            success: function (result) {
                /*
                In the php back-end code, catches the exception then return in a formated message,
                so that we can check back in this jQuery function and throw an optional message.
                */
                if (result.substring(0, 5) == 'ERROR') {    //EXCEPTION
                    alert(result)
                    return
                }

                /* 
                Back-end code obviously can return difference values every calls.
                Switch cases and handle!
                */
                switch (result) {
                    case 'Password is incorrect!':
                        $('.account').find('.msg2').html('Sai mật khẩu!')
                        return
                    case 'ChangePasswordUpdateAccount':
                        $('.form-message').text('Cập nhật tài khoản thành công!')
                        break
                    case 'ChangePassword!UpdateAccount':
                        $('.form-message').text('Cập nhật mật khẩu thành công!')
                        break
                    case '!ChangePasswordUpdateAccount':
                        $('.form-message').text('Cập nhật số điện thoại thành công!')
                        break
                    case '!ChangePassword!UpdateAccount':
                        return
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
            error: function (error) {
            }
        })
    })
})