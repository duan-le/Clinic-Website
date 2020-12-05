<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/BankAccount.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate BankAccount object
  $bank_account = new BankAccount($db);

  // BankAccount read query
  $result = $bank_account->view();
  
  // Get row count
  $num = $result->rowCount();

  // Check if any BankAccount
  if ($num > 0) {
		// Cat array
		$bank_account_arr = array();
		$bank_account_arr['data'] = array();

		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			extract($row);

			$bank_account_item = array(
				'account_number' => $account_number,
				'account_type' => $account_type,
				'employee_id' => $employee_id
			);
			// Push to "data"
			array_push($bank_account_arr['data'], $bank_account_item);
		}

		// Turn to JSON & output
		echo json_encode($bank_account_arr);

  } else {
		// No Bank Account
		echo json_encode(
			array('message' => 'No Bank Account Found')
		);
  }