<?php
$json_data = file_get_contents("php://input"); 
$data = json_decode($json_data, true); 
$cart_id = $data["cart_Id"];
// Include your database connection file if not already included
require_once '../../include/dbh.inc.php';
// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the cart_ID parameter is set
    if (isset($_POST['cart_ID'])) {
        // Sanitize the cart ID to prevent SQL injection
        //$cart_ID = htmlspecialchars($_POST['cart_ID']);
        $currentDateTime = date("Y-m-d_H:i:s");

        // Fetch checkout ID based on cart ID
        $checkoutQuery = "SELECT check_out_id FROM checkout WHERE cart_ID = :CartID";
        $checkoutStmt = $pdo->prepare($checkoutQuery);
        $checkoutStmt->bindParam(':CartID', $cart_ID);
        $checkoutStmt->execute();

        // Fetch the Checkout ID
        $checkoutIDs = $checkoutStmt->fetchAll(PDO::FETCH_COLUMN);

        foreach ($checkoutIDs as $checkoutID) {
            // Fetch cart records
            $cartQuery = "SELECT food_id, food_quantity FROM cart WHERE cart_id = :CartID";
            $cartStmt = $pdo->prepare($cartQuery);
            $cartStmt->bindParam(':CartID', $cart_ID);
            $cartStmt->execute();

            $cartRecords = $cartStmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($cartRecords as $cartRecord) {
                // Extract data from the Cart record
                $foodID = $cartRecord['food_id'];
                $quantity = $cartRecord['food_quantity'];

                // Insert the record into the History table
                $insertQuery = "INSERT INTO history (food_id, quantity, dateColumn, checkOutId) VALUES (:foodID, :quantity, :currentDateTime, :checkoutID)";
                $insertStmt = $pdo->prepare($insertQuery);
                $insertStmt->bindParam(':foodID', $foodID);
                $insertStmt->bindParam(':quantity', $quantity);
                $insertStmt->bindParam(':currentDateTime', $currentDateTime);
                $insertStmt->bindParam(':checkoutID', $checkoutID);
                $insertStmt->execute();
            }
        }

        // Output success message
        echo "Records inserted into History table successfully.";
    } else {
        // Cart ID is not set
        echo "Cart ID is not set.";
    }
} else {
    // Invalid request method
    echo "Invalid request method.";
}
?>
