<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../model/Product.php';

  $database = new Database();
  $db = $database->connect();

  $product = new Product($db);
  $product->product_id = isset($_GET['product_id']) ? $_GET['product_id'] : die();
  $result = $product->search();
  $num = $result->rowCount();

  if($num > 0) {
    $product_arr = array();
    $product_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $product_item = array(
        'product_id' => $product_id,
        'name' => $name,
        'price' => $price
      );

      array_push($product_arr['data'], $product_item);
    }
    echo json_encode($product_arr);

  } else {
    echo json_encode(
      array('message' => 'No Products Found')
    );
  }