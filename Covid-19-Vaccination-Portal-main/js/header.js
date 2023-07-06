$(document).ready(function(){
    // NAV MENU ANIMATION
    $('.header .nav .menu-section').mouseover(function(){
        $(this).css('color', 'white')
    })

    $('.header .nav .menu-section').mouseout(function(){
        $(this).css('color', '#8C69CA')
    })

    // DROP DOWN MENU TEXT ANIMATION
    $('.drop-down-menu a').mouseover(function(){
        $(this).find('li').css('color','white')
    })

    $('.drop-down-menu a').mouseout(function(){
        $(this).find('li').css('color','black')
    })

    // DROP DOWN MENU PROFILE
    $('.header').on('mouseover', '.avatar', function () {
        $('#drop-down-menu-profile').css('display', 'block')
    })

    $('.header').on('mouseout', '.avatar', function () {
        $('#drop-down-menu-profile').css('display', 'none')
    })

    $('.header').on('mouseout', '#drop-down-menu-profile', function () {
        $('#drop-down-menu-profile').css('display', 'none')
    })

    $('.header').on('mouseover', '#drop-down-menu-profile', function () {
        $('#drop-down-menu-profile').css('display', 'block')
    })

    // DROP DOWN MENU SCHEDULE 
    $('.header').on('mouseover', '#menu-section-schedule', function () {
        $('#drop-down-menu-schedule').css('display', 'block')
    })

    $('.header').on('mouseout', '#menu-section-schedule', function () {
        $('#drop-down-menu-schedule').css('display', 'none')
    })

    $('.header').on('mouseout', '#drop-down-menu-schedule', function () {
        $('#drop-down-menu-schedule').css('display', 'none')
    })

    $('.header').on('mouseover', '#drop-down-menu-schedule', function () {
        $('#drop-down-menu-schedule').css('display', 'block')
    })

    // DROP DOWN MENU POST
    $('.header').on('mouseover', '#menu-section-post', function () {
        $('#drop-down-menu-post').css('display', 'block')
    })

    $('.header').on('mouseout', '#menu-section-post', function () {
        $('#drop-down-menu-post').css('display', 'none')
    })

    $('.header').on('mouseout', '#drop-down-menu-post', function () {
        $('#drop-down-menu-post').css('display', 'none')
    })

    $('.header').on('mouseover', '#drop-down-menu-post', function () {
        $('#drop-down-menu-post').css('display', 'block')
    })

    // HANDLE LOGOUT
    $('#btn-logout').click(function () {
        $.ajax({
            cache: false,
            url: 'HandleLogout.php',
            success: function (result) {
                window.location.href = 'index.php'
            },
            error: function (result) {
                alert(error)
            }
        })
    })
})