<?php
  session_start();

  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../model/HealthReport.php';

  if (isset($_SESSION['user_id'])
    && isset($_SESSION['user_type'])
    && $_SESSION['user_type'] == 'admin'
  ) {
    $database = new Database();
    $db = $database->connect();
    $oldhp = new HealthReport($db);
    $newhp = new HealthReport($db);
    $data = json_decode(file_get_contents("php://input"));

    $oldhp->client_id = $data->client_id;
    $oldhp->date = $data->date;
    $newhp->client_id = $data->newClient_id;
    $newhp->date = $data->newDate;

    if ($oldhp->delete() && $newhp->insert()) {
      echo json_encode(
        array('message' => 'Health Report Updated')
      );
    } else {
      echo json_encode(
        array('message' => 'Health Report Not Updated')
      );
    }
  } else {
    http_response_code(401);
    echo json_encode(array('message' => 'You Are Not Authorized'));
  }
