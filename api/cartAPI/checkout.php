<?php

    include '../../inc/dbConnection.php';
    $conn = getDatabaseConnection("finalProject");
    
    $arr = $_GET['products'];
    
    foreach ($arr as $product) {
        // print_r($product);
        $namedParameters = array();
        $namedParameters[':product_id'] = $product[0];
        $sql= "SELECT product_stock FROM fp_products WHERE product_id = :product_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute($namedParameters);
        $productStock = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $updateQty = $productStock['product_stock'];
        $qtyCheck = $updateQty - $product[1];
        print_r($qtyCheck);
        if($qtyCheck < 0){
            echo "Sorry not enough stock.";
        }
        else if($qtyCheck >= 0){
            $arr = array();
            $arr[":product_id"] = $product[0];
            $arr[":quantity"] = $qtyCheck;
            
            $sql = "UPDATE `fp_products` SET `product_stock`= :quantity WHERE product_id= :product_id";
            $stmt = $conn->prepare($sql);
            $stmt->execute($arr);
            
            $arr = array();
            $arr[":product_id"] = $product[0];
            $arr[":username"] = $_GET['username'];
            $sql = "DELETE FROM `fp_carts` WHERE product_id = :product_id AND username = :username";
            $stmt = $conn->prepare($sql);
            $stmt->execute($arr);
            header('refresh:1; ../src/cart.php'); //redirecting to a new file
        }
    }
    

    
    // $productStock = $stmt->fetch(PDO::FETCH_ASSOC);
    // $prodStockQuantity = intval($productStock["product_stock"]);
    // $newProductStock = $prodStockQuantity - $_GET['quantity'];
    // $arr[":quantity"] = $newProductStock;
    
    // $sql = "UPDATE fp_products
    // SET product_stock = :quantity
    // WHERE product_id = :product_id"; 
    
    // $stmt = $conn->prepare($sql);
    // $stmt->execute($arr);
    
    // $arr = array();
    // $arr[":product_id"]= $_GET['product_id'];    
    // $arr[":username"] = $_GET['username'];
    
    // $sql = "DELETE FROM `fp_carts` WHERE username = :username and product_id = :product_id";
    // $stmt = $conn->prepare($sql);
    // $stmt->execute($arr); 
        

?>