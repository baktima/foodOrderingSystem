<?php
$currentDateTime = date("Y-m-d H:i:s");
// Include your database connection file if not already included
require_once '../../include/dbh.inc.php';
// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the cart_ID and food_id parameters are set
        // Sanitize the inputs to prevent SQL injection
        $cart_ID = htmlspecialchars($_POST['cart_ID']);

        $query = "SELECT * FROM cart WHERE cart_id = :CartID";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':CartID', $CartID);
        $stmt->execute();

        $cartRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($cartRecords as $cartRecord) {
            // Extract data from the Cart record
            $foodID = $cartRecord['food_id'];
            $quantity = $cartRecord['quantity'];
    
            // Insert the record into the History table
            $insertQuery = "INSERT INTO history (food_id, quantity, dateColumn) VALUES (:foodID, :quantity, NOW())";
            $insertStmt = $pdo->prepare($insertQuery);
            $insertStmt->bindParam(':foodID', $foodID);
            $insertStmt->bindParam(':quantity', $quantity);
            $insertStmt->bindParam(':currentDateTime', $currentDateTime);
            $insertStmt->execute();
            
            // Search for a record in the Checkout table with matching Cart ID
            $checkoutQuery = "SELECT check_out_id FROM checkout WHERE cart_ID = :CartID";
            $checkoutStmt = $pdo->prepare($checkoutQuery);
            $checkoutStmt->bindParam(':CartID', $CartID);
            $checkoutStmt->execute();

            // Fetch the Checkout ID
            $checkoutID = $checkoutStmt->fetchColumn();

            // If Checkout ID is found, update the corresponding record in the History table
            if ($checkoutID) {
                $updateQuery = "UPDATE history SET checkOutId = :checkoutID WHERE food_id = :foodID AND quantity = :quantity AND dateColumn = NOW()";
                $updateStmt = $pdo->prepare($updateQuery);
                $updateStmt->bindParam(':checkoutID', $checkoutID);
                $updateStmt->bindParam(':foodID', $foodID);
                $updateStmt->bindParam(':quantity', $quantity);
                $updateStmt->bindParam(':currentDateTime', $currentDateTime);
                $updateStmt->execute();
            }
        }

        // Output success message
        echo "Records inserted into History table successfully.";
    } else {
        // Cart ID is not set
        echo "Cart ID is not set.";
    }