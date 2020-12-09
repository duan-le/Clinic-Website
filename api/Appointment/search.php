<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../model/Appointment.php';

  $database = new Database();
  $db = $database->connect();
	$appointment = new Appointment($db);

	$appointment->appoint_id = isset($_GET['appoint_id']) ? $_GET['appoint_id'] : die();
  $result = $appointment->search();
  $num = $result->rowCount();
  $rows = $result->fetchAll(\PDO::FETCH_ASSOC);
  if($num > 0) echo json_encode($rows);
  else echo json_encode(array('message' => 'No Appointment Found'));
