import './bootstrap';

// Import any required libraries
import $ from 'jquery';

// Add your custom JavaScript code here
$(document).ready(function() {
    $(document).on('click', '.add-to-favorite', function(e) {
        e.preventDefault();
        var itemId = $(this).data('item-id');
        var url = $(this).data('url'); // Get the route URL from data attribute
        $.ajax({
            url: url,
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "item_id": itemId
            },
            success: function(response) {
                alert(response.message);
            },
            error: function(xhr, status, error) {
                var errorMessage = xhr.responseJSON.message;
                alert(errorMessage);
            }
        });
        
    });
    // Add item to cart
    $(document).on('click', '.add-to-cart', function(e) {
        e.preventDefault();
        var itemId = $(this).data('item-id');
        $.ajax({
            url: '/cart-items',
            type: 'POST',
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                "item_id": itemId
            },
            success: function(response) {
                alert(response.message);
            },
            error: function(xhr, status, error) {
                alert('Error adding item to cart');
            }
        });
    });

    // Remove item from cart
    $(document).on('click', '.remove-from-cart', function(e) {
        e.preventDefault();
        var cartItemId = $(this).data('cart-item-id');
        $.ajax({
            url: '/cart-items/' + cartItemId,
            type: 'DELETE',
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                alert(response.message);
                location.reload();
            },
            error: function(xhr, status, error) {
                alert('Error removing item from cart');
            }
        });
    });
});

