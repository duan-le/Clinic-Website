<?php 
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/BankAccount.php';

  $database = new Database();
  $db = $database->connect();
	$bank_account = new BankAccount($db);
  $data = json_decode(file_get_contents("php://input"));
  
  $bank_account->account_number = $data->account_number;
  $bank_account->account_type = $data->account_type;
  $bank_account->employee_id = $data->employee_id;

  if ($bank_account->insert()) {
    echo json_encode(
      array('message' => 'Bank Account Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Bank Account Not Created')
    );
  }
