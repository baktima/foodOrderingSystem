<?php 
require_once '../include/config_session.inc.php'; 

?>

<html>
<head>
	<title> Website Test</title>
	<link rel="stylesheet" href="CSS/home.css">
	<link rel="stylesheet" href="CSS/menu.css">
</head>
<body>
<header>	
	<div class="navtop">
	<img src="img/Logo.png" class="navtop_img">
		<div class="logcart">
		<!-- <form action = "../include/logout.inc.php" method = "post"> -->
			<button>logout</button>
		<img src="img/Cart.png" class="navtop_img">
		</div>
	</div>
	<div class="navbar">
		<ul>
			<li><a href="home.php">Home</a></li>
			<li><a href="menu copy.php" style="color:red;">Menu</a></li>
			<li><a href="#">Promotion</a></li>
			<li><a href="#">Delivery</a></li>
			<li><a href="#">About us</a></li>
		</ul>
	</div>		
	<div class="line">
		<hr width="80%" />
	</div>
</header>

<div class="menu">
	<div class="card">
		<img src="img/item.png">			
		<div class="card-content">
			<div class="desc">
				<h2>cheeseburger</h2>
				<h4>$$$</h4>
			</div>
			<button class="foodButtons" data-food-id="WS01">Add to Cart</button>
			<span id="cartIdDisplay"></span>
		</div>	
	</div>
</div>

<footer>
	<div class="line">
		<hr width="80%" />
	</div>
	<div class="Sosmed">
		<img src="img/Face.png" class="Social_Logo">
		<img src="img/Insta.png" class="Social_Logo">
		<img src="img/Tiktok.png" class="Social_Logo">
		<img src="img/Twitter.png" class="Social_Logo">
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

<?php
// Check if the user is logged in and email is set in the session
if(isset($_SESSION['user_email'])) {
    $email = $_SESSION['user_email'];
} else {
    // Handle if the user is not logged in
    $email = null;
}
echo "Email: " . $email;
?>

<script>
    var email = "<?php echo $email; ?>";
</script>
<script src="JS/addToCart.js"></script>

</body>
</html>