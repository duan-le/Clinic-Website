<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../model/ProductReceipt.php';

  $database = new Database();
  $db = $database->connect();
	$product_receipt = new ProductReceipt($db);

	$product_receipt->receipt_number = isset($_GET['receipt_number']) ? $_GET['receipt_number'] : die();
	$result = $product_receipt->search();
  $num = $result->rowCount();
  $rows = $result->fetchAll(\PDO::FETCH_ASSOC);
  if($num > 0) echo json_encode($rows);
  else echo json_encode(array('message' => 'No Product Receipt Found'));
