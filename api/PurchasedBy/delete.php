<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../model/PurchasedBy.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $pb = new PurchasedBy($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $pb->product_id = $data->product_id;
  $pb->user_id = $data->user_id;

  // Delete service
  if($pb->delete()) {
    echo json_encode(
      array('message' => 'PurchaseBy Deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'PurchaseBy Not Deleted')
    );
  }
