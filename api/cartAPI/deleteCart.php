<?php
    
    include '../../inc/dbConnection.php';
    $conn = getDatabaseConnection("finalProject");
    
     $arr = array();
     $arr[":product_id"] = $_GET['product_id'];
     $arr[":username"] = $_GET['username'];
     
     $sql = "DELETE FROM `fp_carts` WHERE username= :username AND product_id= :product_id";
     
    $stmt = $conn->prepare($sql);
    $stmt->execute($arr);
    
    header('location: ../../src/cart.php'); //redirecting to a new file
?>