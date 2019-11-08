<?php

    include '../../inc/dbConnection.php';
    $conn = getDatabaseConnection("finalProject");

    $np = array();
    $np[':email'] = $_GET['email'];//$_GET['name'] matches the ajax
    $np[':username']=$_GET['username'];
    $np[':fullname'] = $_GET['fullname']; 
    $np[':password'] = sha1($_GET['password']); 
    
    //$email = filter_var($email, FILTER_SANITIZE_EMAIL); // Sanitizing email(Remove unexpected symbol like <,>,?,#,!, etc.)
        if (!filter_var($_GET['email'], FILTER_VALIDATE_EMAIL)){
        echo "Invalid";
        }
    else{
             
        $sql = "INSERT INTO `fp_users`(`username`, `password`, `fullname`, `email`) VALUES (:username, :password, :fullname, :email)";
        $stmt = $conn->prepare($sql);
    $stmt->execute($np);
    echo "successful";
        
    }
    
    
?>