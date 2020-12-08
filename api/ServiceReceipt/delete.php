<?php 
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../model/ServiceReceipt.php';

  $database = new Database();
  $db = $database->connect();
	$service_receipt = new ServiceReceipt($db);
  $data = json_decode(file_get_contents("php://input"));
  
  $service_receipt->service_name = $data->service_name;
  $service_receipt->receipt_number = $data->receipt_number;

  if ($service_receipt->delete()) {
    echo json_encode(
      array('message' => 'Service Receipt Deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Service Receipt Not Deleted')
    );
  }
