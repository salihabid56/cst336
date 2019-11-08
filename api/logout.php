<?php

session_start();

session_destroy();

header('location: ../src/index.php'); //taking user back to login screen

?>