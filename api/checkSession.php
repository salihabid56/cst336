<?php
session_start();
if($_SESSION['adminName'] != '' && $_SESSION['userName'] == ''){
    echo json_encode("admin");
}
else if ($_SESSION['userName'] != '' && $_SESSION['adminName'] == '') {
    echo json_encode("user");
}
else{
    echo json_encode("login");
}
?>