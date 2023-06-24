<?php

// define the headers to this api

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// include the initialize class

include_once('../initialize/init.inc.php');

// instantiate product class

$product = new Product();

// select all products from database

$result = $product->showProduct();

// store the number of products 

$count = $result->rowCount();

// check if there are products

if ($count > 0) {
  $product_arr = [];

// loop and stor the products into array ($product_arr)

  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    $product_item = array(
      "id" => $id,
      "SKU" => $SKU,
      "Name" => $Name,
      "Price" => $Price,
      "Type" => $Type,
      "Size" => $Size,
      "Weight" => $Weight,
      "Dimensions" => $Dimensions
    );
    array_push($product_arr, $product_item);
  }
  // return the array of products

  echo json_encode($product_arr);
} else {

  // if there is no data in database send no data
  
  echo json_encode("no product found");
}
