$(document).ready(function () {

    // LOAD FRONT END DATA
    menu_title = '<a href="MOHManageOrg.php">Quản lý đơn vị tiêm chủng</a>'
    $('#function-navigation-bar-title').html(menu_title)

    homepage = '<a href="index.php">Trang chủ</a>'
    $('#homepage-path').html(homepage)

    subpage = '<a href="MOHManageOrg.php">Đơn vị tiêm chủng</a>'
    $('#subpage-path').html(subpage)

    selected_function = '<a href="MOHManageOrg.php">Quản lý đơn vị tiêm chủng</a>'
    $('#selected-function-path').html(selected_function)

    $('#function-menu-title').text('Đơn vị tiêm chủng')

    menu = '<br><a href="MOHManageOrg.php"><li>Quản lý đơn vị</li></a>'
    menu += '<br><a href="MOHProvideOrgAcc.php"><li>Cấp tài khoản đơn vị</li></a>'

    $('#function-menu-list').find('ul').html(menu)
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
            url: 'HandleLoadOrg.php',
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
})

