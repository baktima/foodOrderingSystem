<?php


$json_data = file_get_contents("php://input");
$data = json_decode($json_data, true);
$food_id = $data["food_Id"];
$cart_id = $data["cart_Id"];


include("../../include/dbh.inc.php");

// if (isset($_POST["food_Id"]) && isset($_POST["cart_Id"])) {
    // Use $_POST to access the sent data
    $query = "INSERT INTO cart (cart_id, food_id, food_quantity) VALUES (:cart_id, :food_id, 1)"; 
    $stmt = $pdo->prepare($query); 
    $stmt->bindParam(":food_id", $food_id); 
    $stmt->bindParam(":cart_id", $cart_id);
    // $stmt->execute(); 
// }
// else{
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
