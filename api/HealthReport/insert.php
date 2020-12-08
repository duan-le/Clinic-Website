<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../model/HealthReport.php';

  $database = new Database();
  $db = $database->connect();
	$hp = new HealthReport($db);
  $data = json_decode(file_get_contents("php://input"));

  $hp->client_id = $data->client_id;
  $hp->date = $data->date;

  if ($hp->insert()) {
    echo json_encode(
      array('message' => 'Health Report Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Health Report Not Created')
    );
  }
