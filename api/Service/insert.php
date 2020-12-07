<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../model/Service.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $service = new Service($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $service->name = $data->name;
  $service->price = $data->price;

  // Create Category
  if($service->insert()) {
    echo json_encode(
      array('message' => 'Service Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Service Not Created')
    );
  }