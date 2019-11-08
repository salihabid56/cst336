<?php

    include '../../inc/dbConnection.php';
    $conn = getDatabaseConnection("finalProject");

     $np = array();
    $np[':username'] = $_GET['username'];
  
    
    $sql = "SELECT * from fp_users where username = :username";
    
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($np);
    $records = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($records);  
?>