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

  if ($num > 0) {
		$r_arr = array();
		$r_arr['data'] = array();

		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			extract($row);
			$r_item = array(
				'number' => $number,
				'date' => $date
			);
			array_push($r_arr['data'], $r_item);
		}
		echo json_encode($r_arr);
  } else {
		echo json_encode(
			array('message' => 'No Receipts Found')
		);
	}
