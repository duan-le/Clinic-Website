<?php
  session_start();
  
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../model/BankAccount.php';

  if (isset($_SESSION['user_id'])
    && isset($_SESSION['user_type'])
    && $_SESSION['user_type'] == 'admin'
  ) {
    $database = new Database();
    $db = $database->connect();
    $bank_account = new BankAccount($db);
    $data = json_decode(file_get_contents("php://input"));
    
    $bank_account->account_number = $data->account_number;
    $bank_account->account_type = $data->account_type;
    $bank_account->employee_id = $data->employee_id;

    if ($bank_account->update()) {
      echo json_encode(
        array('message' => 'Bank Account Updated')
      );
    } else {
      echo json_encode(
        array('message' => 'Bank Account Not Updated')
      );
    }
  } else {
    http_response_code(401);
    echo json_encode(array('message' => 'You Are Not Authorized'));
  }
