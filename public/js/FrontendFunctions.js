
// Account customer collapse

$('.account-item-header').click(function(){
    $('.collapse').collapse('hide');
});


$(function(){
   $(".account-item-header").click(function(){
       $(".account-item-header").removeClass('activeItemDb');
       $(this).addClass('activeItemDb');
   });
});
