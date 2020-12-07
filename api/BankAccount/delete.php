<?php 
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../model/BankAccount.php';

  $database = new Database();
  $db = $database->connect();
	$bank_account = new BankAccount($db);
  $data = json_decode(file_get_contents("php://input"));
  
  $bank_account->employee_id = $data->employee_id;

  if ($bank_account->delete()) {
    echo json_encode(
      array('message' => 'Bank Account Deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Bank Account Not Deleted')
    );
  }
