<?php
// Assuming you have a database connection established
include("../../include/dbh.inc.php");
// Prepare and execute a query using the email
$email = isset($_GET['email']) ? $_GET['email'] : null;
if ($email) {
    $query = "SELECT * FROM customer WHERE email = :email";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':email', $email);
    $statement->execute();

    // Fetch the result (assuming only one row will be returned)
    $cartData = $statement->fetch(PDO::FETCH_ASSOC);
    $valueCartData = $cartData['assigned_Cart_ID'];

    // Return the retrieved data (you might want to handle errors if no data is found)
    if ($cartData) {
        echo json_encode($valueCartData);
    } else {
        echo "No data found for email: $email";
    }
} else {
    echo "Email parameter is missing in the GET request.";
}


