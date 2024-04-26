<?php 
require_once '../include/config_session.inc.php'; 
require_once '../include/dbh.inc.php';
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
	<link rel="stylesheet" href="CSS/history.css">
	<link rel="stylesheet" href="CSS/carts.css">
</head>
</body>

<div class="pageContent">
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
			<li><a href="menu.php">Menu</a></li>
			<li><a href="History.php"style="color:red;">Order History</a></li>
			<li><a href="#">About us</a></li>
		</ul>
	</div>		
	<div class="line">
		<hr width="80%" />
	</div>
</header>
	<div class="historyLog">
		<!-- Start Copy-->
			<div class="card">			
				<div class="card-content">
					<div>
						<div class="">
							<h4>Checkout ID</h4>
							<h5>XXXX-XXXX<h5>
						</div>
						<div>
							<H4>Order Date</H4>
							<h5>DD/MM/YYYY</h4>
						</div>
					</div>
					
					<div>
						<!-- Start Copy-->
						<div class="foodHist">
							<h4>Food Name</h4>
							<h4>x1</h4>
						</div>
						<!-- End Copy-->
						<!-- Start Copy-->
						<div class="foodHist">
							<h4>Food Name</h4>
							<h4>x1</h4>
						</div>
						<!-- End Copy-->
						<!-- Start Copy-->
						<div class="foodHist">
							<h4>Food Name</h4>
							<h4>x1</h4>
						</div>
						<!-- End Copy-->
						<!-- Start Copy-->
						<div class="foodHist">
							<h4>Food Name</h4>
							<h4>x1</h4>
						</div>
						<!-- End Copy-->
						<!-- Start Copy-->
						<div class="foodHist">
							<h4>Food Name</h4>
							<h4>x1</h4>
						</div>
						<!-- End Copy-->
					</div>
					
					<div>
					<H4>Total Price</H4>
					<h5>$$$</h5>
					</div>
				</div>	
			</div>
		<!-- End Copy-->
		<!-- Start Copy-->
			<div class="card">			
				<div class="card-content">
				</div>	
			</div>
		<!-- End Copy-->
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
</div>
<aside class="">
	<form id="cart">
		<div class="cartTab">
			<h1>Shopping Cart</h1>
			<div class="listcart">
			<!-- start copy -->
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
			<!-- End Copy -->
			
				<div class="checkOut">
						<h1>Location:</h1>
					<div class="locOpt">
						<button onclick="delAddress(0)">Dine In</button>
						<button onclick="delAddress(1)">Delivery</button>
					</div>
					<div class="delLoc">
					 <textarea id="delAddress" ></textarea>
					</div>
					<h1>Payment Option:</h1>
					<div class="payOpt">
						<select>
							<option value="card">Card</option>
						  <option value="grab">Grab</option>
						  <option value="TNG">Touch 'n Go</option>
						  <option value="Spay">Shopee Pay</option>
						</select>
					</div>
					<h1>Total payment:</h1>
					<div class="totalPay">
						<h1>
							$$$
						</h1>
					</div>
				</div>	
			</div>
			<div class="cartbutton">
				<button class="close">Close</button>
				<button class="checkOut">Place Order</button>
			</div>
		</div>
	</form>
</aside>

<script>
    var email = "<?php echo $email; ?>";
</script>
<script src="JSA/addToCart.js"></script>
<script src="JSA/cart.js"></script>
</body>
</html>
