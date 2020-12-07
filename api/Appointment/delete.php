<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../model/Appointment.php';

  $database = new Database();
  $db = $database->connect();
	$ap = new Appointment($db);
  $data = json_decode(file_get_contents("php://input"));

  $ap->appoint_id = $data->appoint_id;

  if ($ap->delete()) {
    echo json_encode(
      array('message' => 'Appointment Deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Appointment Not Deleted')
    );
  }
