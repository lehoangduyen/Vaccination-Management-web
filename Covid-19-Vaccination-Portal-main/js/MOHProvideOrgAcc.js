$(document).ready(function () {

    // LOAD FRONT END DATA
    menu_title = '<a href="MOHProvideOrgAcc.php">Cấp tài khoản đơn vị</a>'
    $('#function-navigation-bar-title').html(menu_title)

    homepage = '<a href="index.php">Trang chủ</a>'
    $('#homepage-path').html(homepage)

    subpage = '<a href="MOHManageOrg.php">Đơn vị tiêm chủng</a>'
    $('#subpage-path').html(subpage)

    selected_function = '<a href="MOHProvideOrgAcc.php">Cấp tài khoản đơn vị</a>'
    $('#selected-function-path').html(selected_function)

    $('#function-menu-title').text('Đơn vị tiêm chủng')

    menu = '<br><a href="MOHManageOrg.php"><li>Quản lý đơn vị</li></a>'
    menu += '<br><a href="MOHProvideOrgAcc.php"><li>Cấp tài khoản đơn vị</li></a>'

    $('#function-menu-list').find('ul').html(menu)
    // END LOAD FRONT END DATA

    // HANDLE ACTION
    $('#btn-confirm-acc-creation').click(function () {
        // $('#form-popup-option').find('.form-message').html('Xác nhận tạo tài khoản cho đơn vị tiêm chủng?')
        // $('#form-popup-option').css('display', 'grid')
        // $('#gradient-bg-faded').css('display', 'block')

        // $('#form-popup-option').on('click', '.btn-cancel', function () {
        //     $('#form-popup-option').css('display', 'none')
        //     $('#gradient-bg-faded').css('display', 'none')
        // })

        if (!confirm('Xác nhận tạo tài khoản cho đơn vị tiêm chủng?'))
            return

        code = $('#select-province').find('option:selected').val()
        if (code < 10)
            code = '0' + code
        province = $('#select-province').find('option:selected').text()
        quantity = $('#account-quantity').val()
        if (quantity == 0)
            return
        if (quantity > 100) {
            PopupConfirm('Không thể tạo số lượng lớn hơn 100')
            return
        }

        $.ajax({
            cache: false,
            url: 'HandleProvideOrgAcc.php',
            type: 'POST',
            data: { method: 'ProvideAccount', quantity: quantity, code: code, province: province },
            success: function (result) {
                if (result.substring(0, 5) == 'ERROR') {    //EXCEPTION
                    alert(result)
                    return
                }
                if (result == 'ProvideAccount') {
                    PopupConfirm('Tạo các tài khoản đơn vị thành công!')
                    return
                }
            },
            error: function (error) {
                // $('body').html(error)
                alert('error')
            }
        })
    })
})

var PopupConfirm = function (message) {
    $('.form-message').html(message)
    $('#form-popup-confirm').css('display', 'grid')
    $('#gradient-bg-faded').css('display', 'block')
    $('#form-popup-confirm').find('.btn-confirm').click(function () {
        $('#form-popup-confirm').css('display', 'none')
        $('#gradient-bg-faded').css('display', 'none')
    })
}