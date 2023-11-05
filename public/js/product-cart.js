$('.cart').click(function () {

  var flash_msg_id = 'flash-messages-' + $(this).data('product_id');
  $.ajax({
    type: 'GET',
    url: addToCartUrl,
    data: { product_id: $(this).data('product_id'), quantity: 1 },
    success: function(data) {
      showFlashMessage("Added to cart successfully!", "success",flash_msg_id);
    },
    error: function(xhr, status, error) {
      showFlashMessage("There's some error.", "error",flash_msg_id);
    }
  });
});

$(document).on('click', '.quantity', function () {
  var product_id = $(this).data('product_id');
  $.ajax({
    type: 'GET',
    url: updateCartUrl,
    data: { product_id: product_id, type:$(this).data('type') },
    success: function (data) {
      if (data.success == true) {
        $('.product-count-'+ product_id).html(data.productQuantity);  
        $('.product-price-'+ product_id).html(data.productPrice);  
        $('.total-price').html(data.totalPrice);  
      }      
    },
    error: function(xhr, status, error) {
      console.log(xhr);
    }
  });
});

$('.close').click(function () {

  var flash_msg_id = 'flash-message';
  var product_id = $(this).data('product_id');
  $.ajax({
    type: 'GET',
    url: deleteCartUrl,
    data: { product_id: product_id },
    success: function (data) {
      if (data.success == true) {
        $('#product-'+ product_id).remove(); 
        $('.total-price').html(data.totalPrice);
        $('.total-count').html(data.totalCount);
        showFlashMessage("Product deleted successfully!", "success",flash_msg_id);
      } else {
         showFlashMessage("There's some error.", "error",flash_msg_id);
      }
    },
    error: function(xhr, status, error) {
      showFlashMessage("There's some error.", "error",flash_msg_id);
    }
  });
});

$('#sort-select').change(function () {
  $('.product-list').html('');
  $('#loader').show();
  $.ajax({
    type: 'GET',
    url: sortProducts,
    data: { type: $(this).val() },
    success: function (data) {
      $('#loader').hide();
      $('.product-list').html(data.view);
    },
    error: function(xhr, status, error) {
    }
  });
});
