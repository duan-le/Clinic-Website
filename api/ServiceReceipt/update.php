<?php
  session_start(); 
  
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../model/ServiceReceipt.php';

  if (isset($_SESSION['user_id'])
    && isset($_SESSION['user_type'])
    && $_SESSION['user_type'] == 'admin'
  ) {
    $database = new Database();
    $db = $database->connect();
    $old_service_receipt = new ServiceReceipt($db);
    $new_service_receipt = new ServiceReceipt($db);
    $data = json_decode(file_get_contents("php://input"));
    
    $old_service_receipt->service_name = $data->service_name;
    $old_service_receipt->receipt_number = $data->receipt_number;
    $new_service_receipt->service_name = $data->new_service_name;
    $new_service_receipt->receipt_number = $data->new_receipt_number;

    if ($old_service_receipt->delete() && $new_service_receipt->insert()) {
      echo json_encode(
        array('message' => 'Service Receipt Updated')
      );
    } else {
      echo json_encode(
        array('message' => 'Service Receipt Not Updated')
      );
    }
  } else {
    http_response_code(401);
    echo json_encode(array('message' => 'You Are Not Authorized'));
  }
