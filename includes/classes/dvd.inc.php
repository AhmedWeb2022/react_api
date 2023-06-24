<?php

include_once('../initialize/init.inc.php');

class Dvd extends DB implements Types
{

  // function to insert DVD type into database

  public function save($sku, $name, $type, $price, $size)
  {
    $query = "INSERT INTO product SET SKU = :sku , Name = :name , Price = :price , Type = :type , Size = :size";
    $stmt = $this->connect()->prepare($query);

    $stmt->bindParam('sku', $sku);
    $stmt->bindParam('name', $name);
    $stmt->bindParam('price', $price);
    $stmt->bindParam('type', $type);
    $stmt->bindParam('size', $size);
    if ($stmt->execute()) {
      return true;
    } else {
      echo "error";
      return false;
    }
  }

  // function to check if DVD size exist

  public function checkInput($inputs)
  {
    if ($inputs['size'] >= 1) {
      $weight = $inputs['size'];
      return $weight;
    }
  }
}