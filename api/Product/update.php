<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../model/Product.php';

  $database = new Database();
  $db = $database->connect();

  $product = new Product($db);
  $data = json_decode(file_get_contents("php://input"));

  $product->product_id = $data->product_id;
  $product->name = $data->name;
  $product->price = $data->price;

  if($product->update()) {
    echo json_encode(
      array('message' => 'Product Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Product Not Updated')
    );
  }