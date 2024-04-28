document.addEventListener('DOMContentLoaded', function() {
    
    //this part just adding the increase and decrease function for the button part 
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
            
            // Update total payment
            updateTotalPayment();
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
                
                // Update total payment
                updateTotalPayment();
            }
        });
    });

    //handle the request to the php server side (very intuitive i quite like it, i think i will practice using this more)
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

    // Function to update total payment
    function updateTotalPayment() {
        var totalPayment = 0;
        const cartItems = document.querySelectorAll('.cartItem');
        cartItems.forEach(function (item) {
            var price = parseFloat(item.querySelector('.cartPrice').textContent);
            var quantity = parseInt(item.querySelector('.quantity').textContent);
            totalPayment += price * quantity;
        });

        console.log(totalPayment);

        // Display the total payment in the UI
        document.getElementById('totalPayment').textContent = totalPayment.toFixed(2); // Assuming you have an element with id 'totalPayment'
    }
});