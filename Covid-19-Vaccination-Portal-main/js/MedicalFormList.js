$(document).ready(function () {
    // LOAD FRONT END DATA
    menu_title = '<a href="MedicalFormList.php">Danh sách tờ khai</a>'
    $('#function-navigation-bar-title').html(menu_title)

    homepage = '<a href="index.php">Trang chủ</a>'
    $('#homepage-path').html(homepage)

    subpage = '<a href="MedicalFormSubmit.php">Khai báo</a>'
    $('#subpage-path').html(subpage)

    selected_function = '<a href="MedicalFormList.php">Danh sách tờ khai</a>'
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
    $('#btn-filter-org').click(function () {

        selectformlist()
    })

    function selectformlist() {
        formdate = $('#form-date').val()

        // filleddate = $('#input-date').val()
        // if (new Date (filleddate).getTime() > new Date().getTime()){
        //     alert('Ngày khai báo không hợp lệ!')
        //     return
        //

        $.ajax({
            cache: false,
            url: 'HandleMedicalList.php',
            type: 'POST',
            data: { formdate: formdate },
            success: function (result) {
                if (result.substring(0, 5) == 'ERROR') {    //EXCEPTION
                    alert(result)
                }
                if (result == 'NoForm') {
                    PopupConfirm('Bạn chưa khai báo y tế trong vòng ' + formdate + ' ngày!')
                }
                $('#holder-form-medical').html(result);
            },
            error: function (error) {
                // $('body').html(error)
                alert('error')
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
