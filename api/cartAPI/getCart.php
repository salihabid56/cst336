<?php

    include '../../inc/dbConnection.php';
    $conn = getDatabaseConnection("finalProject");
    $arr = array();
    $arr[':username'] = $_GET['username'];
    
    $sql = "SELECT * FROM fp_carts WHERE username=:username";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($arr);
    $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($cartItems);

?>