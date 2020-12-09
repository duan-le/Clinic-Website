<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../model/Sells.php';

  $database = new Database();
  $db = $database->connect();
  $old_sells = new Sells($db);
  $new_sells = new Sells($db);
  $data = json_decode(file_get_contents("php://input"));

  $old_sells->dnumber = $data->dnumber;
  $old_sells->product_id = $data->product_id;
  $new_sells->dnumber = $data->new_dnumber;
  $new_sells->product_id = $data->new_product_id;

  if ($old_sells->delete() && $new_sells->insert()) {
    echo json_encode(
      array('message' => 'Sells Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Sells Not Updated')
    );
  }
