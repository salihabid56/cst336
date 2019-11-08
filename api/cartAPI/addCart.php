<?php

    include '../../inc/dbConnection.php';
    $conn = getDatabaseConnection("finalProject");
    
    $namedParam = array();
    $namedParam[":product_id"] = $_POST['product_id'];
    $namedParam[":username"] = $_POST['username'];  
    
    $sql ="SELECT * FROM `fp_carts` WHERE username=:username AND product_id=:product_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute($namedParam);
    $cartItem = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!empty($cartItem)){
        $namedParam = array();
        $namedParam[":product_id"] = $_POST['product_id'];
        $namedParam[":username"] = $_POST['username'];  
        $namedParam[":quantity"] = $_POST['quantity'];

        $sql = "UPDATE `fp_carts` SET quantity=:quantity WHERE username=:username AND product_id=:product_id";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute($namedParam);
    }else{
        $arr = array();
        $arr[":product_id"] = $_POST['product_id'];
        $arr[":quantity"] = $_POST['quantity'];
        $arr[":unit_price"] = $_POST['unit_price'];
        $arr[":username"] = $_POST['username'];  
        
        $sql = "INSERT INTO `fp_carts` (`cart_item_id`, `product_id`, `quantity`, `unitPrice`, `username`) 
            VALUES (NULL, :product_id, :quantity, :unit_price, :username)";
               
        $stmt = $conn->prepare($sql);
        $stmt->execute($arr);
    }    
   
?>