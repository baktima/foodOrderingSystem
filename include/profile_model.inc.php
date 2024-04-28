<?php

function get_user_by_email(object $pdo, string $email){ 
    $query = "SELECT * FROM customer WHERE email = :email"; 
    $stmt = $pdo->prepare($query); 
    $stmt->bindParam(":email", $email); 
    $stmt->execute(); 

    return $stmt->fetch(PDO::FETCH_ASSOC); 
}

function update_user(object $pdo, string $oldEmail, string $newUsername, string $newEmail, string $newPassword){ 
    // Prepare the SQL query to update both customer_name and customer tables
    $query = "UPDATE customer_name AS cn
              INNER JOIN customer AS c ON cn.customer_ID = c.customer_ID
              SET cn.name = :newUsername,
                  c.email = :newEmail,
                  c.passkey = :password 
              WHERE c.email = :oldEmail";
    
    // Prepare the statement
    $stmt = $pdo->prepare($query); 

    // Hash the new password
    $options = ['cost' => 12]; 
    $hashedPwd = password_hash($newPassword, PASSWORD_BCRYPT, $options); 

    // Bind parameters
    $stmt->bindParam(":newUsername", $newUsername); 
    $stmt->bindParam(":newEmail", $newEmail); 
    $stmt->bindParam(":password", $hashedPwd); 
    $stmt->bindParam(":oldEmail", $oldEmail); 

    // Execute the query
    return $stmt->execute(); 
}

