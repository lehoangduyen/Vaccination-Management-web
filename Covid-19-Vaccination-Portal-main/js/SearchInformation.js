$(document).ready(function () {

    // LOAD FRONT END DATA
    menu_title = '<a href="SearchInformation.php">Tra cứu thông tin</a>'
    $('#function-navigation-bar-title').html(menu_title)

    homepage = '<a href="index.php">Trang chủ</a>'
    $('#homepage-path').html(homepage)

    subpage = '<a href="SearchInformation.php">Tra cứu</a>'
    $('#subpage-path').html(subpage)

    selected_function = '<a href="SearchInformation.php">Tra cứu thông tin</a>'
    $('#selected-function-path').html(selected_function)
})