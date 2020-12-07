<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../model/appointment.php';

  $database = new Database();
  $db = $database->connect();
	$appointment = new Appointment($db);

	$appointment->appoint_id = isset($_GET['appoint_id']) ? $_GET['appoint_id'] : die();
  $result = $appointment->search();
  $num = $result->rowCount();

  if ($num > 0) {
		$appoint_arr = array();
		$appoint_arr['data'] = array();

		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			extract($row);
			$appoint_item = array(
				'appoint_id' => $appoint_id,
				'day' => $day,
				'month' => $month,
        'year' => $year,
        'time' => $time,
        'client_id' => $client_id,
        'employee_id' => $employee_id,
        'service_name' = $service_name

			);
			array_push($appoint_arr['data'], $appoint_item);
		}
		echo json_encode($appoint_arr);
  } else {
		echo json_encode(
			array('message' => 'No Appointments Found')
		);
	}
