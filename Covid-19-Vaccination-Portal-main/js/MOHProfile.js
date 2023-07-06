$(document).ready(function () {

        // LOAD FRONT END DATA
        menu_title = '<a href="MOHProfile.php">Thông tin Bộ Y tế</a>'
        $('#function-navigation-bar-title').html(menu_title)
    
        homepage = '<a href="index.php">Trang chủ</a>'
        $('#homepage-path').html(homepage)
    
        subpage = '<a href="ORGProfile.php">Bộ Y tế</a>'
        $('#subpage-path').html(subpage)
    
        selected_function = '<a href="ORGProfile.php">Thông tin Bộ Y tế</a>'
        $('#selected-function-path').html(selected_function)
    
        $('#function-menu-title').text('Trang Bộ Y tế')
    
        menu = '<br><a href="ORGAccountInfo.php"><li>Thông tin tài khoản</li></a>'
        menu += '<br><a href="ORGProfile"><li>Thông tin Bộ Y tế</li></a>'
        menu += '<br><a href="#"><li>Quản lý đơn vị</li></a>'
        menu += '<br><a href="#"><li>Thông tin tổ chức</li></a>'
    
        $('#function-menu-list').find('ul').html(menu)
        // END LOAD FRONT END DATA
})

