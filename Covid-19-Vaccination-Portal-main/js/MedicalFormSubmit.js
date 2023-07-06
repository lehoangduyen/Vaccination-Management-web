$(document).ready(function () {
    // LOAD FRONT END DATA
    menu_title = '<a href="MedicalFormSubmit.php">Tờ khai y tế</a>'
    $('#function-navigation-bar-title').html(menu_title)

    homepage = '<a href="index.php">Trang chủ</a>'
    $('#homepage-path').html(homepage)

    subpage = '<a href="MedicalFormSubmit.php">Khai báo</a>'
    $('#subpage-path').html(subpage)

    selected_function = '<a href="MedicalFormSubmit.php">Tờ khai y tế</a>'
    $('#selected-function-path').html(selected_function)

    $('#function-menu-title').text('Trang khai báo y tế')

    menu = '<br><a href="MedicalFormSubmit.php"><li>Tờ khai y tế</li></a>'
    menu += '<br><a href="MedicalFormList.php"><li>Danh sách tờ khai</li></a>'

    $('#function-menu-list').find('ul').html(menu)

    var today = new Date()
    var day = ('0' + today.getDate()).slice(-2)
    var month = ('0' + (today.getMonth() + 1)).slice(-2)
    var today = today.getFullYear() + '-' + (month) + '-' + (day)
    $('#input-date').val(today)
    // END LOAD FRONT END DATA

    // HANDLE ACTION
    $('#btn-submit').click(function () {
        SubmitMedicalForm()
    })

    function SubmitMedicalForm() {
        q1 = $('input[type="radio"][name="q1"]:checked').val()
        q2 = $('input[type="radio"][name="q2"]:checked').val()
        q3 = $('input[type="radio"][name="q3"]:checked').val()
        q4 = $('input[type="radio"][name="q4"]:checked').val()
        if (!$('input[name="q1"]:checked').val() || !$('input[name="q2"]:checked').val() || !$('input[name="q3"]:checked').val() || !$('input[name="q4"]:checked').val()) {
            alert('Bạn chưa chọn câu trả lời!')
            return
        }
        choice = q1 + q2 + q3 + q4

        filleddate = $('#input-date').val()

        var today = new Date()
        var dd = String(today.getDate()).padStart(2, '0')
        var mm = String(today.getMonth() + 1).padStart(2, '0') //January is 0!
        var yyyy = today.getFullYear()
        today = yyyy + '-' + mm + '-' + dd

        if (new Date(filleddate).getTime() > new Date(today).getTime()) {
            PopupConfirm('Ngày khai báo không hợp lệ!')
            return
        }

        $.ajax({
            cache: false,
            url: 'HandleMedicalForm.php',
            type: 'POST',
            data: { filleddate: filleddate, choice: choice },
            success: function (result) {
                if (result.substring(0, 5) == 'ERROR') {    //EXCEPTION
                    alert(result)
                    return
                }
                if (result == 'Form Submited!') {
                    PopupConfirm('Khai báo y tế thành công!')
                }
            },
            error: function (error) {
            }
        })
    }
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