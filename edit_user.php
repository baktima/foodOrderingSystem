<?php 
require_once '../include/config_session.inc.php'; 
require_once '../include/dbh.inc.php';
require_once '../include/error_view.inc.php';
?>

<?php
// Check if the user is logged in and email is set in the session
//also getting the email from the database
if(isset($_SESSION['user_email'])) {
    $email = $_SESSION['user_email'];
} else {
    // Handle if the user is not logged in
    $email = null;
}

if ($email){
    $query = "SELECT customer.*, customer_name.name
              FROM customer
              INNER JOIN customer_name ON customer.customer_ID = customer_name.customer_ID
              WHERE customer.email = :email";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':email', $email);
    $statement->execute(); 

    $persons = $statement->fetchAll(PDO::FETCH_ASSOC); 
    
    // Check if any rows were returned
    if ($persons) {
        // Loop through each row in the result set
        foreach ($persons as $person) {
            $name = $person['name'];
            // Process the name as needed
        }
    } else {
        $name=null;
    }

	// Check if any rows were returned
    if ($persons) {
        // Loop through each row in the result set
        foreach ($persons as $person) {
            $address = $person['address'];
            // Process the name as needed
        }
    } else {
        $address=null;
    }

	if ($persons) {
        // Loop through each row in the result set
        foreach ($persons as $person) {
            $phone = $person['phoneNumber'];
            // Process the name as needed
        }
    } else {
        $phone=null;
    }
	
}


?>

<html>
<head>
<title>Edit User</title>
	<link rel="stylesheet" href="CSS/edit_user.css">
	<link rel="stylesheet" href="CSS/home.css">
	<link rel="stylesheet" href="CSS/carts.css">
	
	<script>
	function ShowPass() {
	  var x = document.getElementById("Pass");
	  if (x.type === "password") {
		x.type = "text";
	  } else {
		x.type = "password";
	  }
	}
	</script>
</head>
<body>
<header>	
	<div class="navtop">
	<img src="img/Logo.png" id="navtop_img">
		<div class="logcart">
			<div class="dropdown">
				<button id="profile"><img src ="img/profile.png"><span><?php echo $email; ?></span></button>
				<div class="dropdown-content">
					<a href="edit_user.php">User Profile</a>
					<form action = "../include/logout.inc.php" method = "post">
						<button><span>Log out</span></button>
					 </form>
				</div>
			</div>
			<img src="img/Cart.png" id="navtop_img" class="cartIcon">
		</div>
	</div>
	<div class="navbar">
		<ul>
			<li><a href="home.php">Home</a></li>
			<li><a href="menu.php">Menu</a></li>
			<li><a href="history.php">Order History</a></li>
			<li><a href="#">About us</a></li>
		</ul>
	</div>		
	<div class="line">
		<hr width="80%" />
	</div>
</header>
<div class="container">
	<div class="card">			
		<div class="card-content">
			<h1>User Profile</h1>
			<?php
				if (isset($_SESSION['error_user'])) {
					displayErrors($_SESSION['error_user']);
					unset($_SESSION['error_user']); // Clear the error session variable after displaying errors
				}
			?>
			<form action='../include/user_profile.inc.php' method = "post">
			<span>E-mail</span>
            <input type="text" name="email" value="<?php echo $email; ?>" placeholder="E-Mail">
                
            <span>Username</span>
            <input type="text" name="name"  value="<?php echo $name; ?>" placeholder="Username">
                
            <span>Password</span>
            <input type="password" name="pwd"  placeholder="New Password" id="Pass" >
			<button onclick="ShowPass(); return false;" id="show-button">Show</button>
			<br>
		   <button id="acc">Apply</button>
		   <input type="reset" id="acc" value="Reset">
			</form>
		</div>	
	</div>
