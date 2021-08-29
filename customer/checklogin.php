<?php
    require_once('../connection.php');
    session_start();
    $invalidPass = '';
    if (isset($_SESSION['fullname'])) {
        header('location:../index.php');
    }
    if (isset($_POST['yourId'])) {
        $id = $_POST['yourId'];
        $pass = $_POST['password'];
        $sql = "SELECT * FROM `customers` WHERE CustomerID='$id' and Password = '$pass'";
        $old = mysqli_query($conn,$sql);
        if (mysqli_num_rows($old)>0) {
            $row = $old->fetch_assoc();
            $_SESSION['fullname'] = $row['Fullname'];
            $_SESSION['id'] = $row['CustomerID'];
            $_SESSION['address'] = $row['Address'];
            $_SESSION['city'] = $row['City'];
            
            header('location:../vegetable/index.php');
        }else{
            $invalidPass = 'Không tìm thấy tài khoản';
        }
    }
?>