<?php

declare(stricttypes=1); 

function get_email(object $pdo, string $email){ 
    $query = "SELECT email FROM customer WHERE email = :email;"; 
    $stmt = $pdo -> prepare($query); 
    $stmt-> bindParam(":email", $email); 
    $stmt->execute(); 

    $result = $stmt -> fetch(PDO::FETCH_ASSOC); 
    return $result;
}

function set_user(object $pdo, string $email, string $pwd, string $username){ 
    //made new change here
    $query = "INSERT INTO customer(email, passkey, customer_ID,assigned_Cart_ID) VALUES (:email, :pwd, :customer_ID, :cart_ID);
    INSERT INTO customer_name(customer_ID, name) VALUES(:customer_ID, :username); "; 
    $stmt = $pdo -> prepare($query); 

    //somekind of security thingy 
    $options = [
        'cost' => 12 
    ]; 
    //hashing the password of using the bcrpt, slow down the brute forcing hacker 
    $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT, $options); 

    $stmt -> bindParam(":username", $username); 
    $stmt-> bindParam(":email", $email); 
    $stmt-> bindParam(":pwd", $hashedPwd);
    $stmt-> bindParam(":customer_ID", generateCustomerId());
    $stmt-> bindParam(":cart_ID", generateCartId());
    $stmt->execute(); 

}

function generateCustomerId() {
    // Generate a unique ID based on timestamp and random number
    $customerId = 'CUSTOMER' . uniqid() . '' . mt_rand(1000, 9999);
    return $customerId;
}

function generateCartId(){ 
    $cartId = 'CART' . uniqid() . '_' . mt_rand(1000, 9999);
    return $cartId;

}