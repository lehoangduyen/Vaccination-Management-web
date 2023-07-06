$(document).ready(function () {

    // LOAD FRONT END DATA
    menu_title = '<a href="OrgSchedule.php">Danh sách lịch tiêm</a>'
    $('#function-navigation-bar-title').html(menu_title)

    homepage = '<a href="index.php">Trang chủ</a>'
    $('#homepage-path').html(homepage)

    subpage = '<a href="OrgSchedule.php">Lịch tiêm</a>'
    $('#subpage-path').html(subpage)

    selected_function = '<a href="OrgSchedule.php">Danh sách lịch tiêm</a>'
    $('#selected-function-path').html(selected_function)
    // END LOAD FRONT END DATA

    var today = new Date()
    var day = ('0' + today.getDate()).slice(-2)
    var month = ('0' + (today.getMonth() + 1)).slice(-2)
    var today = today.getFullYear() + '-' + (month) + '-' + (day)
    $('#start-date').val(today)
    // $('#end-date').val(today)

    // LOAD SCHEDULE DATA
    LoadSchedule($('.orgid').attr('id'))

    $('#filter-schedule').change(function () {
        $('#list-registration').html('')
        $('.list-name-registration').text('')
        $('#filter-registration').css('display','none')
        LoadSchedule($('.orgid').attr('id'))
        
    })


    function LoadSchedule(orgid) {
        startdate = $('#start-date').val()
        enddate = $('#end-date').val()

        $.ajax({
            cache: false,
            url: 'HandleLoadOrgSchedule.php',
            type: 'POST',
            data: { method: 'LoadOrgSchedule', orgid: orgid, startdate: startdate, enddate: enddate},
            success: function (result) {
                if (result.substring(0, 5) == 'ERROR') {    //EXCEPTION
                    alert(result)
                    return
                }
                $('#list-schedule').html(result)
            },
            error: function (error) {
            }
        })
    }

    // HANDLE SELECT SCHEDULE
    $('#list-schedule').on('click', '.schedule .holder-btn-expand-schedule', function () {
        $('#list-registration').html('')
        schedule = $(this).parent()//.parent()
        if (schedule.css('margin-top') == '20px') {
            $('#list-registration').html('')
            schedule.css('margin', '3px 0px 3px 5px')
            schedule.css('width', '92%')
            schedule.css('height', '70px')
            schedule.find('.btn-expand-schedule').text('>')
            schedule.find('.interactive-area').css('display', 'none')
            return
        }
        $('#list-schedule').find('.schedule').css('margin', '3px 0px 3px 5px')
        $('#list-schedule').find('.schedule').css('width', '92%')
        $('#list-schedule').find('.schedule').css('height', '70px')
        $('#list-schedule').find('.schedule .btn-expand-schedule').text('>')
        $('#list-schedule').find('.schedule .interactive-area').css('display', 'none')

        schedule.css('margin', '20px 0px 20px 12px')
        schedule.css('width', '95%')
        schedule.css('height', '115px')
        schedule.find('.btn-expand-schedule').text('<')
        schedule.find('.interactive-area').css('display', 'block')
    })

    // HANDLE QUERY SCHEDULE'S REGISTRATION
    $('#list-schedule').on('click', '.btn-registration', function () {
        schedule = $(this).parent().parent().parent()
        SchedID = schedule.attr('id')
        SchedInfo = schedule.find('.obj-attr').find('.attr-date-vaccine-serial').text()
        $('.list-name-scheduleinfo').text(SchedInfo)
        LoadScheduleRegistration(SchedID, SchedInfo.substring(11, 21))
    })

    $('#filter-registration').change(function(){
        SchedID = $('.list-name-registration').attr('id')
        LoadScheduleRegistration(SchedID)
    })

    function LoadScheduleRegistration(SchedID, date){
        time = $('#time').find('option:selected').val()
        status = $('#status').find('option:selected').val()

        $.ajax({
            cache: false,
            url: 'HandleScheduleManagement.php',
            type: 'POST',
            data: { method: 'LoadScheduleRegistration', SchedID: SchedID, date: date, time: time, status: status },
            indexValue: { SchedID: SchedID },
            success: function (result) {
                if (result.substring(0, 5) == 'ERROR') {    //EXCEPTION
                    alert(result)
                    return
                }
                if (result == '') {
                    PopupConfirm('Không có lượt đăng ký nào cho lịch tiêm này.')
                }
                
                $('#list-registration').html(result)
                $('.list-name-registration').text('DANH SÁCH LƯỢT ĐĂNG KÝ')
                $('.list-name-registration').attr('id', this.indexValue.SchedID)
                $('#filter-registration').css('display','block')
            },
            error: function (error) {
            }
        })
    }

    // HANDLE UPDATE REGISTRATION STATUS
    $('#list-registration').on('click', '.btn-update-registration', function () {
        citizenid = $(this).parent().parent().parent().find('.obj-name').attr('id')
        SchedID = $(this).parent().parent().parent().attr('id')
        status = $(this).parent().find('.select-status').find('option:selected').val()
        $.ajax({
            cache: false,
            url: 'HandleScheduleManagement.php',
            type: 'POST',
            data: { method: 'UpdateRegistrationStatus', citizenid: citizenid, SchedID: SchedID, status: status },
            indexValue: { reg: $(this).parent().parent().parent() },
            success: function (result) {
                if (result.substring(0, 5) == 'ERROR') {    //EXCEPTION
                    alert(result)
                    return
                }

                reg = this.indexValue.reg
                switch (result) {
                    case '1':
                        reg.find('.hoder-obj-attr .interactive-area select').html('<option value="2">Đã tiêm</option><option value="3">Đã hủy</option>')
                        reg.find('.hoder-obj-attr .obj-attr .attr-detail p:last-child').text('Tình trạng: Đã điểm danh')
                        break
                    case '2':
                        reg.find('.hoder-obj-attr .interactive-area select').html('ImageIcon stay here!')
                        break
                    case '3':
                        this.indexValue.reg.remove()
                        LoadSchedule($('.orgid').attr('id'))
                        break
                    default:
                        break
                }
            },
            error: function (error) {
            }
        })

    })

    // HANDLE ENTER UPDATE SCHEDULE PANEL
    $('#list-schedule').on('click', '.btn-update', function () {
        schedule = $(this).parent().parent().parent()
        SchedID = schedule.attr('id')
        SchedInfo = schedule.find('.obj-attr .attr-date-vaccine-serial').text()
        SchedValue = schedule.find('.obj-attr .attr-time').text()

        $.ajax({
            cache: false,
            url: 'HandleScheduleManagement.php',
            type: 'POST',
            data: { method: 'SelectScheduleValue', SchedID: SchedID },
            success: function (result) {
            },
            error: function (error) {
            }
        })

        $('#list-registration').html(
            '<div class="panel-update-schedule" id="' + SchedID + '">'
            + '<br>'
            + '<div class="schedule-id">Mã lịch tiêm: ' + SchedID + '</div>'
            + '<div class="attr-date-vaccine-serial">' + SchedInfo + '</div>'
            + '<div class="attr-time">' + SchedValue + '</div>'
            + '<div class="container-update-value">'
            + '<label for="limit-day" class="">Giới hạn đăng ký buổi sáng</label><br>'
            + '<input id="limit-day" type="number" min="0"><br>'
            + '<label for="limit-noon" class="">Giới hạn đăng ký buổi chiều</label><br>'
            + '<input id="limit-noon" type="number" min="0"><br>'
            + '<label for="limit-night" class="">Giới hạn đăng ký buổi tối</label><br>'
            + '<input id="limit-night" type="number" min="0"><br>'
            + '<button class="btn-medium-bordered" id="btn-confirm-update-schedule">Xác nhận</button>'
            + '</div>'
            + '</div>'
        )
    })

    // HANDLE UPDATE SCHEDULE VALUE
    $('#list-registration').on('click', '#btn-confirm-update-schedule', function () {
        SchedID = $(this).parent().parent().attr('id')
        orgid = SchedID.substring(0, 5)
        limitday = $('#limit-day').val()
        limitnoon = $('#limit-noon').val()
        limitnight = $('#limit-night').val()

        if (limitday < 0 || limitnoon < 0 || limitnight < 0) {
            PopupConfirm('Các giá trị giới hạn không thể là số âm!')
            return
        }

        if (limitday == '')
            limitday = -1

        if (limitnoon == '')
            limitnoon = -1

        if (limitnight == '')
            limitnight = -1

        $.ajax({
            cache: false,
            url: 'HandleScheduleManagement.php',
            type: 'POST',
            data: { method: 'UpdateSchedule', SchedID: SchedID, limitday: limitday, limitnoon: limitnoon, limitnight: limitnight },
            success: function (result) {
                if (result.substring(0, 5) == 'ERROR') {    //EXCEPTION
                    alert(result)
                    return
                }
                if (result == 'UpdateSchedule') {
                    $('.panel-update-schedule').html('')
                    PopupConfirm('Cập nhật lịch tiêm thành công!')
                    LoadSchedule(orgid)
                }
            },
            error: function (error) {
            }
        })
    })

    // HANDLE CANCEL SCHEDULE
    $('#list-schedule').on('click', '.btn-cancel', function () {
        if (confirm('Xác nhận hủy lịch tiêm chủng này?')) {
            $('#list-registration').html('')
            schedule = $(this).parent().parent().parent()
            SchedID = schedule.attr('id')
            $.ajax({
                cache: false,
                url: 'HandleScheduleManagement.php',
                type: 'POST',
                data: { method: 'CancelSchedule', SchedID: SchedID },
                indexValue: { schedule: schedule },
                success: function (result) {
                    if (result.substring(0, 5) == 'ERROR') {    //EXCEPTION
                        alert(result)
                        return
                    }
                    if (result == 'CancelSchedule') {
                        schedule.find('.obj-attr .attr-time .day').attr('id', 0)
                        schedule.find('.obj-attr .attr-time .day').text(0)
                        schedule.find('.obj-attr .attr-time .noon').attr('id', 0)
                        schedule.find('.obj-attr .attr-time .noon').text(0)
                        schedule.find('.obj-attr .attr-time .night').attr('id', 0)
                        schedule.find('.obj-attr .attr-time .night').text(0)
                        PopupConfirm('Hủy lịch tiêm thành công!')
                    }
                },
                error: function (error) {
                }
            })
        }
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