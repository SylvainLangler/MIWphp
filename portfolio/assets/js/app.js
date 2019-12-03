$('.hamburger').click(function(){
    $('ul').slideToggle();
    $('ul').css('display','flex');
    setTimeout(function(){
        $('.intro').toggle();
    }, 300)
})