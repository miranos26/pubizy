

// ------------------------   Form Step -----------------------


let current_fs, next_fs, previous_fs; // fieldset
let left, opacity, scale;  // Fieldset properties for animations
let animating; // prevent quick multi-click glitches

let firstName, lastName, phoneNumber, emailuser;

let has_error = false;

let inputFirstName = $('#FormFirstname');
let inputLastName = $('#FormLastname');
let inputPhone = $('#FormPhone');
let inputEmail = $('#FormEmail');

let email_regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;

let phone_regex = /^(?:(?:\+|00)33[\s.-]{0,3}(?:\(0\)[\s.-]{0,3})?|0)[1-9](?:(?:[\s.-]?\d{2}){4}|\d{2}(?:[\s.-]?\d{3}){2})$/;



inputFirstName.keyup(function(){
   firstName = $.trim((inputFirstName).val());
});

inputLastName.keyup(function(){
    lastName = $.trim((inputLastName).val());
});

inputPhone.keyup(function(){
    phoneNumber = $.trim((inputPhone).val());
});

inputEmail.keyup(function(){
    emailuser = $.trim((inputEmail).val());
});


$(".next").on('click',function(){

    has_error = false;

    if(firstName === '' || typeof firstName === 'undefined' || firstName.length > 30){
        $('#EmptyFirstname').removeClass('d-none');
        has_error = true;
    } else {
        $('#EmptyFirstname').addClass('d-none');
    }

    if(lastName === '' || typeof  lastName === 'undefined' || lastName.length > 30){
        $('#EmptyLastname').removeClass('d-none');
        has_error = true;
    } else{
        $('#EmptyLastname').addClass('d-none');
    }

    if(phoneNumber === '' || typeof phoneNumber === 'undefined' ) {
        $('#EmptyPhone').removeClass('d-none');
        has_error = true;
    } else{
        $('#EmptyPhone').addClass('d-none');
    }

    if(!phone_regex.test(phoneNumber)){
        $('#InvalidPhone').removeClass('d-none');
        has_error = true;
    } else{
        $('#InvalidPhone').addClass('d-none');
    }

    if(emailuser === '' || typeof emailuser === 'undefined') {
        $('#EmptyEmail').removeClass('d-none');
        has_error = true;
    } else {
        $('#EmptyEmail').addClass('d-none');
    }

    if(!email_regex.test(emailuser)){
        $('#InvalidEmail').removeClass('d-none');
        has_error = true;
    } else{
        $('#InvalidEmail').addClass('d-none');
    }

    if(!has_error) {
        current_fs = $(this).parent().parent();
        next_fs = $(this).parent().parent().next();

        $('#progressbar li').eq($("fieldset").index(next_fs)).addClass("active");

        // Show the next fieldset
        next_fs.show();

        // Hide the current fieldset with style
        current_fs.animate({opacity:0}, {
            step: function(now, mx){
                //as the opacity of current_fs reduces to 0 - stored in "now"
                //1. Scale current-fs down to 80%
                scale = 1 - (1 - now) * 0.2;

                //2. bring next_fs from the right(50%)
                left = (now * 50)+"%";

                //3. inscrease opacity of next_fs to 1 as it moves in
                opacity = 1 - now;

                current_fs.css({
                    'transform': 'scale('+scale+')',
                    'position':'absolute'
                });
                next_fs.css({'left': left, 'opacity': opacity});
            },
            duration: 800,
            complete: function(){
                current_fs.hide();
                animating = false;
            },

            // This comes from the custom easing plugin (from cdn)
            easing:('easeInOutBack')
        });

    }
});

$(".previous").click(function(){
    if(animating) return false;
    animating = true;

    current_fs = $(this).parent().parent();
    previous_fs = $(this).parent().parent().prev();

    //de-activate current step on progressbar
    $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

    //show the previous fieldset
    previous_fs.show();
    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
        step: function(now, mx) {
            //as the opacity of current_fs reduces to 0 - stored in "now"
            //1. scale previous_fs from 80% to 100%
            scale = 0.8 + (1 - now) * 0.2;
            //2. take current_fs to the right(50%) - from 0%
            left = ((1-now) * 50)+"%";
            //3. increase opacity of previous_fs to 1 as it moves in
            opacity = 1 - now;
            current_fs.css({'left': left});
            previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
        },
        duration: 800,
        complete: function(){
            current_fs.hide();
            animating = false;
        },
        //this comes from the custom easing plugin
        easing: 'easeInOutBack'
    });
});





// ---------------------- AFFICHAGE DES SOUS-CATEGORIES EN FONCTION DU CHOIX DE CATEGORIE ---------------------- //


$('#product_category').change(function(){
    let selectedCategory = $('#product_category option:selected').text();
    let quantity =  $('#ProductQuantity');

    function hideOtherSelect(){
        $('.subproduct-item').addClass('d-none');
    }

    switch(selectedCategory) {

        case 'Logo & identité' :
            $('.subproduct-item').addClass('d-none');
            quantity.addClass('d-none');
            break;

        case 'Support de communication imprimé' :
            hideOtherSelect();
            $('#print_subproduct').removeClass('d-none');
            quantity.removeClass('d-none');
            break;

        case 'Création de site internet' :
            hideOtherSelect();
            $('#web_subproduct').removeClass('d-none');
            quantity.addClass('d-none');
            break;

        case 'Marketing digital' :
            hideOtherSelect();
            $('#marketing_subproduct').removeClass('d-none');
            quantity.addClass('d-none');
            break;

        case 'Infographie' :
            hideOtherSelect();
            $('#infographic_subproduct').removeClass('d-none');
            quantity.addClass('d-none');
            break;

        case '3D & Vidéo' :
            hideOtherSelect();
            $('#motion_subproduct').removeClass('d-none');
            quantity.addClass('d-none');
            break;

        case 'Execution graphique' :
            hideOtherSelect();
            $('#exe_subproduct').removeClass('d-none');
            quantity.addClass('d-none');
            break;

        case 'Accessoires publicitaires' :
            hideOtherSelect();
            $('#object_subproduct').removeClass('d-none');
            quantity.removeClass('d-none');
            break;

        case 'Vêtements publicitaires' :
            hideOtherSelect();
            $('#textile_subproduct').removeClass('d-none');
            quantity.removeClass('d-none');
            break;

        case 'Stand & evenementiel' :
            hideOtherSelect();
            $('#event_subproduct').removeClass('d-none');
            quantity.removeClass('d-none');
            break;
    }

});

$('#quotation_reference').change(function(){
    let filename = $(this).val();
    $('.filename').html(filename);
});



