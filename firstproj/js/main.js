$(document).ready(function () {
    if(window.matchMedia('(max-width: 992px)').matches)
    {
    $('.sidebar').hide();
    $('#burg a').on('click', function () {
        $('.sidebar').slideToggle();
    });
}});
