<?php
require_once('../connection.php');
include('../class/category.php');
include('../class/vegetable.php');

if (isset($_POST['name'])) {
    $vege = new Vegetable($conn);

    $vege->name  = $_POST['name'];
    $vege->unit  = $_POST['unit'];
    $vege->amount  = $_POST['amount'];
    $vege->image = "images/" . $_FILES['images']['name']; // lấy ra tên file
    $vege->price  = $_POST['price'];
    $vege->cateid  = $_POST['cateid'];

    $target_file = "../images/" . basename($_FILES["images"]["name"]);  // dán link file tới thư mục images
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    $check = getimagesize($_FILES["images"]["tmp_name"]);
    if ($_FILES["images"]["size"] > 2097152||$check == false) {
        header('location:./new.php?err=-1');
    
    }else if (move_uploaded_file($_FILES["images"]["tmp_name"], $target_file) && $vege->add($vege)) {        
        header('location:./new.php?err=0');
    } else {
        header('location:./new.php?err=-1');
    }
}
