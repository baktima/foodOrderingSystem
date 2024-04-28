const addToCartButtons = document.querySelectorAll('.foodButtons');

addToCartButtons.forEach(button => {
  button.addEventListener('click', handleAddToCart);
});

function handleAddToCart(event) {
  event.preventDefault(); // Prevent default form submission behavior
  const foodId = event.target.dataset.foodId;

  // Get the current user's email (assuming it's stored somewhere)
  const email = document.querySelector('.user-email').textContent; // Adjust selector as needed

  // Send AJAX request to add item to cart
  fetch(`../include/add_to_cart.php?food_id=${foodId}&email=${encodeURIComponent(email)}`, {
    method: 'POST' // Use POST for adding data
  })
    .then(response => response.json()) // Parse the JSON response
    .then(data => {
      if (data.success) {
        // Update cart UI directly using the data from the response
        updateCartUI(foodId, data.cart_item);
      } else {
        // Handle errors (e.g., display an error message)
        console.error('Error adding to cart:', data.error);
      }
    })
    .catch(error => {
      // Handle network errors
      console.error('Network error:', error);
    });
}

function updateCartUI(foodId, cartItem) {
  // Find the cart container or specific item element (adjust selector as needed)
  const cartContainer = document.querySelector('.listcart');

  // Check if the item already exists in the cart
  const existingCartItem = cartContainer.querySelector(`.cartItem[data-assigned-Cart-ID="${cartItem.cart_id}"]`);

  if (existingCartItem) {
    // Update quantity for existing item
    existingCartItem.querySelector('.quantity').textContent = cartItem.food_quantity;
  } else {
    // Create a new cart item element
    const newCartItem = document.createElement('div');
    newCartItem.classList.add('cartItem');
    newCartItem.dataset.assignedCartId = cartItem.cart_id;

    // Add content to the new cart item element (adjust based on your HTML structure)
    newCartItem.innerHTML = `
      <div class="name">${cartItem.food_name}</div>
      <div class="cartPrice">${cartItem.food_price}</div>
      <div class="cartQuantity">
        <button type="button" class="decrease">-</button>
        <span class="quantity">${cartItem.food_quantity}</span>
        <button type="button" class="increase">+</button>
        <div class="foodID" data-assigned-Cart-ID="${cartItem.food_id}"></div>
      </div>
    `;

    console.log(newCartItem.innerHTML);

    // Add the new cart item to the cart container
    cartContainer.appendChild(newCartItem);
  }

  // Update total price (implementation depends on your logic)
  // ...
}
