<?php
  session_start();
  
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../model/Appointment.php';

  if (isset($_SESSION['user_id'])
    && isset($_SESSION['user_type'])
    && $_SESSION['user_type'] == 'admin'
  ) {
    $database = new Database();
    $db = $database->connect();
    $ap = new Appointment($db);
    $data = json_decode(file_get_contents("php://input"));

    $ap->appoint_id = $data->appoint_id;
    $ap->day = $data->day;
    $ap->month = $data->month;
    $ap->year = $data->year;
    $ap->time = $data->time;
    $ap->client_id = $data->client_id;
    $ap->employee_id = $data->employee_id;
    $ap->service_name = $data->service_name;

    if ($ap->update()) {
      echo json_encode(
        array('message' => 'Appointment Updated')
      );
    } else {
      echo json_encode(
        array('message' => 'Appointment Not Updated')
      );
    }
  } else {
    http_response_code(401);
    echo json_encode(array('message' => 'You Are Not Authorized'));
  }
