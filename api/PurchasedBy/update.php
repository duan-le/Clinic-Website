<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../model/PurchasedBy.php';

  $database = new Database();
  $db = $database->connect();

  $oldpb = new PurchasedBy($db);
  $newpb = new PurchasedBy($db);
  $data = json_decode(file_get_contents("php://input"));

  $oldpb->product_id = $data->product_id;
  $oldpb->user_id = $data->user_id;
  $newpb->product_id = $data->new_product_id;
  $newpb->user_id = $data->new_user_id;

  if($oldpb->delete() && $newpb->insert()) {
    echo json_encode(
      array('message' => 'Purchased By Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Purchase By Not Updated')
    );
  }
