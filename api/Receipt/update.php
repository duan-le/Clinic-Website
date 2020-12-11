<?php
  session_start();

  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../model/Receipt.php';

  if (isset($_SESSION['user_id'])
    && isset($_SESSION['user_type'])
    && $_SESSION['user_type'] == 'admin'
  ) {
    $database = new Database();
    $db = $database->connect();
    $receipt = new Receipt($db);
    $data = json_decode(file_get_contents("php://input"));

    $receipt->number = $data->number;
    $receipt->date = $data->date;

    if ($receipt->update()) {
      echo json_encode(
        array('message' => 'Receipt Updated')
      );
    } else {
      echo json_encode(
        array('message' => 'Receipt Not Updated')
      );
    }
  } else {
    http_response_code(401);
    echo json_encode(array('message' => 'You Are Not Authorized'));
  }
