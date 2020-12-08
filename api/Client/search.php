<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../model/Client.php';

  $database = new Database();
  $db = $database->connect();

  $client = new Client($db);
  $client->user_id = isset($_GET['user_id']) ? $_GET['user_id'] : die();
  $client->search();

  $client_arr = array(
    'user_id' => $client->user_id,
    'first_name' => $client->first_name,
    'last_name' => $client->last_name,
    'password' => $client->password,
    'birthdate' => $client->birthdate,
    'address' => $client->address,
    'phone_number' => $client->phone_number,
    'sex' => $client->sex,
  );
  
  print_r(json_encode($client_arr));
