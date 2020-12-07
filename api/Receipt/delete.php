<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../model/Receipt.php';

  $database = new Database();
  $db = $database->connect();
	$receipt = new Receipt($db);

  $data = json_decode(file_get_contents("php://input"));

  $receipt->number = $data->number;

  if ($receipt->delete()) {
    echo json_encode(
      array('message' => 'Receipt Deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Receipt Not Deleted')
    );
  }
