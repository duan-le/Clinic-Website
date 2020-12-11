<?php
  session_start();

  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../model/Client.php';

  if (isset($_SESSION['user_id'])
    && isset($_SESSION['user_type'])
    && $_SESSION['user_type'] == 'admin'
  ) {
    $database = new Database();
    $db = $database->connect();

    $client = new Client($db);
    $data = json_decode(file_get_contents("php://input"));
    $client->user_id = $data->user_id;

    if($client->delete()) {
      echo json_encode(
        array('message' => 'Client Deleted')
      );
    } else {
      echo json_encode(
        array('message' => 'Client Not Deleted')
      );
    }
  } else {
    http_response_code(401);
    echo json_encode(array('message' => 'You Are Not Authorized'));
  }
