<?php

    include '../../inc/dbConnection.php';
    $conn = getDatabaseConnection("finalProject");
    
    $namedParam = array();
    $namedParam[':product_id'] = $_GET['product_id'];
    
    $sql = "SELECT * FROM `fp_products` WHERE product_id = :product_id";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($namedParam);
    $productStock = $stmt->fetch(PDO::FETCH_ASSOC);

    $qty = $productStock['product_stock'];
    $updateQty = $_GET['quantity'];
    $qtyCheck = $qty - $updateQty;

    if($qtyCheck < 0){
        echo "Sorry not enough stock.";
    }
    else if($qtyCheck >= 0){
        
        $arr = array();
        $arr[":product_id"] = $_GET['product_id'];
        $arr[":username"] = $_GET['username'];
        $arr[":quantity"] = $_GET['quantity'];
        
        $sql = "UPDATE `fp_carts` SET `quantity`= :quantity WHERE username = :username AND product_id= :product_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute($arr);
        
        header('location: ../../src/cart.php'); //redirecting to a new file
    }

    
    // $sql = "UPDATE `fp_carts` SET `quantity`= :quantity WHERE username = :username AND product_id= :product_id";
    // $stmt = $conn->prepare($sql);
    // $stmt->execute($arr);
    
    // $productStock = $stmt->fetch(PDO::FETCH_ASSOC);
    // $prodStockQuantity = intval($productStock["product_stock"]);

    //echo json_encode($productStock);
    
//     $arr[":quantity"] = $_GET['quantity'];
//     $arr[":username"] = $_GET['username'];
    
//   if ($_GET['quantity'] <= $prodStockQuantity){
       
//     //print_r($_GET['quantity'] <= $prodStockQuantity);    
//     $sql = "UPDATE fp_carts
//     SET quantity = :quantity
//     WHERE product_id = :productId AND username = :username"; 

//     $stmt = $conn->prepare($sql);
//     $stmt->execute($arr);    
    
//     echo "Available";
//     }
    
//     else{
        
//          echo "Not available";
//     }
?>