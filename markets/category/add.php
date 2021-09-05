<?php
require_once('../connection.php');
include('../class/category.php');
session_start();

if (isset($_POST['name'])) {
    $cate = new Category($conn);
    $cate->name  = $_POST['name'];
    $cate->description  = $_POST['description'];
    $cate->add($cate);
    header('location:./index.php');
}
?>