<?php 
require_once 'include/config_session.inc.php'; 
require_once 'include/signup_view.inc.php'; 
require_once 'include/login_view.inc.php'; 

?>

<!DOCTYPE html>
<html lang = "en">



<head>
    <title>Document</title>
</head>

    <body>
        <h3>
             <?php
             output_username()
             ?>

        </h3>

        <?php
        if(!isset($_SESSION["user_email"])){ ?>

            <h3>Login</h3>

        <form action = "include/login.inc.php" method = "post">
            <input type="password" name="pwd" placeholder="Password">
            <input type="text" name="email" placeholder="E-Mail">
            <button>Login</button>
        </form>

        
        <?php } ?>

        <?php
        check_login__errors();
         ?>
    </body>

    <body>

    <?php
        if(!isset($_SESSION["user_email"])){ ?>
        
        <h3>Signup</h3>

        <form action = "include/signup.inc.php" method = "post">
            <input  type="username" name="name" placeholder="Username">
            <input type="password" name="pwd" placeholder="Password">
            <input type="text" name="email" placeholder="E-Mail">
            <button>Signup</button>
        </form>

        <?php } ?>

        <?php
        check_signup_errors(); 
        
        ?>

        <!-- <?php if(isset($_SESSION["user_email"])){ ?>

            <?php include 'Website/home.html'; ?>


            <?php }?> -->

        <h3>logout</h3>

        <form action = "include/logout.inc.php" method = "post">
            <button>logout</button>
        </form>


    </body>

</html>
