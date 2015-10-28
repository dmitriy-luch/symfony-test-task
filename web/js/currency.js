$(document).ready(function()
{
    $('.language-form select').bind('change', function(){
        $('.view-content').load(
            $(this).parents('form').attr('action'),
            $(this).parents('form').serialize()
        );
    });
});