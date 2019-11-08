<?php
    include '../inc/dbConnection.php';
    $conn = getDatabaseConnection("finalProject");
    $namedParameter = array();
    
    $namedParameter[":user"] = $_GET['user'];
    // print_r($namedParameter);
    $sql = "SELECT `username' FROM 'fp_purchaseHhistory'WHERE username = :username";
            
    $stmt = $conn -> prepare($sql);  //$connection MUST be previously initialized
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!empty($record)) {
    
    echo json_encode($records);
} 
else{
 
    header('location: ../src/user.php?UserInfo=NotFound'); //redirecting to a new file

}
?>