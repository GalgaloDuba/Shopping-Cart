
$(document).ready(function() {
    // Removing item from cart
    $('.remove-from-cart').on('click', function(e) {
        e.preventDefault();
        let itemId = $(this).data('id');
        
        $.ajax({
            url: 'cart_remove.php',
            type: 'GET',
            data: {id: itemId},
            success: function(response) {
                if (response.status == 'success') {
                    alert(response.message);
                    // Optionally, refresh the cart
                    location.reload();
                } else {
                    alert(response.message);
                }
            },
            error: function() {
                alert('Error removing item from cart');
            }
        });
    });
});
