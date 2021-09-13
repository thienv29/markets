<?php
    require_once('../connection.php');
    include('../class/customer.php');
    session_start();
    $invalidPass = '';
    if (isset($_SESSION['fullname'])) {
        header('location:../index.php');
    }else if (isset($_POST['yourId'])) {
        $id = $_POST['yourId'];
        $pass = $_POST['password'];
        $cus = new Customer($conn);
        $row = $cus->getByID($id);
        if ($row !== null ) {
           if ($row['Password']==$pass) {

            $_SESSION['fullname'] = $row['Fullname'];
            $_SESSION['id'] = $row['CustomerID'];
            $_SESSION['address'] = $row['Address'];
            $_SESSION['city'] = $row['City'];
            
            header('location:../vegetable/index.php');
           }else{
            $invalidPass = 'Nhập sai passowrd';
           }
        }else{
            $invalidPass = 'Không tìm thấy tài khoản';
        }
    }
?>