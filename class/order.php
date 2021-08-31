<?php
class Order
{
    public $orderid;
    public $cusID;
    public $date;
    public $total;
    public $note;

    function getAllOrder($cusID, $conn)
    {
        include("../connection.php");
        $sql = "SELECT * FROM order WHERE CustomerID = $cusID";
        $old = mysqli_query($conn, $sql);
        $val = [];
        while ($row = mysqli_fetch_array($old)) {
            array_push($val, $row);
        }
        return $val;
    }
    function getOrderDetail($orderid, $conn)
    {

        $sql = "SELECT order.OrderID,order.CustomerID,order.Date,order.Total,order.Note,orderdetail.VegetableID,orderdetail.Quantity,orderdetail.Price 
            FROM orderdetail,`order` 
            WHERE orderdetail.OrderID = order.OrderID 
            AND order.OrderID = $orderid";
        $old = mysqli_query($conn, $sql);
        $val = [];
        while ($row = mysqli_fetch_array($old)) {
            array_push($val, $row);
        }
        return $val;
    }
    function addOrder($order, $detail, $conn)
    {
        try {
            $sqlGet = "SELECT * FROM `order`  ORDER BY OrderID DESC LIMIT 1";
            $old  = mysqli_query($conn, $sqlGet);
            $row = $old->fetch_assoc();
            $lastID = $row['OrderID'] + 1;

            $sqlInsertOrder = "INSERT INTO `order`(`OrderID`, `CustomerID`, `Date`, `Total`, `Note`) 
                               VALUES ('$lastID','$order->cusID','$order->date','$order->total','$order->note')";
            mysqli_query($conn, $sqlInsertOrder);


            foreach ($detail as $item) {
                $sqlInsertDetail = "INSERT INTO `orderdetail`(`OrderID`, `VegetableID`, `Quantity`, `Price`) 
                                     VALUES ('$lastID','$item->vegeID','$item->quantity','$item->price')";
                mysqli_query($conn, $sqlInsertDetail);
            }
            return true;
        } catch (Error) {
            return false;
        }
    }
}
class Orderdetail
{
    public $orderid;
    public $vegeID;
    public $quantity;
    public $price;
    
}
