<?php

declare(strict_types=1); 

function check_signup_errors(){
    //checking the session for the error of the sign up 
    //i think its like creating a sesion inside a session 
    if(isset($_SESSION["error_signup"])){
        $errors = $_SESSION["error_signup"]; 

        echo "<br>"; 

        foreach($errors as $error){ 
            echo '<p class="form-error">' . $error. '</p>';
        }
        

        unset($_SESSION["error_signup"]); 
     }
     else if(isset($_GET["signup"]) && $_GET["signup"] === "success" ){ 
        echo '<br>'; 
        echo '<p class="form-success"> Signup success!</p>';
     }

}