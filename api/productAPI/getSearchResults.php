<?php
include '../../inc/dbConnection.php';
$conn = getDatabaseConnection("finalProject");
$product = $_GET['product'];
$category = $_GET['category'];

$namedParameters = array();


$sql = "SELECT * FROM `fp_products` WHERE 1"; //Retrieves ALL records

if (!empty($product)) { //user entered a product keyword
    $sql .=  " AND productName LIKE :product";
    $namedParameters[":product"] = "%$product%";
}
if (!empty($category)) { //user entered a category
    $sql .=  " AND cat_id = :category";
    $namedParameters[":category"] = $category;
}

$stmt = $conn -> prepare($sql);  //$connection MUST be previously initialized
$stmt->execute($namedParameters);
$records = $stmt->fetchAll(PDO::FETCH_ASSOC); //use fetch for one record, fetchAll for multiple
//print_r($records); //debugging    
echo json_encode($records);
?>