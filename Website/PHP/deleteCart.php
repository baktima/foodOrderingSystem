<?php
// Include your database connection file if not already included
require_once '../../include/dbh.inc.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the cart_ID and food_id parameters are set
        // Sanitize the inputs to prevent SQL injection
        $cart_ID = htmlspecialchars($_POST['cart_ID']);
        $food_id = htmlspecialchars($_POST['food_id']);


        // Prepare the delete query
        $query = "DELETE FROM cart WHERE cart_id = :cart_ID AND food_id = :food_id";

        // Prepare and execute the statement
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':cart_ID', $cart_ID);
        $stmt->bindParam(':food_id', $food_id);
        
        if ($stmt->execute()) {
            // Item deleted successfully
            echo "Item deleted successfully";
        } else {
            // Error occurred while deleting item
            echo "Error occurred while deleting item";
        }

} else {
    // Invalid request method
    echo "Invalid request method";
}
