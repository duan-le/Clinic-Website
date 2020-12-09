<?php 
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../model/Calendar.php';

  $database = new Database();
  $db = $database->connect();
  $oldCalendar = new Calendar($db);
  $newCalendar = new Calendar($db); 
  $data = json_decode(file_get_contents("php://input"));
  
  $oldCalendar->month = $data->month;
  $oldCalendar->year = $data->year;
  $newCalendar->month = $data->newMonth;
  $newCalendar->year = $data->newYear;
  
  if ($oldCalendar->delete() && $newCalendar->insert()) {
    echo json_encode(
      array('message' => 'Calendar Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Calendar Not Updated')
    );
  }


