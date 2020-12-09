<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../model/Receipt.php';

  $database = new Database();
  $db = $database->connect();

  $receipt = new Receipt($db);
  $receipt->number = isset($_GET['number']) ? $_GET['number'] : die();
	$result = $receipt->search();
  $num = $result->rowCount();
  $rows = $result->fetchAll(\PDO::FETCH_ASSOC);
  if($num > 0) echo json_encode($rows);
  else echo json_encode(array('message' => 'No Receipts Found'));
