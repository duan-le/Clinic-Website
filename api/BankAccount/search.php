<?php 
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/BankAccount.php';

  $database = new Database();
  $db = $database->connect();
	$bank_account = new BankAccount($db);
	
	$bank_account->employee_id = isset($_GET['employee_id']) ? $_GET['employee_id'] : die();
  $result = $bank_account->view();
  $num = $result->rowCount();

  if ($num > 0) {
		$bank_account_arr = array();
		$bank_account_arr['data'] = array();

		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			extract($row);
			$bank_account_item = array(
				'account_number' => $account_number,
				'account_type' => $account_type,
				'employee_id' => $employee_id
			);
			array_push($bank_account_arr['data'], $bank_account_item);
		}
		echo json_encode($bank_account_arr);
  } else {
		echo json_encode(
			array('message' => 'No Bank Account Found')
		);
	}
	