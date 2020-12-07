<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../model/Product.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate category object
  $product = new Product($db);

  // Category read query
  $result = $product->view();

  // Get row count
  $num = $result->rowCount();

  // Check if any categories
  if($num > 0) {
        // Cat array
        $product_arr = array();
        $product_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $product_item = array(
            'product_id' => $product_id,
            'name' => $name,
            'price' => $price
          );

          // Push to "data"
          array_push($product_arr['data'], $product_item);
        }

        // Turn to JSON & output
        echo json_encode($product_arr);

  } else {
        // No Categories
        echo json_encode(
          array('message' => 'No products Found')
        );
  }