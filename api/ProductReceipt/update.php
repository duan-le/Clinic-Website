<?php 
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../model/ProductReceipt.php';

  $database = new Database();
  $db = $database->connect();
  $old_product_receipt = new ProductReceipt($db);
  $new_product_receipt = new ProductReceipt($db);
  $data = json_decode(file_get_contents("php://input"));
  
  $old_product_receipt->product_id = $data->product_id;
  $old_product_receipt->receipt_number = $data->receipt_number;
  $new_product_receipt->product_id = $data->new_product_id;
  $new_product_receipt->receipt_number = $data->new_receipt_number;

  if ($old_product_receipt->delete() && $new_product_receipt->insert()) {
    echo json_encode(
      array('message' => 'Product Receipt Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Product Receipt Not Updated')
    );
  }
