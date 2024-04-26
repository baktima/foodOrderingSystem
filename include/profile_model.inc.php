<?php

function get_user_by_email(object $pdo, string $email){ 
    $query = "SELECT * FROM customer WHERE email = :email"; 
    $stmt = $pdo->prepare($query); 
    $stmt->bindParam(":email", $email); 
    $stmt->execute(); 

    return $stmt->fetch(PDO::FETCH_ASSOC); 
}

function update_user(object $pdo, string $email, string $newUsername, string $newEmail, string $newPassword){ 
    $query = "UPDATE customer SET name = :username, email = :email, passkey = :password WHERE email = :email"; 
    $stmt = $pdo->prepare($query); 

    // Hash the new password
    $options = ['cost' => 12]; 
    $hashedPwd = password_hash($newPassword, PASSWORD_BCRYPT, $options); 

    $stmt->bindParam(":username", $newUsername); 
    $stmt->bindParam(":email", $newEmail); 
    $stmt->bindParam(":password", $hashedPwd); 

    return $stmt->execute(); 
}
