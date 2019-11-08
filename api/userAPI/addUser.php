<?php
    include '../inc/dbConnection.php';
    $conn = getDatabaseConnection("finalProject");
    $namedParameter = array();
    
    $namedParameter[":user"] = $_GET['user'];
    $namedParameter[":pass"] = $_GET['pass'];
    $namedParameter[":name"] = sha1($_GET['name']);
    $namedParameter[":email"] = $_GET['email'];
    // print_r($namedParameter);
    $sql = "INSERT INTO `fp_users` (`username`, `password`, `fullname`, `email`) 
            VALUES (:user, :pass, :name, :email)";
    $stmt = $conn -> prepare($sql);  //$connection MUST be previously initialized
    try{
        $stmt->execute($namedParameter);
        echo "User successfully created!";
    }
    catch(Exception $e){
        echo "User already exists!";
    }
    // $records = $stmt->fetch(PDO::FETCH_ASSOC); //use fetch for one record, fetchAll for multiple
    
    //print_r($records); //displays array content
    
    // echo json_encode($records);
?>