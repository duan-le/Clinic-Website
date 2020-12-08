<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../model/Client.php';

  $database = new Database();
  $db = $database->connect();

  $client = new Client($db);
  $data = json_decode(file_get_contents("php://input"));

  $client->user_id = $data->user_id;
  $client->first_name = $data->first_name;
  $client->last_name = $data->last_name;
  $client->password = $data->password;
  $client->birthdate = $data->birthdate;
  $client->address = $data->address;
  $client->phone_number = $data->phone_number;
  $client->sex = $data->sex;

  if($client->update()) {
    echo json_encode(
      array('message' => 'Client Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Client Not Updated')
    );
  }
