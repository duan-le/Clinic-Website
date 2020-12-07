<?php 
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../model/ProductReceipt.php';

  $database = new Database();
  $db = $database->connect();
	$product_receipt = new ProductReceipt($db);
	
	$result = $product_receipt->view();
  $num = $result->rowCount();

  if ($num > 0) {
		$product_receipt_arr = array();
		$product_receipt_arr['data'] = array();

		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			extract($row);
			$product_receipt_item = array(
				'product_id' => $product_id,
				'receipt_number' => $receipt_number,
			);
			array_push($product_receipt_arr['data'], $product_receipt_item);
		}
		echo json_encode($product_receipt_arr);
  } else {
		echo json_encode(
			array('message' => 'No Product Receipt Found')
		);
	}
	