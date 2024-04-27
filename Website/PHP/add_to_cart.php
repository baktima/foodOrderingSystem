<?php


$json_data = file_get_contents("php://input");
$data = json_decode($json_data, true);
$food_id = $data["food_Id"];
$cart_id = $data["cart_Id"];


include("../../include/dbh.inc.php");

// if (isset($_POST["food_Id"]) && isset($_POST["cart_Id"])) {
    // Use $_POST to access the sent data
    if (checking($pdo, $food_id, $cart_id)) {
        // If the item is already in the cart, increment the quantity by 1
        $query = "UPDATE cart SET food_quantity = food_quantity + 1 WHERE cart_id = :cart_id AND food_id = :food_id"; 
        $stmt = $pdo->prepare($query); 
        $stmt->bindParam(":food_id", $food_id); 
        $stmt->bindParam(":cart_id", $cart_id);
    } else {
        // If the item is not in the cart, insert it with a quantity of 1
        $query = "INSERT INTO cart (cart_id, food_id, food_quantity) VALUES (:cart_id, :food_id, 1)"; 
        $stmt = $pdo->prepare($query); 
        $stmt->bindParam(":food_id", $food_id); 
        $stmt->bindParam(":cart_id", $cart_id);
    }
    
    if ($stmt->execute()) {
        // Return a success response if the query executed successfully
        http_response_code(200);
        echo "Food item added to cart successfully!";
    } else {
        // Return an error response if there was a problem executing the query
        http_response_code(500);
        echo "Error adding food item to cart!";
    }
    
    // }
    
    function checking($pdo, $food_id, $cart_id) { 
        $queryCheck = "SELECT * FROM cart WHERE cart_id = :cart_id AND food_id = :food_id";
        $stmt1 = $pdo->prepare($queryCheck); 
        $stmt1->bindParam(":food_id", $food_id); 
        $stmt1->bindParam(":cart_id", $cart_id);
        $stmt1->execute();
        $found = $stmt1->fetch(PDO::FETCH_ASSOC); 
        return $found; 
    }