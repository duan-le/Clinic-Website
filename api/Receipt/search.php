<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../model/Receipt.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog category object
  $receipt = new Receipt($db);

  // Get ID
  $receipt->number = isset($_GET['number']) ? $_GET['number'] : die();

  // Get post
  $receipt->search();

  // Create array
  $receipt_arr = array(
    'name' => $receipt->number,
    'price' => $receipt->date,
  );

  // Make JSON
  print_r(json_encode($receipt_arr));
