<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../model/Sells.php';

  $database = new Database();
  $db = $database->connect();
	$sell = new Sells($db);

	$sell->dnumber = isset($_GET['dnumber']) ? $_GET['dnumber'] : die();
  $result = $sell->search();
  $num = $result->rowCount();
  $rows = $result->fetchAll(\PDO::FETCH_ASSOC);
  if($num > 0) echo json_encode($rows);
  else echo json_encode(array('message' => 'Sells Not Found'));
