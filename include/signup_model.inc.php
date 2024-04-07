<?php

declare(strict_types=1); 

function get_email(object $pdo, string $email){ 
    $query = "SELECT email FROM customer WHERE email = :email;"; 
    $stmt = $pdo -> prepare($query); 
    $stmt-> bindParam(":email", $email); 
    $stmt->execute(); 

    $result = $stmt -> fetch(PDO::FETCH_ASSOC); 
    return $result;
}

function set_user(object $pdo, string $email, string $pwd, string $username){ 
    $query = "INSERT INTO customer(email, passkey) VALUES (:email, :pwd);
    INSERT INTO customer_name(email, name) VALUES(:email, :username); "; 
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
    $stmt->execute(); 

}