<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../model/PurchasedBy.php';

  $database = new Database();
  $db = $database->connect();

  $pb = new PurchasedBy($db);
  $data = json_decode(file_get_contents("php://input"));

  $pb->product_id = $data->product_id;
  $pb->user_id = $data->user_id;

  if($pb->insert()) {
    echo json_encode(
      array('message' => 'Purchased By Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Purchase By Not Created')
    );
  }
