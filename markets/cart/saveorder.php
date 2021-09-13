<?php
include('../connection.php');
include('../class/vegetable.php');
include('../class/order.php');
session_start();
$vegetable = new Vegetable($conn);
if (!isset($_SESSION['fullname'])) {
    header('location:./index.php?errLogin=1');
} else {
    $cusId = $_SESSION['id'];
    $total = $_POST['total'];
    $note = $_POST['note'];

    $order = new Order($conn);
    $order->cusID = $cusId;
    $order->total = $total;
    $order->note = $note;
    $order->date = date('Y-m-d H:i:s');

    $listDetails = [];
    foreach ($_SESSION['listVegeId'] as $key => $item) {
        $vegetableItem = $vegetable->getByID($item->id);

        $price = $vegetableItem['Price'];
        $amount = $item->amount;
        $id = $item->id;

        $orderDetail = new Orderdetail();
        $orderDetail->vegeID = $id;
        $orderDetail->quantity = $amount;
        $orderDetail->price = $price;
        
        array_push($listDetails, $orderDetail);
    }
    if ($order->addOrder($order, $listDetails)) {
        $_SESSION['listVegeId'] = [];
        header('location:./index.php?billStatus=1');
    } else {
        header('location:./index.php?billStatus=0');
    }
}
