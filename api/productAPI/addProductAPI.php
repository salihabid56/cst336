<?php

    include '../../inc/dbConnection.php';
    $conn = getDatabaseConnection("finalProject");
    
    $arr = array();
    $arr[":product_name"] = $_GET["product_name"];
    $arr[":product_description"] = $_GET["product_description"];
    $arr[":product_price"] = $_GET["product_price"];
    $arr[":product_stock"] = $_GET["product_stock"];
    $arr[":cat_id"] = $_GET["cat_id"];
    $arr[":product_img"] = $_GET["product_img"];

    // $sql = "INSERT INTO `fp_products` (NULL, `product_name`, `product_description`, `product_price`, `product_stock`, `cat_id`, `product_img`) 
    //       VALUES (NULL, :product_name, :product_description, :product_price, :product_stock, :cat_id, :product_img)";
   
    $sql = "INSERT INTO `fp_products` (`product_id`, `product_name`, `product_description`, `product_price`, `product_stock`, `cat_id`, `product_img`) 
    VALUES (NULL, :product_name, :product_description, :product_price, :product_stock, :cat_id, :product_img)";
    // print_r($arr);
    $stmt = $conn->prepare($sql);
    $stmt->execute($arr);
    
    header("Location: ../../src/admin.php");
    ?>