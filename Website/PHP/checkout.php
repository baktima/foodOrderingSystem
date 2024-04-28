<?php

$json_data = file_get_contents("php://input"); 
$data = json_decode($json_data, true); 
$total_price = $data["total_price"]; 
$cart_id = $data["cart_Id"];

error_log('Debug message here');
error_log('hello brus');
// Include your database connection file if not already included
include '../../include/dbh.inc.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the cart_ID and food_id parameters are set
    if (isset($cart_id, $total_price)) {
        try {
            // Sanitize the inputs to prevent SQL injection (not necessary for prepared statements)
            // $cart_ID = htmlspecialchars($cart_id);
            // $total_price = htmlspecialchars($total_price);

            $currentDateTime = date("Y-m-d_H:i:s");
            $check_out_id = $cart_id . '_' . $currentDateTime;
            $payment_id = 1;

            error_log('Debug message here');
error_log(print_r($payment_id, true));

            $query = "INSERT INTO checkout (check_out_id, cart_ID, total_price, payment_id) VALUES (:check_out_id, :cart_ID, :total_price, :payment_id)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':check_out_id', $check_out_id);
            $stmt->bindParam(':cart_ID', $cart_id);
            $stmt->bindParam(':total_price', $total_price);
            $stmt->bindParam(':payment_id', $payment_id);

            if ($stmt->execute()) {
                // Item inserted successfully
                echo "Checkout Updated";
            } else {
                // Error occurred while inserting item
                echo "Error occurred while updating checkout";
            }
        } catch (PDOException $e) {
            // Handle database errors
            echo "Database error: " . $e->getMessage();
        }
    } else {
        // Invalid or missing parameters
        echo "Invalid or missing parameters";
    }
} else {
    // Invalid request method
    echo "Invalid request method";
}
