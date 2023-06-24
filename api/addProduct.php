<?php


// define the headers to this api

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,X-Requested-With');

// include the initialize class

include_once('../initialize/init.inc.php');

// instantiate product class

$product = new Product();

// get the data that was sent from post method and store it in variable

$data = json_decode(file_get_contents("php://input"));


// check if the required data was sent and if so store it

if (isset($data->SKU)) {
  $product->setSKU($data->SKU);
}
if (isset($data->Name)) {
  $product->setName($data->Name);
}
if (isset($data->Price)) {
  $product->setPrice($data->Price);
}
if (isset($data->Type)) {
  $product->setType($data->Type);
}
if (isset($data->Weight)) {
  $product->setWeight($data->Weight);
}
if (isset($data->Size)) {
  $product->setSize($data->Size);
}
if (isset($data->Height)) {
  $product->setHeight($data->Height);
}
if (isset($data->Width)) {
  $product->setWidth($data->Width);
}
if (!empty($data->Length)) {
  $product->setLength($data->Length);
}

// check if the SKU exists on database

if ($product->checkSKU($data->SKU)) {

  // determine which type was sent

  $measurement = $product->checkSelectedTypeInput(new $data->Type);

  // insert the data into database and check if it inserted or not

  if ($product->insert(new $data->Type(), $measurement)) {
    // if data stored successfully send ok message
    echo json_encode(array("Product added"));
  } else {
    // if error happened sent No message
    echo json_encode(array("Product not added"));
  }
} else {
  // if the SKU exist in database send message to change it
  http_response_code(404);
  echo json_encode(array("SKU EXIST"));
}
