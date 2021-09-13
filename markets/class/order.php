<?php
class Order
{
    public $orderid;
    public $cusID;
    public $date;
    public $total;
    public $note;
    
    public $conn;


    //METHOD
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    function getAllOrder($cusID)
    {

        $sql = "SELECT * FROM `order` WHERE CustomerID = '$cusID'";
        $old = mysqli_query($this->conn, $sql);
        $val = [];
        while ($row = mysqli_fetch_array($old)) {
            array_push($val, $row);
        }
        return $val;
    }
    function getOrderDetail($orderid)
    {

        $sql = "SELECT * FROM `orderdetail` where orderdetail.OrderID = '$orderid'";
        $old = mysqli_query($this->conn, $sql);
        $val = [];
        while ($row = mysqli_fetch_array($old)) {
            array_push($val, $row);
        }
        return $val;
    }
    function addOrder($order, $detail)
    {   
        require_once('../class/vegetable.php');
        $vegetable = new Vegetable($this->conn);

        try {
            $sqlGet = "SELECT * FROM `order`  ORDER BY OrderID DESC LIMIT 1";
            $old  = mysqli_query($this->conn, $sqlGet);
            $row = $old->fetch_assoc();

            $lastID = $row['OrderID'] + 1;

            $sqlInsertOrder = "INSERT INTO `order`(`OrderID`, `CustomerID`, `Date`, `Total`, `Note`) 
                               VALUES ('$lastID','$order->cusID','$order->date','$order->total','$order->note')";
            mysqli_query($this->conn, $sqlInsertOrder);


            foreach ($detail as $item) {
                $sqlInsertDetail = "INSERT INTO `orderdetail`(`OrderID`, `VegetableID`, `Quantity`, `Price`) 
                                     VALUES ('$lastID','$item->vegeID','$item->quantity','$item->price')";
                mysqli_query($this->conn, $sqlInsertDetail);
                $vegetable->minusAmount($item->vegeID,$item->quantity);
                
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
