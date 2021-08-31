<?php
class Customer {
  // Properties
  public $cusid;
  public $pass;
  public $fullname;
  public $address;
  public $city;


  // Methods
  function getByID($cusid,$conn){
      $sql = "SELECT * FROM `customers` WHERE CustomerID ='$cusid'";
      $old = mysqli_query($conn,$sql);
      $row = $old->fetch_assoc();
      echo $row;

  }
  function add($cus,$conn){
      $sql = "INSERT INTO `customers`( `Password`, `Fullname`, `Address`, `City`)
       VALUES ('$cus->pass','$cus->fullname','$cus->address','$cus->city')";
        $old = mysqli_query($conn,$sql);
  }
}
?>