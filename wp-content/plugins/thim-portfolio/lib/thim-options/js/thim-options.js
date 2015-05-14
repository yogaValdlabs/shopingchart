jQuery(document).ready(function($) {
    //Masked Inputs (images as radio buttons)
    $('.of-radio-img-img').click(function() {
        $(this).parent().parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
        $(this).addClass('of-radio-img-selected');
    });

    $('.of-radio-img-img-header').click(function() {
        $(this).parent().parent().parent().find('.of-radio-img-img-header').removeClass('of-radio-img-selected');
        $(this).addClass('of-radio-img-selected');
    });

    $('.of-radio-img-radio').hide();
});
