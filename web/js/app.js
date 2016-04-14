/**
 * Created by Afinogen on 13.04.2016.
 */

$(document).ready(function() {
    $('.js-change-code').on('change', function() {
        var code = $(this).val();
        $.ajax({
            url: $('.navbar-brand').attr('href') + 'event-code/get-variables?code='+code,
            success: function(data) {
                var vars = $.parseJSON(data);
                $('.js-template-variables').text(vars.join(', '));
            }
        });
    }).trigger('change');
});