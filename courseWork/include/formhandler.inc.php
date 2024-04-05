<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $pwd = $_POST["pwd"];
    $email = $_POST["email"];

    try {
        //linking file 
        //basically the same more or less as the ppt if we copy
        //and paste the code, it wont change anything
        require_once "dbh.inc.php";

        //sql query 
        $query = "INSERT INTO customer(passkey, email) VALUES (?,?);"; 

        $stmt = $pdo->prepare($query);
        
        $stmt->execute([$pwd,$email]);
        
        
        $pdo = null; 
        $stmt = null; 

        die(); 

    } catch (PDOException $e) {
        
        die("query failed: ". $e->getMessage());
    }

}
else{
    header("Location: ../index.php");
}