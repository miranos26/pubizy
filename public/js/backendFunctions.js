
// Menu Toggle Script sidebar //

$("#menu-toggle").click(function(e){
    e.preventDefault();
    $("#wrapper").toggleClass("menuDisplayed")
});

$('#quotation_response_responseAttachment').change(function(){
    let filename = $(this).val();
    $('.filename').html(filename);
});