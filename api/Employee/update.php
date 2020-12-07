<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../model/Employee.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $employee = new Employee($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $employee->user_id = $data->user_id;
  $employee->first_name = $data->first_name;
  $employee->last_name = $data->last_name;
  $employee->password = $data->password;
  $employee->birthdate = $data->birthdate;
  $employee->address = $data->address;
  $employee->phone_number = $data->phone_number;
  $employee->sex = $data->sex;
  $employee->start_date = $data->start_date;
  $employee->wage = $data->wage;
  $employee->hours = $data->hours;
  $employee->SIN = $data->SIN;

  // Create Category
  if($employee->update()) {
    echo json_encode(
      array('message' => 'Employee Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Employee Not Updated')
    );
  }