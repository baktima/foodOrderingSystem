<?php 
require_once '../include/config_session.inc.php'; 
require_once '../include/signup_view.inc.php'; 
require_once '../include/login_view.inc.php'; 
?>

<html>
<head>
	<title> Log In</title>
	<link rel="stylesheet" href="CSS/logandsign.css">
	<link rel="stylesheet" href="CSS/home.css">
	
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

<img src="img/Logo.png" id="Logo">

<div class="container">
	<div class="card">			
		<div class="card-content">
			<h1>Log In</h1>
			<p>Log In now to enjoy member exclusive!! 	</p>
			
<?php
//will print login error if input wrong or something like that;
check_login__errors();
 

 ?>
			<form action = "../include/login.inc.php" method = "post">
				<input type="text" name="email" placeholder="E-Mail">
				<input type="password" name="pwd" placeholder="Password" id="Pass">
				<button onclick="ShowPass(); return false;" id="show-button">Show</button>
				<br>
				<button id="acc">Login</button>
			</form>
		</div>	
	</div>
	<h3>Need an Account?</h3>
	<a href="Sign_Up.php"><button id="change">Sign Up</button></a>
</div>

<footer>
	<div class="line">
		<hr width="80%" />
	</div>
	<div class="Sosmed">
		<img src="img/Face.png" id="Social_Logo">
		<img src="img/Insta.png" id="Social_Logo">
		<img src="img/Tiktok.png" id="Social_Logo">
		<img src="img/Twitter.png" id="Social_Logo">
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