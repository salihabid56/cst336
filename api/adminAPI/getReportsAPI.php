<?php
    include '../../inc/dbConnection.php';
    $conn = getDatabaseConnection("finalProject");
    
    $reportType = $_GET['report_type'];
    
    if($reportType =='1'){ // number of products
        $sql = "SELECT count(*) FROM `fp_products`";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($product);
    }
    else if($reportType == '2'){ // avg price of products
        $sql = "SELECT avg(product_price) FROM `fp_products` ";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($product);
    }
    else if($reportType == '3'){
        $sql = "SELECT sum(product_stock) FROM `fp_products`";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($product);
    }
    else{
        echo "something went wrong";
    }
?>