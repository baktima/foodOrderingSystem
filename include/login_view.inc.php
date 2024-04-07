<?php
declare(strict_types=1);

function output_username(){ 
    if(isset($_SESSION["user_email"])){ 
        echo"You are logged in as " . $_SESSION["user_email"];
    }
    else{ 
        echo "you are not logged in";
    }
}

function check_login__errors(){ 
    if(isset($_SESSION["error_login"])){ 
        $errors = $_SESSION["error_login"];

        echo "<br>"; 
        foreach($errors as $error){
            echo '<p class="form-error">'.$error.'</p>';
        }

        unset($_SESSION["error_login"]);
    }
    else if(isset($_GET['login']) && $_GET['login'] === "success"){
        echo "<br>";
        echo '<p class="form-success">Login success!</p>';
        
    }

}