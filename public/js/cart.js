$(document).ready(function () {
    // Handle form submission when "Update cart" button is clicked
    $('form[name="update_cart"]').submit(function (event) {
        event.preventDefault(); // Prevent the default form submission

        // Serialize the form data
        var formData = $(this).serialize();

        // Send an AJAX request to update the cart
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            success: function (data) {
                // Update the cart update message
                $('#cart-update-message').html('<div class="alert alert-success">Cart has been updated successfully.</div>');
            },
            error: function (error) {
                // Handle the error if the update fails
                $('#cart-update-message').html('<div class="alert alert-danger">Failed to update cart. Please try again.</div>');
            },
        });
    });
});
