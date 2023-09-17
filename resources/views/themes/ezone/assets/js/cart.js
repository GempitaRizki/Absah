import 'jquery';
import $ from 'jquery'

jQuery(document).ready(function() {
    jQuery('input[name^="items["]').on('input', function() {
        var itemId = jQuery(this).data('item-id');
        var quantity = jQuery(this).val();
        
        jQuery.ajax({
            url: '/api/carts/update', 
            method: 'POST',
            data: {
                item_id: itemId,
                quantity: quantity
            },
            success: function(response) {
                console.log(response);
            },
            error: function(error) {
                console.error(error);
            }
        });
    });
});
