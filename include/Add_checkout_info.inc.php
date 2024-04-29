<?php
// Start the session
session_start();

require_once 'dbh.inc.php'; // Include database connection
require_once 'Add_checkout_info.model.inc.php'; // Include Add checkout model functions

// Check if the user is logged in
if(isset($_SESSION['user_email'])) {
    $email = $_SESSION['user_email'];
} else {
    // Handle if the user is not logged in
    // Redirect to the login page or show an error message
    header("Location: login.php"); 
    exit();
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") { 
    $address = $_POST["address"];
    $phone = $_POST["phone"];
    $payment = $_POST["payment"];

    try {
        $errors = []; 

        // Input Validation
        if (empty($address) || empty($phone)) { 
            $errors["empty_input"] = "Fill in all required fields"; 
        }

        if (!isPhoneNum($phone)) {
            $errors["invalid_phone"] = "Invalid phone number";
        }
        
        if ($errors) { 
            $_SESSION["error_user"] = $errors; 
            // Redirect back to the form page
            header("Location: ../Website/menu.php"); 
            exit();
        }

        // Update delivery address and phone number
        update_user_address_phone($pdo, $email, $address, $phone);

        // Redirect user after successful update
        header("Location: ../Website/menu.php"); 
        exit();
    } catch (PDOException $e) {
       // Handle database errors
       $errorMessage = "Query failed: " . $e->getMessage();
       $errors[] = $errorMessage;
       $_SESSION["error_user"] = $errors;
       // Redirect back to the form page
       header("Location: ../Website/menu.php");
       exit();
    }
}


?>
