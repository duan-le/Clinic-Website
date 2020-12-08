<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../model/PurchasedBy.php';

  $database = new Database();
  $db = $database->connect();

  $pb = new PurchasedBy($db);
  $pb->product_id = isset($_GET['product_id']) ? $_GET['product_id'] : die();
  $pb->search();

  $pb_arr = array(
    'product_id' => $pb->product_id,
    'user_id' => $pb->user_id
  );

  print_r(json_encode($pb_arr));
