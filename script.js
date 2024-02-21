//index page java script
function redirectToProductPage(productId) {
  window.location.href = 'product.php?id=' + productId;
}

//navbar menu media query
function toggleNavbar() {
  const navbar = document.querySelector('#navbar');
  navbar.classList.toggle('active');
}

function closeNavbar() {
  const navbar = document.querySelector('#navbar');
  navbar.classList.remove('active');
}































 














// cart page javascripting
// function updateCart() {
//   var productRows = document.querySelectorAll('.product-row');
//   var cartSubtotal = 0;
//   var cartTotal = 0;

//   // Check if the cart is empty
//   if (productRows.length === 0) {
//       var shippingFeeElement = document.getElementById('shipping-fee');
//       shippingFeeElement.innerText = 'free'; // No shipping fee for an empty cart
//   } else {
//       productRows.forEach(function(row) {
//           var priceCell = row.querySelector('.product-price');
//           var quantityInput = row.querySelector('.quantity-input');
//           var subtotalCell = row.querySelector('.subtotal');

//           var price = parseFloat(priceCell.innerText.replace('$', ''));
//           var quantity = parseInt(quantityInput.value);

//           var subtotal = price * quantity;
//           subtotalCell.innerText = '$' + subtotal.toFixed(2);

//           cartSubtotal += subtotal;
//       });

//       var shippingFee = cartSubtotal < 1000 ? 50 : 0;
//       var shippingFeeElement = document.getElementById('shipping-fee');
//       shippingFeeElement.innerText = shippingFee === 0 ? 'free' : '$' + shippingFee.toFixed(2);

//       cartTotal = cartSubtotal + shippingFee;
//   }

//   var cartSubtotalElement = document.getElementById('cart-subtotal');
//   cartSubtotalElement.innerText = '$' + cartSubtotal.toFixed(2);

//   var cartTotalElement = document.getElementById('cart-total');
//   cartTotalElement.innerHTML = '<strong>$' + cartTotal.toFixed(2) + '</strong>';
// }

// document.querySelectorAll('.quantity-input').forEach(function(input) {
//   input.addEventListener('input', updateCart);
// });

// window.addEventListener('load', updateCart); // Call updateCart() on page load

