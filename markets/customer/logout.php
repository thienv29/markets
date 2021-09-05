<?php
    session_start();
    // unset($_SESSION['fullname']);
    // unset($_SESSION['id']);
    // unset($_SESSION['address']); 
    // unset($_SESSION['city']);
    session_destroy();

    header('location:../index.php');
?>