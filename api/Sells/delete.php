<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../model/Sells.php';

  $database = new Database();
  $db = $database->connect();
	$sells = new Sells($db);
  $data = json_decode(file_get_contents("php://input"));

  $sells->dnumber = $data->dnumber;
  $sells->product_id = $data->product_id;

  if ($sells->delete()) {
    echo json_encode(
      array('message' => 'Sell Deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Sell Not Deleted')
    );
  }
