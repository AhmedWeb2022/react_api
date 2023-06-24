<?php

include_once('../initialize/init.inc.php');

class Book extends DB implements Types
{
  // insert the book type into database

  public function save($sku, $name, $type, $price, $weight)
  {
    $query = "INSERT INTO product SET SKU = :sku , Name = :name , Price = :price , Type = :type , Weight = :weight";
    $stmt = $this->connect()->prepare($query);

    $stmt->bindParam('sku', $sku);
    $stmt->bindParam('name', $name);
    $stmt->bindParam('price', $price);
    $stmt->bindParam('type', $type);
    $stmt->bindParam('weight', $weight);
    if ($stmt->execute()) {
      return true;
    } else {
      echo "error";
      return false;
    }
  }

  // function to check if book weight exist

  public function checkInput($inputs)
  {
    if ($inputs['weight'] >= 1) {
      $weight = $inputs['weight'];
      return $weight;
    }
  }
}
