<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../model/Department.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate category object
  $department = new Department($db);

  // Category read query
  $result = $department->view();

  // Get row count
  $num = $result->rowCount();

  // Check if any categories
  if($num > 0) {
        // Cat array
        $department_arr = array();
        $department_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $department_item = array(
            'dnumber' => $dnumber,
            'type' => $type
          );

          // Push to "data"
          array_push($department_arr['data'], $department_item);
        }

        // Turn to JSON & output
        echo json_encode($department_arr);

  } else {
        // No Categories
        echo json_encode(
          array('message' => 'No Department Found')
        );
  }