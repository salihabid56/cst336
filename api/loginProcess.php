<?php
session_start(); //starts or resumes an existing session

//print_r($_POST); //for debugging purposes, display the content of the $_POST array

include '../inc/dbConnection.php';
$conn = getDatabaseConnection("finalProject");

$username = $_POST['username'];
$password = sha1($_POST['password']);

$sql = "SELECT * FROM fp_admins WHERE username = :username AND password = :password";

$namedParameters = array();
$namedParameters[':username'] = $username;
$namedParameters[':password'] = $password;

$stmt = $conn->prepare($sql);
$stmt->execute($namedParameters);
$record = $stmt->fetch(PDO::FETCH_ASSOC); //we are expecting ONLY one record, so we use fetch instead of fetchAll

// print_r($record);
 
 if (!empty($record)) {
    $_SESSION['adminName'] = $record['firstName'] . " " . $record['lastName'];
    header('location: ../src/admin.php'); //redirecting to a new file
} 
else{
 
 $sql = "SELECT * FROM fp_users WHERE username = :username AND password = :password";
 $namedParameters[':password'] = $_POST['password'];
 $stmt = $conn->prepare($sql);
 $stmt->execute($namedParameters);
 $userRecord= $stmt->fetch(PDO::FETCH_ASSOC); //we are expecting ONLY one record, so we use fetch instead of fetchAll
 // print_r($userRecord);

  if(!empty($userRecord)){
    $_SESSION['userName'] = $userRecord['username'] . " " . $userRecord['fullname'];
    $str = "location: ../src/products.php";
    header($str); //redirecting to a new file
  }
  else{
    header('location: ../src/login.php?loginError=True'); //redirecting to a new file
  }
}

?>