<?PHP

function update_user_address_phone(object $pdo, string $email, string $newAddress, string $newPhone) { 
    try {
        // Prepare the SQL query to update the customer table
        $query = "UPDATE customer
                  SET address = :newAddress,
                      phoneNumber = :newPhone
                  WHERE email = :email";
        
        // Prepare the statement
        $stmt = $pdo->prepare($query); 
        
        // Bind parameters
        $stmt->bindParam(":newAddress", $newAddress); 
        $stmt->bindParam(":newPhone", $newPhone); 
        $stmt->bindParam(":email", $email); 
        
        // Execute the query
        $success = $stmt->execute(); 
        
        if (!$success) {
            // Log error message
            error_log("Failed to update user address and phone: " . $stmt->errorInfo()[2]);
            return false;
        }

        return true; // Update successful
    } catch (PDOException $e) {
        // Log exception
        error_log("PDOException in update_user_address_phone: " . $e->getMessage());
        return false;
    }
}

function isPhoneNum($phoneNumber) {
    // check if phone number have 11 digit
    if (strlen($phoneNumber) !== 12) {
        return false;
    }
    // Check if the phone number consists only of digits
    foreach (str_split($phoneNumber) as $digit) {
        if (!is_numeric($digit)) {
            return false;
        }
    }
    //return true if it passes all check
    return true;
}