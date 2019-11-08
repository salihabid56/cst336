<?php
session_start();

//checks whether user has logged in
if (!isset($_SESSION['adminName'])) {
    exit;
}
    include '../../inc/dbConnection.php';
    $conn = getDatabaseConnection("finalProject");
    
    $sql = "UPDATE fp_products SET product_name = :product_name,
    product_description = :product_description,
    product_price = :product_price,
    product_stock = :product_stock,
    cat_id = :cat_id,
    product_img = :product_img WHERE fp_products.product_id = 5 ";
    
    $arr = array();
    $arr[':product_name'] = $_GET["product_name"];
    $arr[':product_description'] = $_GET["product_description"];
    $arr[':product_price'] = $_GET['product_price'];
    $arr[':product_stock'] = $_GET["product_stock"];
    $arr[':cat_id'] = $_GET["cat_id"];
    $arr[':product_img'] = $_GET["product_img"];
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($arr);

?>