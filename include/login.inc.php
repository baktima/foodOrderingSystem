<?php


if($_SERVER["REQUEST_METHOD"] === "POST"){
    $email = $_POST["email"]; 
    $pwd = $_POST["pwd"]; 

    try {
       require_once("dbh.inc.php");
       require_once("login_model.inc.php");
       require_once("login_contr.inc.php");

    //Error handler
    $errors = []; 

    //let this be a painfull reminder and lesson bycrpt doesnt work if the varchar of the sql is less than 60 better make it 255
    if (is_input_empty($pwd, $email)) { 
        //each of the code inside the if statement if return true will fill the error array 

        $errors["empty_input"] = "Fill in all fields"; 
    }

    $result = get_user($pdo, $email); 

    if(is_email_wrong($result)) {
        $errors["login_incorrect"] = "incorrect login info1";
    }
    if (!is_email_wrong($result) && is_password_wrong($pwd, $result["passkey"])){
        $errors["login_incorrect"] = "Incorrect login info for email: " .is_password_wrong($pwd, $result["passkey"]). ", and password: " . password_verify($pwd, $result["passkey"]);
    }
  

    //need to call the config first, because the session havent started yet to store the data for the error handling
    //can use session_start() but using the config session is more safe from attacks, can be pointed out for creative points 
    
    require_once 'config_session.inc.php'; 


    //if there data inside the array errors, it will return true 
    if($errors){ 
        $_SESSION["error_login"] = $errors; 
        header("Location: ../index.php");
        die();
    }
    //security
    $newSessionId = session_create_id(); 
    $sessionId = $newSessionId . "_". $result["id"]; 
    session_id($sessionId);


    $_SESSION["user_id"] = $result["id"];
    $_SESSION["user_email"] = htmlspecialchars($result["email"]);

    $_SESSION["last_regeneration"] = time();

    HEADER("Location: ../index.php?login=success");

    $pdo = null; 
    $stmt = null; 

    die(); 

    } catch (PDOException $e) {
        die("Query failed: ". $e->getMessage());
    }


}

else{
    header("Location: ../index.php"); 
    die(); 

}
