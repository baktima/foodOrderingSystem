<?php

if($_SERVER["REQUEST_METHOD"] === "POST"){ 

    $username = $_POST["name"];
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];

    //htmlspecialcharacter()

    try {

        require_once 'dbh.inc.php'; 
        require_once 'signup_model.inc.php'; 
        require_once 'signup_contr.inc.php'; 

        //ERROR HANDLERS
        $errors = []; 

        if (is_input_empty($pwd, $email, $username)) { 
            //each of the code inside the if statement if return true will fill the error array 

            $errors["empty_input"] = "Fill in all fields"; 
        }
        if ( is_email_invalid($email)) {
            $errors["invalid_email"] = "invalid email syntax";
        }
        if ( is_email_taken($pdo,$email)){
            $errors["email_taken"] = "use another email or remember the old password";
        }

        //need to call the config first, because the session havent started yet to store the data for the error handling
        //can use session_start() but using the config session is more safe from attacks, can be pointed out for creative points 
        
        require_once 'config_session.inc.php'; 


        //if there data inside the array errors, it will return true 
        if($errors){ 
            $_SESSION["error_signup"] = $errors; 
            header("Location: ../index.php");
            die();
        }

        create_user($pdo, $email, $pwd, $username);
        header("Location: ../index.php?signup=success"); 

        $pdo = null; 
        $stmt = null; 
        die();

        
    } catch (PDOException $e) {
        die("Query failed: ". $e->getMessage()); 
    }

}
else{
    header("Location: ../index.php"); 

    die();// stop running the next codes
}