</div>
<footer>
	<div class="line">
		<hr width="80%" />
	</div>
	<div class="Sosmed">
		<a href="#"><img src="img/Face.png" id="Social_Logo"></a>
		<a href="#"><img src="img/Insta.png" id="Social_Logo"></a>
		<a href="#"><img src="img/Tiktok.png" id="Social_Logo"></a>
		<a href="#"><img src="img/Twitter.png" id="Social_Logo"></a>
	</div>
	<div class="Bottom">
		<div>
			<ul>
				<li><a href="#">Company Sdn Bhd</a></li>
				<li><a href="#">COPYRIGHT 2024 © COMPANY</a></li>
				<li><a href="#">Company Registration No: 202403310001 (XTA12932-Z)</a></li>
				
			</ul>
		</div>	
		<div class="foot-right">
			<ul>
				<li><a href="#">Privacy Policy</a></li>
				<li><a href="#">Terms & Condition</a></li>
				<li><a href="#">Anti-Bribery Corruption Policy</a></li>
			</ul>
		</div>
	</div>
</footer>

<aside class="">
	<form action='../include/Add_checkout_info.inc.php' method="post">
		<div class="cartTab">
			<h1>Shopping Cart</h1>
			<div class="listcart">
				<div class="cart_items">
				<?php
				echo '<script src="JSA/cart.js"></script>';
				echo '<script src="JSA/updateCart.js"></script>';
				//Fetch cart items only if the user is logged in and has an email set
				if ($email) {
					$query = "SELECT cart.*, food.name AS food_name, food.price AS food_price 
				FROM cart 
				JOIN food ON cart.food_id = food.food_id 
				JOIN customer ON cart.cart_id = customer.assigned_Cart_ID 
				WHERE customer.email = :email";
					$statement = $pdo->prepare($query);
					$statement->bindParam(':email', $email);
					$statement->execute();
					$cart_items = $statement->fetchAll(PDO::FETCH_ASSOC);

					// Check if there are cart items
					if ($cart_items) {
						foreach ($cart_items as $cart_item) {
							// Print cart items
							echo '
						<div class="cartItem" data-assigned-Cart-ID="' . $cart_item['cart_id'] . '">
						<div class="name">' . $cart_item['food_name'] . '</div>
						<div class="cartPrice">' . $cart_item['food_price'] . '</div>
						<div class="cartQuantity">
						<button type="button" class="decrease">-</button>
						<span class="quantity">' . $cart_item['food_quantity'] . '</span>
						<button type="button" class="increase">+</button>
						<div class="foodID" data-assigned-Cart-ID="' . $cart_item['food_id'] . '"></div>
						</div>
						</div>';
						}
					} else {
						// Handle case when there are no cart items
						echo '<div class="emptyCartMessage">Your cart is empty</div>';
					}
				}
				?>
			</div>
				<div class="checkOut">
					<?php
						if (isset($_SESSION['error_user'])) {
							displayErrors($_SESSION['error_user']);
							unset($_SESSION['error_user']); // Clear the error session variable after displaying errors
						}
					?>
						<h1>Delivery Location:</h1>
					<div class="delLoc">
					<textarea id="delAddress" name="address"  placeholder="Your address here...."><?php echo $address; ?></textarea>
					</div>
						<h1>Phone Number:</h1>
					<div class="Phone">
					<input type="text" name="phone" value="<?php echo $phone; ?>"placeholder="Your Phone Number here....">
					</div>
					<h1>Payment Option:</h1>
					<div class="payOpt">
						<select>
							<option value="1">Card</option>
							<option value="2">Grab</option>
							<option value="3">Touch 'n Go</option>
							<option value="4">Shopee Pay</option>
						</select>
					</div>
					<h1>Total payment:</h1>
					<div class="totalPay">
						<h1 id="totalPayment"></h1>
					</div>
				</div>
			</div>
			<div class="cartbutton">
				<button type="button" class="close">Close</button>
				<button class='cartButtons'>Place Order</button>
			</div>
		</div>
	</form>
</aside>

<script>
    var email = "<?php echo $email; ?>";
</script>

<script src="JSA/addToCart.js"></script>
</body>
</html>