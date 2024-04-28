<?php

// Include your database connection file if not already included
require_once '../../include/dbh.inc.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the cart_ID and food_id parameters are set
        // Sanitize the inputs to prevent SQL injection
        $cart_ID = htmlspecialchars($_POST['cart_ID']);
        $total_price = htmlspecialchars($_POST['total_price']);
        $currentDateTime = date("Y-m-d_H:i:s");
        $check_out_id = $cart_ID . '_' . $currentDateTime;
        $payment_id = 1;

        $query = "INSERT INTO checkout (check_out_id, cart_ID, total_price, payment_id) VALUES (:check_out_id, :cart_ID, :total_price, :payment_id)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':check_out_id', $check_out_id);
        $stmt->bindParam(':cart_ID', $cart_ID);
        $stmt->bindParam(':total_price', $total_price);
        $stmt->bindParam(':payment_id', $payment_id);

        if ($stmt->execute()) {
            // Item deleted successfully
            echo "Checkout Updated";
        } else {
            // Error occurred while deleting item
            echo "Error occurred while updating checkout";
        }
} else {
    // Invalid request method
    echo "Invalid request method";
}
