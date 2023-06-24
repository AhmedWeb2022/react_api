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

// implode the array of id into string

$extracted_data = implode(",", $data->id);

// delete the ids from database

$product->deleteProduct($extracted_data);
