<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../model/Employee.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate category object
  $employee = new Employee($db);

  // Category read query
  $result = $employee->view();

  // Get row count
  $num = $result->rowCount();

  // Check if any categories
  if($num > 0) {
        // Cat array
        $employee_arr = array();
        $employee_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $employee_item = array(
            'user_id' => $user_id,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'password' => $password,
            'birthdate' => $birthdate,
            'address' => $address,
            'phone_number' => $phone_number,
            'sex' => $sex,
            'start_date' => $start_date,
            'wage' => $wage,
            'hours' => $hours,
            'SIN' => $SIN
          );

          // Push to "data"
          array_push($employee_arr['data'], $employee_item);
        }

        // Turn to JSON & output
        echo json_encode($employee_arr);

  } else {
        // No Categories
        echo json_encode(
          array('message' => 'No Employees Found')
        );
  }
