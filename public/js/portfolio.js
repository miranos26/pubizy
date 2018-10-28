$(document).ready(function(){
   $('.category_item').click(function(){
       let category = $(this).attr('id');

       if(category === 'all'){
           $('.work-item').addClass('hide');
           setTimeout(function(){
               $('.work-item').removeClass('hide');
           }, 300);
       } else {
           $('.work-item').addClass('hide');
           setTimeout(function(){
               $('.' + category).removeClass('hide');
           }, 300);
       }
   });
});

// Lightbox portfolio init

$(document).on('click', '[data-toggle="lightbox"]', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox({
        alwaysShowClose: false
    });
});