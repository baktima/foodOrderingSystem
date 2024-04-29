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
	<title> Menu</title>
	<link rel="stylesheet" href="CSS/home.css">
	<link rel="stylesheet" href="CSS/menu.css">
	<link rel="stylesheet" href="CSS/carts.css">
</head>
<body>
<header>	
	<div class="navtop">
	<img src="img/Logo.png" id="navtop_img">
		<div class="logcart">
			<div class="dropdown">
				<button id="profile"><img src ="img/profile.png"><span><?php echo $email; ?></span></button>
				<div class="dropdown-content">
					<a href="edit_user.html">User Profile</a>
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
			<li><a href="menu.php" style="color:red;">Menu</a></li>
			<li><a href="History.php">Order History</a></li>
			<li><a href="#">About us</a></li>
		</ul>
	</div>		
	<div class="line">
		<hr width="80%" />
	</div>
</header>
<div class="content">
	<div class="Category">
		<h2>Category</h2>
		<ul>
			<li><a href="menu.php">All</a></li>
			<li><a href="western.php">Western</b></a></li>
			<li><a href="japanese.php">Japanese</a></li>
			<li><a href="chinese.php"><b>Chinese</b></a></li>
			<li><a href="arabic.php">Arabic</a></li>
			<li><a href="beverages.php">Beverages</a></li>
		</ul>
	</div>
	<div class="menu">

	<?php 
$query = "SELECT * FROM food";
$statement = $pdo->prepare($query);
$statement->execute();

// Fetch all results as an associative array
$foods = $statement->fetchAll(PDO::FETCH_ASSOC);


// Loop through each food item and display it
foreach($foods as $food) {

	if($food["Type_id"] == "FT04") {
	$imageData = base64_encode($food['image']);

    echo "
		<div class='card'>
        	<img src='data:image/jpg;base64,{$imageData}'>            
        	<div class='card-content'>
            	<div class='desc'>
                	<h3>{$food['name']}</h3> 
                	<h4>{$food['price']}</h4> 
				</div>
            	<button class='foodButtons' data-food-id='{$food['food_id']}'>Add to Cart</button>
            	<span id='cartIdDisplay'></span> 
        </div>
		</div>  
    "; 
}
}
?>
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
				<<button type="button" class="close">Close</button>
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