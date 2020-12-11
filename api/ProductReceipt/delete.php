<?php
  session_start();

  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../model/ProductReceipt.php';

  if (isset($_SESSION['user_id'])
    && isset($_SESSION['user_type'])
    && $_SESSION['user_type'] == 'admin'
  ) {
    $database = new Database();
    $db = $database->connect();
    $product_receipt = new ProductReceipt($db);
    $data = json_decode(file_get_contents("php://input"));
    
    $product_receipt->product_id = $data->product_id;
    $product_receipt->receipt_number = $data->receipt_number;

    if ($product_receipt->delete()) {
      echo json_encode(
        array('message' => 'Product Receipt Deleted')
      );
    } else {
      echo json_encode(
        array('message' => 'Product Receipt Not Deleted')
      );
    }
  } else {
    http_response_code(401);
    echo json_encode(array('message' => 'You Are Not Authorized'));
  }