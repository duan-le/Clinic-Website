<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../model/Client.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $client = new Client($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $client->user_id = $data->user_id;
  $client->first_name = $data->first_name;
  $client->last_name = $data->last_name;
  $client->password = $data->password;
  $client->birthdate = $data->birthdate;
  $client->address = $data->address;
  $client->phone_number = $data->phone_number;
  $client->sex = $data->sex;

  // Create Category
  if($client->update()) {
    echo json_encode(
      array('message' => 'Client Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Client Not Updated')
    );
  }
