<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../model/Service.php';

  $database = new Database();
  $db = $database->connect();

  $service = new Service($db);
  $data = json_decode(file_get_contents("php://input"));
  $service->name = $data->name;

  if($service->delete()) {
    echo json_encode(
      array('message' => 'Service Deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Service Not Deleted')
    );
  }