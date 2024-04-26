<?php

require_once 'dbh.inc.php'; // Include database connection
require_once 'profile_model.inc.php'; // Include profile model functions
require_once 'profile_contr.inc.php'; // Include profile controller functions

session_start(); // Start the session

if(isset($_SESSION['user_email'])) {
    $email = $_SESSION['user_email'];
} else {
    // Handle if the user is not logged in
    $email = null;
}


if ($_SERVER["REQUEST_METHOD"] === "POST") { 
    $username = $_POST["name"];
    $newemail = $_POST["email"];
    $pwd = $_POST["pwd"];

    try {
        $errors = []; 

        // Input Validation
        if (empty($username) || empty($email)) { 
            $errors["empty_input"] = "Fill in all required fields"; 
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["invalid_email"] = "Invalid email syntax";
        }

        if ($errors) { 
            $_SESSION["error_edit_profile"] = $errors; 
            header("Location: edit_profile.php");
            exit();
        }

        // Get user ID from session or any other method you're using to identify the user
        

        // Update user information
        update_user($pdo, $email, $username, $email, $pwd);

        // Redirect user after successful update
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();

    } catch (PDOException $e) {
        die("Query failed: ". $e->getMessage()); 
    }

} else {
    // Handle if the request method is not POST
    header("Location: ../Website/edit_user.php"); 
    exit();
}
?>
