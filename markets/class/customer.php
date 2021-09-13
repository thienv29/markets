<?php
class Customer {
  // Properties
  public $cusid;
  public $pass;
  public $fullname;
  public $address;
  public $city;
  public $conn;
  public function __construct($conn) {
      $this->conn = $conn;
  }
  // Methods
  function getByID($cusid){
      $sql = "SELECT * FROM `customers` WHERE CustomerID =$cusid";
      $old = mysqli_query($this->conn,$sql);
      if ($old==false) {
        return null;
      }
      $row = $old->fetch_assoc();
      return $row;
  }
  function add($cus){
      $sql = "INSERT INTO `customers`( `Password`, `Fullname`, `Address`, `City`)
        VALUES ('$cus->pass','$cus->fullname','$cus->address','$cus->city')";
        $old = mysqli_query($this->conn,$sql);
        $sqlGet = "SELECT * FROM `customers` ORDER BY CustomerID DESC LIMIT 1;";
        $old2  = mysqli_query($this->conn, $sqlGet);
        $row = $old2->fetch_assoc();
        return $row['CustomerID'];
        
  }
}
?>