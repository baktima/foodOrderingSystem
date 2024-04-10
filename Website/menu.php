<?php 
require_once '../include/config_session.inc.php'; 

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
?>

<html>
<head>
	<title> Menu</title>
	<link rel="stylesheet" href="CSS/home.css">
	<link rel="stylesheet" href="CSS/menu.css">
	<link rel="stylesheet" href="CSS/cart.css">
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
			<li><a href="#">Promotion</a></li>
			<li><a href="#">Delivery</a></li>
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
			<li><a href="#">type</a></li>
			<li><a href="#">type</a></li>
			<li><a href="#">type</a></li>
			<li><a href="#">type</a></li>
			<li><a href="#">type</a></li>
			<li><a href="#">type</a></li>
		</ul>
	</div>
	<div class="menu">
		<div class="card">
			<img src="img/cheese burger.jpg">			
			<div class="card-content">
				<div class="desc">
					<h2>food</h2>
					<h4>$$$</h4>
				</div>
				<button class="foodButtons" data-food-id="WS01">Add to Cart</button>
				<span id="cartIdDisplay"></span>
			</div>	
		</div>
	</div>
</div>
<aside class="">
	<div class="cartTab">
		<h1>Shopping Cart</h1>
		<div class="listcart">
			<div class="cartItem">	
				<div class="name">
					NAME
				</div>
				<div class="cartPrice">
					$$$
				</div>
				<div class="cartQuantity">
					<button><</button>
					<span>0</span>
					<button>></button>
				</div>
			</div>
		</div>
		<div class="cartbutton">
			<button class="close">Close</button>
			<button class="checkOut">Check out</button>
		</div>
	</div>
</aside>
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

<script>
    var email = "<?php echo $email; ?>";
</script>

<!-- this is really important, i change the folder into JSA cause if JS only, it detects
the other JS file from other folder, i don't know how but just change the js folder name
and change the source of the folder and should be working fine -->
<script src="JSA/addToCart.js"></script>
<script src="JSA/cart.js"></script>

</body>
</html>