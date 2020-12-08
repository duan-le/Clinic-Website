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

  if ($num > 0) {
		$sell_arr = array();
		$sell_arr['data'] = array();

		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			extract($row);
			$sell_item = array(
				'dnumber' => $dnumber,
				'product_id' => $product_id
			);
			array_push($sell_arr['data'], $sell_item);
		}
		echo json_encode($sell_arr);
  } else {
		echo json_encode(
			array('message' => 'Sells Not Found')
		);
	}
