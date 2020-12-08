<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../model/Product.php';

  $database = new Database();
  $db = $database->connect();

  $product = new Product($db);
  $product->product_id = isset($_GET['product_id']) ? $_GET['product_id'] : die();
  $product->search();

  $product_arr = array(
    'product_id' => $product->product_id,
    'name' => $product->name,
    'price' => $product->price,
  );

  print_r(json_encode($product_arr));