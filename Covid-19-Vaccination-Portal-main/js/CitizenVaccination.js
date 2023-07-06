var SelectedOption = false

$(document).ready(function () {
    // LOAD FRONT END DATA

    menu_title = '<a href="CitizenVaccination.php">Đăng ký tiêm chủng</a>'
    $('#function-navigation-bar-title').html(menu_title)

    homepage = '<a href="index.php">Trang chủ</a>'
    $('#homepage-path').html(homepage)

    subpage = '<a href="CitizenVaccination.php">Tiêm chủng</a>'
    $('#subpage-path').html(subpage)

    selected_function = '<a href="CitizenVaccination.php">Đăng ký tiêm chủng</a>'
    $('#selected-function-path').html(selected_function)

    var today = new Date()
    var day = ('0' + today.getDate()).slice(-2)
    var month = ('0' + (today.getMonth() + 1)).slice(-2)
    var today = today.getFullYear() + '-' + (month) + '-' + (day)
    $("#start-date").val(today)
    // END LOAD FRONT END DATA

    LoadOrg()

    $('#btn-filter-org').click(function () {
        LoadOrg()
    })

    function LoadOrg() {
        province = $('#select-province').find('option:selected').text()
        district = $('#select-district').find('option:selected').text()
        town = $('#select-town').find('option:selected').text()

        $.ajax({
            cache: false,
            url: 'HandleLoadOrgSchedule.php',
            type: 'POST',
            data: { method: 'LoadOrg', province: province, district: district, town: town },
            success: function (result) {
                if (result.substring(0, 5) == 'ERROR') {    //EXCEPTION
                    alert(result)
                    return
                }
                $('#list-org').html(result)
            },
            error: function (error) {
            }
        })
    }

    $('#filter-schedule').on('change', '.organization', function () {
        LoadSchedule(orgid)
    })

    $('#filter-schedule').change(function () {
        startdate = $('#start-date').val()
        enddate = $('#end-date').val()
        vaccine = $('#vaccine').find('option:selected').val()

        orgid = $('.list-name .schedule').attr('id')

        LoadSchedule(orgid)
    })

    function LoadSchedule(orgid) {
        startdate = $('#start-date').val()
        enddate = $('#end-date').val()
        vaccine = $('#vaccine').find('option:selected').val()
        
        $.ajax({
            cache: false,
            url: 'HandleLoadOrgSchedule.php',
            type: 'POST',
            data: { method: 'LoadSchedule', orgid: orgid, startdate: startdate, enddate: enddate, vaccine: vaccine },
            success: function (result) {
                if (result.substring(0, 5) == 'ERROR') {    //EXCEPTION
                    alert(result)
                    return
                }
                $('#list-schedule').html(result)
                // $('body').html(result)
            },
            error: function (error) {

            }
        })
    }

    // HANDLE SELECT ORGANIZATION
    $('#list-org').on('click', '.organization .holder-btn-expand-org', function () {
        $('#list-schedule').html('')
        org = $(this).parent()//.parent()
        if (org.css('margin-top') == '20px') {
            $('#list-schedule').html('Danh sách lịch tiêm')
            $('.list-name .schedule').html('')
            org.css('margin', '3px 0px 3px 5px')
            org.css('width', '90%')
            org.find('.btn-expand-org').text('>')
            return
        }
        $('#list-org').find('.organization').css('margin', '3px 0px 3px 5px')
        $('#list-org').find('.organization').css('width', '90%')
        $('#list-org').find('.organization .btn-expand-org').text('>')

        org.css('margin', '20px 0px 20px 12px')
        org.css('width', '96%')
        org.find('.btn-expand-org').text('<')

        orgid = org.attr('id')
        orgname = org.find('.obj-org-name').text()
        $('.list-name .schedule').html('DS lịch tiêm ' + orgname)
        $('.list-name .schedule').attr('id', orgid)
        LoadSchedule(orgid)
    })

    // HANDLE REGISTER SCHEDULE
    $('#list-schedule').on('click', '.schedule .btn-register-schedule', function () {
        SchedID = $(this).parent().parent().attr('id')
        time = $(this).parent().find('select option:selected').val()
        date = $(this).parent().parent().find('.attr-date').text()
        vaccine = $(this).parent().parent().find('.attr-vaccine').text()

        display_time = time
        switch (time) {
            case '0':
                display_time = 'Buổi sáng'
                break
            case '1':
                display_time = 'Buổi chiều'
                break
            case '2':
                display_time = 'Buổi tối'
                break
        }

        if (confirm('Xác nhận đăng ký tiêm chủng? ' + date + ' - ' + display_time + ' - ' + vaccine))
            CheckRegistration(SchedID, time)
    })


    function CheckRegistration(SchedID, time) {           // Check conditions before registration
        // $('#form-popup-confirm').find('.form-message').html('Xác nhận đăng ký tiêm chủng?<br><br>'
        //     + date + ' - ' + vaccine + ' ' + display_time)
        // $('#form-popup-confirm').css('display', 'grid')
        // $('#gradient-bg-faded').css('display', 'block')

        $.ajax({
            cache: false,
            url: 'HandleRegisterVaccination.php',
            type: 'POST',
            data: { method: 'CheckRegistration' },
            success: function (result) {
                if (result.substring(0, 5) == 'ERROR') {    //EXCEPTION
                    PopupConfirm(result)    //if fired trigger, show error
                    return
                }
                else {
                    CheckBooster(result, SchedID, time)       //Passed check conditions, Check dosetype suitable for vaccination
                    return
                }
            },
            error: function (error) {
            }
        })
    }

    function CheckBooster(checkbooster, SchedID, time) {   // Check dosetype suitable for vaccination
        // if (checkbooster == 1) {            // Check if booster dose is availabel, ask for choice
        //     $('#form-popup-option').on('click', 'button', function () {
        //         dosetype = $(this).val()
        //         if (dosetype == 'cancel') {         // If cancel confirmation of registration, return
        //             $('#form-popup-option').css('display', 'none')
        //             $('#gradient-bg-faded').css('display', 'none')
        //             return
        //         }
        //         else {
        //             RegisterVaccination(SchedID, dosetype, time)   // Register with chosen dosetype
        //             return
        //         }
        //     })
        // }
        // else {
        dosetype = ''
        RegisterVaccination(SchedID, dosetype, time)   // If no booster availabel, register with automatic selected dosetype
        // }
    }

    function RegisterVaccination(SchedID, dosetype, time) { //RegisterVaccination
        $.ajax({
            cache: false,
            url: 'HandleRegisterVaccination.php',
            type: 'POST',
            data: { method: 'RegisterVaccination', SchedID: SchedID, time: time, dosetype: dosetype },
            indexValue: { orgid: SchedID.substring(0, 5) },
            success: function (result) {
                if (result.substring(0, 5) == 'ERROR') {    //EXCEPTION
                    switch (result.substring(7, 12)) {
                        case '20001':
                            PopupConfirm('Bạn phải hoàn thành mũi tiêm đã đăng ký trước đó<br>trước khi đăng ký mũi mới.')
                            break
                        case '20004':
                            PopupConfirm('Loại vaccine này không phù hợp với mũi vaccine trước đã tiêm!.')
                            break
                        case '20005':
                            PopupConfirm('Bạn phải khai báo y tế trong vòng 7 ngày trước khi ngày tiêm diễn ra!')
                            break
                        default:
                            alert(result)
                            break
                    }
                }
                if (result == 'RegisterVaccination') {
                    LoadSchedule(this.indexValue.orgid)
                    PopupConfirm('Đăng ký tiêm chủng thành công!')
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

var PopupOption = function (message, buttons) {
    $('#form-popup-option').find('.form-message').html('Bạn cần đăng ký tiêm mũi tăng cường hay nhắc lại?')
    $('#form-popup-option').find('.holder-btn').html('<br><button class="btn-medium-filled" value="booster">Tăng cường</button>'
        + '<button class="btn-medium-bordered" value="repeat">Nhắc lại</button>'
        + '<button class="btn-medium-bordered" value="cancel">Hủy</button>')
    $('#form-popup-option').css('display', 'grid')
    $('#gradient-bg-faded').css('display', 'block')
}