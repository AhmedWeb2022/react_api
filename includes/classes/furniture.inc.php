<?php

include_once('../initialize/init.inc.php');

class Furniture extends DB implements Types
{

  // function to insert furniture type into database

  public function save($sku, $name, $type, $price, $dimensions)
  {
    $query = "INSERT INTO product SET SKU = :sku , Name = :name , Price = :price , Type = :type , Dimensions = :dimensions";
    $stmt = $this->connect()->prepare($query);

    $stmt->bindParam('sku', $sku);
    $stmt->bindParam('name', $name);
    $stmt->bindParam('price', $price);
    $stmt->bindParam('type', $type);
    $stmt->bindParam('dimensions', $dimensions);
    if ($stmt->execute()) {
      return true;
    } else {
      echo "error";
      return false;
    }
  }

  // function to check if furniture dimensions exist

  public function checkInput($inputs)
  {
    if ($inputs['height'] >= 1 && $inputs['width'] >= 1 && $inputs['length'] >= 1) {
      $dimensions = $inputs['height'] . 'x' . $inputs['width'] . 'x' . $inputs['length'];
      return $dimensions;
    }
  }
}
