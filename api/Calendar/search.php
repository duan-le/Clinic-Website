<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Calendar.php';

  $database = new Database();
  $db = $database->connect();
	$calendar = new Calendar($db);

	$calendar->month = isset($_GET['month']) ? $_GET['month'] : die();
	$calendar->year = isset($_GET['year']) ? $_GET['year'] : die();
	$result = $calendar->search();
  $num = $result->rowCount();

  if ($num > 0) {
		$calendar_arr = array();
		$calendar_arr['data'] = array();

		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			extract($row);
			$calendar_item = array(
				'month' => $month,
				'year' => $year,
			);
			array_push($calendar_arr['data'], $calendar_item);
		}
		echo json_encode($calendar_arr);
  } else {
		echo json_encode(
			array('message' => 'No Calendar Found')
		);
	}
	