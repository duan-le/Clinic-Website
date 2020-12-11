<?php
  session_start();

  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../model/Sells.php';

  if (isset($_SESSION['user_id'])
    && isset($_SESSION['user_type'])
    && $_SESSION['user_type'] == 'admin'
  ) {
    $database = new Database();
    $db = $database->connect();
    $sells = new Sells($db);
    $data = json_decode(file_get_contents("php://input"));

    $sells->dnumber = $data->dnumber;
    $sells->product_id = $data->product_id;

    if ($sells->insert()) {
      echo json_encode(
        array('message' => 'Sells Created')
      );
    } else {
      echo json_encode(
        array('message' => 'Sells Not Created')
      );
    }
  } else {
    http_response_code(401);
    echo json_encode(array('message' => 'You Are Not Authorized'));
  }