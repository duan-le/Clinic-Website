<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../model/PurchasedBy.php';

  $database = new Database();
  $db = $database->connect();

  $pb = new PurchasedBy($db);
  $pb->product_id = isset($_GET['product_id']) ? $_GET['product_id'] : die();
  $result = $pb->search();
  $num = $result->rowCount();
  $rows = $result->fetchAll(\PDO::FETCH_ASSOC);
  if($num > 0) echo json_encode($rows);
  else echo json_encode(array('message' => 'No Purchased By Found'));
