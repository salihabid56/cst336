<?php

    include '../../inc/dbConnection.php';
    $conn = getDatabaseConnection("finalProject");

     $np = array();
    $np[':email'] = $_GET['email'];
  
    
    $sql = "SELECT * from fp_users where email = :email";
    
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($np);
    $records = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($records);  
?>