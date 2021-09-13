<?php
require_once('../connection.php');
include('../class/category.php');


if (isset($_POST['name'])) {
    $cate = new Category($conn);
    $cate->name  = $_POST['name'];
    $cate->description  = $_POST['description'];
    if ($cate->add($cate)) {
        header('location:./index.php?addStatus=1');
    }else{
        header('location:./index.php?addStatus=-1');

    }
}
?>