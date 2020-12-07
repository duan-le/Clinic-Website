<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../model/Product.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog category object
  $product = new Product($db);

  // Get ID
  $product->product_id = isset($_GET['product_id']) ? $_GET['product_id'] : die();

  // Get post
  $product->search();

  // Create array
  $product_arr = array(
    'product_id' => $product->product_id,
    'name' => $product->name,
    'price' => $product->price,
  );

  // Make JSON
  print_r(json_encode($product_arr));