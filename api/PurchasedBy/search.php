<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../model/PurchasedBy.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog category object
  $pb = new PurchasedBy($db);

  // Get ID
  $pb->product_id = isset($_GET['product_id']) ? $_GET['product_id'] : die();

  // Get post
  $pb->search();

  // Create array
  $pb_arr = array(
    'product_id' => $pb->product_id,
    'user_id' => $pb->user_id
  );

  // Make JSON
  print_r(json_encode($pb_arr));
