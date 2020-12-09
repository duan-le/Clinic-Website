<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../model/BankAccount.php';

  $database = new Database();
  $db = $database->connect();
	$bank_account = new BankAccount($db);

	$bank_account->employee_id = isset($_GET['employee_id']) ? $_GET['employee_id'] : die();
  $result = $bank_account->search();
  $num = $result->rowCount();
  $rows = $result->fetchAll(\PDO::FETCH_ASSOC);
  if($num > 0) echo json_encode($rows);
  else echo json_encode(array('message' => 'No Bank Account Found'));
