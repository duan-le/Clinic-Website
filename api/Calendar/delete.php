<?php 
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../model/Calendar.php';

  $database = new Database();
  $db = $database->connect();
	$calendar = new Calendar($db);
  $data = json_decode(file_get_contents("php://input"));
  
  $calendar->product_id = $data->product_id;
  $calendar->receipt_number = $data->receipt_number;

  if ($calendar->delete()) {
    echo json_encode(
      array('message' => 'Calendar Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Calendar Not Created')
    );
  }
