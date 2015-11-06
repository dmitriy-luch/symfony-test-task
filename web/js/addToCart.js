$(document).ready(function()
{
    $(document).on('submit', '.add-to-cart-form' ,function(e){
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            context: this,
            data: $(this).serialize(),
        }).success(function( data ) {
            var $dataElement = $('<div>').append($(data));
            var $addToCartForm = $dataElement.find('.add-to-cart-form');
            var $cartComponent = $dataElement.find('#cart');
            if($addToCartForm.length)
            {
                $(this).replaceWith($addToCartForm);
            }
            if($cartComponent.length){
                alert('Product successfully added');
                $('#cart').replaceWith($cartComponent);
                $(document).scrollTop(0);
            }
        }).error(function(data){
            alert('Failed to add product. Please try again');
        });
        e.preventDefault();
    });
});