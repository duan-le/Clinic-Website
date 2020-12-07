<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../model/HealthReport.php';

  $database = new Database();
  $db = $database->connect();
	$hp = new HealthReport($db);

	$hp->client_id = isset($_GET['client_id']) ? $_GET['client_id'] : die();
  $result = $hp->search();
  $num = $result->rowCount();

  if ($num > 0) {
		$hp_arr = array();
		$hp_arr['data'] = array();

		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			extract($row);
			$hp_item = array(
				'client_id' => $client_id,
				'date' => $date
			);
			array_push($hp_arr['data'], $hp_item);
		}
		echo json_encode($hp_arr);
  } else {
		echo json_encode(
			array('message' => 'No health report found')
		);
	}
