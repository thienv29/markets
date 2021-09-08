<?php
class Category
{
  public $caid;
  public $description;
  public $name;

  public $conn;

  //METHOD
  public function __construct($conn)
  {
    $this->conn = $conn;
  }

  function getAll()
  {
    try {
      $sql = "SELECT * FROM category";
      $old = mysqli_query($this->conn, $sql);
      $val = [];
      while ($row = mysqli_fetch_array($old)) {
        array_push($val, $row);
      }
      return $val;
    } catch (Error $er) {
      return false;
    }
  }

  function add($cate)
  {
    try {
      $sql = "INSERT INTO `category` (  `Name`, `Description`)
              VALUES ('$cate->name','$cate->description')";
      $old = mysqli_query($this->conn, $sql);
      return true;
    } catch (Error $er) {
      return false;
    }
  }
}
