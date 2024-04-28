<?php

include("../../include/dbh.inc.php"); 

$email = isset($_GET['email']) ? $_GET['email'] : null;

if ($email) {
    try {
        $query = "SELECT cart.*, food.name AS food_name, food.price AS food_price 
                  FROM cart 
                  JOIN food ON cart.food_id = food.food_id 
                  JOIN customer ON cart.cart_id = customer.assigned_Cart_ID 
                  WHERE customer.email = :email";
        $statement = $pdo->prepare($query);
        $statement->bindParam(':email', $email);
        $statement->execute();
        $cart_items = $statement->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage();
    }
}

// Output the cart items as JSON
header('Content-Type: application/json');
echo json_encode($cart_items);
