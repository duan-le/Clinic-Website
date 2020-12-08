<?php
	header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../model/ServiceReceipt.php';

  $database = new Database();
  $db = $database->connect();
	$service_receipt = new ServiceReceipt($db);
	
	$service_receipt->receipt_number = isset($_GET['receipt_number']) ? $_GET['receipt_number'] : die();
	$result = $service_receipt->search();
  $num = $result->rowCount();

  if ($num > 0) {
		$service_receipt_arr = array();
		$service_receipt_arr['data'] = array();

		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			extract($row);
			$service_receipt_item = array(
				'service_name' => $service_name,
				'receipt_number' => $receipt_number,
			);
			array_push($service_receipt_arr['data'], $service_receipt_item);
		}
		echo json_encode($service_receipt_arr);
  } else {
		echo json_encode(
			array('message' => 'No Service Receipt Found')
		);
	}
	