<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../model/Client.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog category object
  $client = new Client($db);

  // Get ID
  $client->user_id = isset($_GET['user_id']) ? $_GET['user_id'] : die();

  // Get post
  $client->search();

  // Create array
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

  // Make JSON
  print_r(json_encode($client_arr));
