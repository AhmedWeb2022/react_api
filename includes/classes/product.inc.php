<?php


include_once("../initialize/init.inc.php");
class Product extends DB
{

  // set properties
  private $id;
  private $sku;
  private $name;
  private $price;
  private $type;
  private $size;
  private $height;
  private $width;
  private $length;
  private $weight;

  // make setter methods to the properties

  public function setId($id)
  {
    $this->id = $id;
  }

  public function setSKU($sku)
  {
    $this->sku = $sku;
  }
  public function setName($name)
  {
    $this->name = $name;
  }
  public function setPrice($price)
  {
    $this->price = $price;
  }
  public function setType($type)
  {
    $this->type = $type;
  }
  public function setSize($size)
  {
    $this->size = $size;
  }
  public function setHeight($height)
  {
    $this->height = $height;
  }
  public function setWidth($width)
  {
    $this->width = $width;
  }
  public function setLength($length)
  {
    $this->length = $length;
  }
  public function setWeight($weight)
  {
    $this->weight = $weight;
  }

  // function to display the data from database
  public function showProduct()
  {
    $sql = "SELECT * FROM product;";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute();
    return $stmt;
  }

  // function to delete the records from database

  public function deleteProduct($extract_id)
  {
    $query = "DELETE FROM product WHERE id IN(" . $extract_id . ")";
    $stmt = $this->connect()->prepare($query);
    if ($stmt->execute()) {
      return true;
    }
  }

// function to check if SKU exists in database

  public function checkSKU($sku)
  {
    $query = "SELECT * FROM product WHERE SKU = :sku";
    $stmt = $this->connect()->prepare($query);
    $stmt->bindParam('sku', $sku);
    $stmt->execute();
    $count = $stmt->rowCount();
    $result = null;
    if ($count > 0) {
      $result = false;
    } else {
      $result = true;
    }
    return $result;
  }

  // function to check which type of product was sent

  public function checkSelectedTypeInput(Types $type)
  {
    $input = $type->checkInput(array("weight" => $this->weight, "size" => $this->size, "height" => $this->height, "width" => $this->width, "length" => $this->length));
    return $input;
  }

  // function to insert the data into database
  
  public function insert(Types $productType, $measurement)
  {
    $product = $productType->save($this->sku, $this->name, $this->type, $this->price, $measurement);
    return $product;
  }
}
