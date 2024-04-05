

// var email = "<?php echo $email;?>";
// //check the console for error handling 

console.log(email);

var foodButtons = document.querySelectorAll('.foodButtons');

foodButtons.forEach(function(button) {
    button.addEventListener('click', function() {
        var foodId = this.getAttribute('data-food-id'); // Get the food ID from the button's data attribute

        var xhr = new XMLHttpRequest();
        xhr.open('GET', '../../Website/PHP/getData.php?email=' +encodeURIComponent(email), true);

        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {

                if (xhr.status === 200) {

                    var cartID = xhr.responseText;
					var trimmedCartID = cartID.replace(/^"|"$/g, '');
                    addToCart(foodId, trimmedCartID);
                } else {
                    // Handle errors if any
                    alert('Error adding food item to cart!');
                }
            }
        };
        xhr.send();
    });
});

	function addToCart(foodId, cartId){ 

		var xhr = new XMLHttpRequest();
		// .. is to go back 1 folder
    	xhr.open('POST', '../PHP/add_to_cart.php', true);

		//using json to send 2 data for the query 
    	xhr.setRequestHeader('Content-Type', 'application/json');

		console.log(foodId);
		console.log(cartId);
		var data = { 
			food_Id:foodId,
			cart_Id:cartId
		};
		console.log(data);


    	xhr.onreadystatechange = function() {
        	if (xhr.readyState === XMLHttpRequest.DONE) {
            	if (xhr.status === 200) {
                // Handle the response from the server if needed
					alert(xhr.responseText);
            	} else {
                // Handle errors if any
                	alert('Error adding food item to cart!');
            	}
        	}
		
    };
		
	xhr.send(JSON.stringify(data));

	}