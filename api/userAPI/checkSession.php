<?php
session_start();
if ($_SESSION['userName'] != '' && $_SESSION['adminName'] == '') {
    echo json_encode($_SESSION['userName']);
}
else{
    echo json_encode("login");
}
?>