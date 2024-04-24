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
	<title> Home</title>
	<link rel="stylesheet" href="CSS/home.css">
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
			<a href="#"><img src="img/Cart.png" id="navtop_img"></a>
		</div>
	</div>
	<div class="navbar">
		<ul>
			<li><a href="home.php" style="color:red;">Home</a></li>
			<li><a href="menu.php">Menu</a></li>
			<li><a href="History.php">Order History</a></li>
			<li><a href="#">About us</a></li>
		</ul>
	</div>		
	<div class="line">
		<hr width="80%" />
	</div>
</header>

<section>
	<div class="banner">
		<div class="banner-desc">
			<h1>Start Ordering Now!!</h1>
		</div>
		<div>
			<a href="menu.html"><button><span id="button-text">Menu</span></button></a>
		</div>
	</div>
</section>

<div class="app-advert">
	<img src="img/app_banner.png">
	<div class="store-link">
		<a href="#"><img src="img/appstore_icon.png"></a>
		<a href="#"><img src="img/playstore_icon.png"></a>
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
</body>
</html>