<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../model/Receipt.php';

  $database = new Database();
  $db = $database->connect();

  $receipt = new Receipt($db);
  $receipt->number = isset($_GET['number']) ? $_GET['number'] : die();
  $receipt->search();

  $receipt_arr = array(
    'name' => $receipt->number,
    'date' => $receipt->date,
  );

  print_r(json_encode($receipt_arr));
