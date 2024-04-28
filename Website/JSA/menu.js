document.addEventListener('DOMContentLoaded', function () {
    // Add event listeners to food buttons
    const foodButtons = document.querySelectorAll('.foodButtons');
    foodButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            var foodId = this.getAttribute('data-food-id'); // Get the food ID from the button's data attribute

        var xhr = new XMLHttpRequest();
        xhr.open('GET', '../Website/PHP/getData.php?email=' +encodeURIComponent(email), true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {

                if (xhr.status === 200) {

                    var cartID = xhr.responseText;
					var trimmedCartID = cartID.replace(/^"|"$/g, '');
                    addToCart(foodId, trimmedCartID);

                } else {
                    // Handle errors if any
                    alert('Error adding food item to cart1!');
                }
            }
        };
        xhr.send();
    });
    });

    // Function to add item to cart
    function addToCart(foodId,cartId) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '../Website/PHP/add_to_cart.php', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    getDataCart(email);
                } else {
                    alert('Error adding food item to cart!');
                }
            }
        };
        const data = {
            food_Id: foodId,
            cart_Id: cartId // You may need to adjust this if cart ID is required
        };
        xhr.send(JSON.stringify(data));
    }

    // Function to fetch cart data
    function getDataCart(email) {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', '../Website/PHP/getDataCart.php?email=' + encodeURIComponent(email), true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    const cartItems = JSON.parse(xhr.responseText);
                    updateCartUI(cartItems);
                } else {
                    alert('Error fetching cart data!');
                }
            }
        };
        xhr.send();
    }

    // Function to update cart UI
    function updateCartUI(cartItems) {
        const cartContainer = document.querySelector('.cart_items');
        cartContainer.innerHTML = ''; // Clear existing cart items
        
        cartItems.forEach(cartItem => {
            const newCartItem = document.createElement('div');
            newCartItem.classList.add('cartItem');
            newCartItem.dataset.assignedCartId = cartItem.cart_id;
            
            const itemName = document.createElement('div');
            itemName.classList.add('name');
            itemName.textContent = cartItem.food_name;
    
            const itemPrice = document.createElement('div');
            itemPrice.classList.add('cartPrice');
            itemPrice.textContent = cartItem.food_price;
    
            const itemQuantity = document.createElement('div');
            itemQuantity.classList.add('cartQuantity');
            const decreaseBtn = document.createElement('button');
            decreaseBtn.setAttribute('type', 'button');
            decreaseBtn.classList.add('decrease');
            decreaseBtn.textContent = '-';
            const quantitySpan = document.createElement('span');
            quantitySpan.classList.add('quantity');
            quantitySpan.textContent = cartItem.food_quantity;
            const increaseBtn = document.createElement('button');
            increaseBtn.setAttribute('type', 'button');
            increaseBtn.classList.add('increase');
            increaseBtn.textContent = '+';
            
            const foodID = document.createElement('div');
            foodID.classList.add('foodID');
            foodID.dataset.assignedCartId = cartItem.food_id;
            
            itemQuantity.appendChild(decreaseBtn);
            itemQuantity.appendChild(quantitySpan);
            itemQuantity.appendChild(increaseBtn);
            itemQuantity.appendChild(foodID);
            
            newCartItem.appendChild(itemName);
            newCartItem.appendChild(itemPrice);
            newCartItem.appendChild(itemQuantity);
            
            cartContainer.appendChild(newCartItem);
        });
    
        // Add functionality for increase and decrease buttons
        var increaseButtons = document.querySelectorAll('.increase');
        var decreaseButtons = document.querySelectorAll('.decrease');
    
        increaseButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                console.log('Increase button clicked');
                var quantityElement = this.parentElement.querySelector('.quantity');
                var currentQuantity = parseInt(quantityElement.textContent);
                var newQuantity = currentQuantity + 1;
                quantityElement.textContent = newQuantity;
    
                // Send updated quantity to server using AJAX
                var cart_id = this.parentElement.parentElement.dataset.assignedCartId;
                var foodId = this.parentElement.parentElement.querySelector('.foodID').dataset.assignedCartId;
                updateQuantity(foodId, newQuantity, cart_id);
            });
        });
    
        decreaseButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                console.log('decrease button clicked');
                var quantityElement = this.parentElement.querySelector('.quantity');
                var currentQuantity = parseInt(quantityElement.textContent);
                if (currentQuantity > 0) {
                    var newQuantity = currentQuantity - 1;
                    quantityElement.textContent = newQuantity;
    
                    // Send updated quantity to server using AJAX
                    var cart_id = this.parentElement.parentElement.dataset.assignedCartId;
                    var foodId = this.parentElement.parentElement.querySelector('.foodID').dataset.assignedCartId;
                    if (newQuantity === 0) {
                        deleteCartItem(cart_id, foodId); // Call the function to delete the item from the cart
                        this.parentElement.parentElement.remove();
                    } else {
                        updateQuantity(foodId, newQuantity, cart_id); // Update quantity if not 0
                    }
                }
            });
        });
    
        // Handle AJAX requests to update quantity and delete items
        function updateQuantity(foodId, quantity, cart_id) {
            var xhr = new XMLHttpRequest();
        xhr.open('POST', '../Website/PHP/modifyCart.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    console.log('Quantity updated successfully');
                    // Update UI or perform any necessary actions

                } else {
                    console.error('Error occurred:', xhr.statusText);
                }
            }
        };
        xhr.send('food_id=' + encodeURIComponent(foodId) + '&quantity=' + encodeURIComponent(quantity) + '&cart_ID=' + encodeURI(cart_id));
        }
    
        function deleteCartItem(cart_id, foodId) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../Website/PHP/deleteCart.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        console.log('Item deleted successfull');
                        // Update UI or perform any necessary actions
                    } else {
                        console.error('Error occurred:', xhr.statusText);
                    }
                }
            };
            
            xhr.send('cart_ID=' + encodeURIComponent(cart_id) + '&food_id=' + encodeURIComponent(foodId));
            console.log(cart_id);
        
        }
    }
    

});
