$('.bt').click(function() {
    $('.bt').toggleClass("click");
    $('.sidebar').toggleClass("show");
});
$('.bt').click(function() {
    $('.card').toggleClass("moveleft");
});
$('.bt').click(function() {
    $('.title').toggleClass("moveleft");
});
$('.user-btn').click(function() {
    $('nav ul .user-show').toggleClass("show");
    $('nav ul .zero').toggleClass("rotate");
});
$('.leave-btn').click(function() {
    $('nav ul .leave-show').toggleClass("show");
    $('nav ul .first').toggleClass("rotate");
});
$('.sal-btn').click(function() {
    $('nav ul .sal-show').toggleClass("show");
    $('nav ul .second').toggleClass("rotate");
});
$('.bt').click(function() {
    $('.footer').toggleClass("moveleft");
});