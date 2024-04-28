<?php

//connect to the database
include("../../include/dbh.inc.php");

$food_id = htmlspecialchars($_POST['food_id']);
$quantity = htmlspecialchars($_POST['quantity']);
$cart_id = htmlspecialchars($_POST['cart_ID']);

// Check if the values are valid
if (isset($food_id) && isset($quantity) && isset($cart_id)) {
    // Update the quantity in the database
    $query = "UPDATE cart SET food_quantity = :quantity WHERE food_id = :food_id AND cart_id = :cart_id";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':quantity', $quantity, PDO::PARAM_INT);
    $statement->bindParam(':food_id', $food_id);
    $statement->bindParam(':cart_id', $cart_id);
    $statement->execute();

    // Check if the update was successful
    if ($statement->rowCount() > 0) {
        // Send a success response
        echo "Quantity updated successfully!";
    } else {
        // Send an error response if the update failed
        echo "Failed to update quantity!";
    }
} else {
    // Send an error response if the data is invalid
    echo "Invalid data received!";
}
