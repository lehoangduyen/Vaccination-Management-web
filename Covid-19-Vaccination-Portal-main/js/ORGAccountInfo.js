$(document).ready(function () {
    // LOAD FRONT END DATA
    menu_title = '<a href="ORGAccountInfo.php">Thông tin tài khoản</a>'
    $('#function-navigation-bar-title').html(menu_title)

    homepage = '<a href="index.php">Trang chủ</a>'
    $('#homepage-path').html(homepage)

    subpage = '<a href="ORGProfile.php">Đơn vị</a>'
    $('#subpage-path').html(subpage)

    selected_function = '<a href="ORGAccountInfo.php">Thông tin tài khoản</a>'
    $('#selected-function-path').html(selected_function)

    $('#function-menu-title').text('Trang đơn vị')

    menu = '<br><a href="ORGAccountInfo.php"><li>Thông tin tài khoản</li></a>'
    menu += '<br><a href="ORGProfile.php"><li>Thông tin đơn vị</li></a>'

    $('#function-menu-list').find('ul').html(menu)
    // END LOAD FRONT END DATA
})

