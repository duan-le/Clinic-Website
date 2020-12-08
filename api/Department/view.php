<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../model/Department.php';

  $database = new Database();
  $db = $database->connect();

  $department = new Department($db);
  $result = $department->view();
  $num = $result->rowCount();

  if($num > 0) {
    $department_arr = array();
    $department_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $department_item = array(
        'dnumber' => $dnumber,
        'type' => $type
      );

      array_push($department_arr['data'], $department_item);
    }

    echo json_encode($department_arr);
  } else {
    echo json_encode(
      array('message' => 'No Department Found')
    );
  }