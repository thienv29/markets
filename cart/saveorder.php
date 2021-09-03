<?php
    session_start();
    include('../connection.php');
    include('../class/vegetable.php');
    include('../class/order.php');
    $vegetable = new Vegetable();

    $cusId= $_SESSION['id'];
    $total = $_POST['total'];
    $note= $_POST['note'];
    
    $order = new Order();
    $order->cusID = $cusId;
    $order->total = $total;
    $order->note = $note;
    $order->date = date('Y-m-d H:i:s');


    $listDetails =[];
    foreach ($_SESSION['listVegeId'] as $key => $item) {
        $vegetableItem = $vegetable->getByID($conn, $item->id);

        $price = $vegetableItem['Price'];
        $amount = $item->amount;
        $id = $item->id;

        $orderDetail = new Orderdetail();
        $orderDetail->vegeID = $id;
        $orderDetail->quantity = $amount;
        $orderDetail->price = $price;

        array_push($listDetails,$orderDetail);
       
    }
    if ($order->addOrder($order,$listDetails,$conn)) {
        $_SESSION['listVegeId']=[];
        
        header('location:./index.php?billStatus=1');
    }else{
        header('location:./index.php?billStatus=0');
    }
    