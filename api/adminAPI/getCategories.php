<?php
    include '../../inc/dbConnection.php';
    $conn = getDatabaseConnection("finalProject");
    
    $sql = "SELECT cat_id, cat_name FROM fp_category ORDER BY cat_name";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($records);
?>