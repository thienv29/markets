<?php
class Vegetable
{
    public $vegetableId;
    public $cateid;
    public $name;
    public $unit;
    public $amount;
    public $images;
    public $price;
    public $conn;


    //METHOD
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    function getAll()
    {
        $sql = "SELECT * FROM vegetable";
        $old = mysqli_query($this->conn, $sql);
        $val = [];
        while ($row = mysqli_fetch_array($old)) {
            array_push($val, $row);
        }
        return $val;
    }
    function getListByCateID($cateid)
    {
        $sql = "SELECT * FROM vegetable WHERE CategoryID = $cateid";
        $old = mysqli_query($this->conn, $sql);
        $val = [];
        while ($row = mysqli_fetch_array($old)) {
            array_push($val, $row);
        }
        return $val;
    }
    function getListByCateIDs($cateids)
    {
        $sql = "SELECT * FROM vegetable WHERE CategoryID in ($cateids)";
        $old = mysqli_query($this->conn, $sql);
        $val = [];
        while ($row = mysqli_fetch_array($old)) {
            array_push($val, $row);
        }
        return $val;
    }
    function getByID($vegetableID)
    {
        $sql = "SELECT * FROM vegetable WHERE VegetableID = $vegetableID";
        $old = mysqli_query($this->conn, $sql);
        $row = $old->fetch_assoc();
        return $row;
    }
    function minusAmount($vegetableID, $amount)
    {
        $sql = "UPDATE `vegetable` SET `Amount`=(SELECT amount from vegetable where vegetable.VegetableID = $vegetableID)-$amount 
        WHERE vegetable.VegetableID = $vegetableID";
        $old = mysqli_query($this->conn, $sql);
    }
}
