<?php
  session_start();

  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../model/Appointment.php';

  if (isset($_SESSION['user_id'])
    && isset($_SESSION['user_type'])
    && $_SESSION['user_type'] == 'client'
  ) {
    $database = new Database();
    $db = $database->connect();
    $appointment = new Appointment($db);
    $data = json_decode(file_get_contents("php://input"));

    $appointment->day = $data->day;
    $appointment->month= $data->month;
    $appointment->year = $data->year;
    $appointment->time = $data->time;
    $appointment->client_id = $_SESSION['user_id'];
    $appointment->employee_id = $data->employee_id;
    $appointment->service_name = $data->service_name;
    if ($appointment->insert()) {
      echo json_encode(
        array('message' => 'Appointment Created')
      );
    } else {
      echo json_encode(
        array('message' => 'Appointment Not Created')
      );
    }
  } else {
    http_response_code(401);
    echo json_encode(array('message' => 'You Are Not Authorized'));
  }
