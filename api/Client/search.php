<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../model/Client.php';

  $database = new Database();
  $db = $database->connect();

  $client = new Client($db);
  $client->user_id = isset($_GET['user_id']) ? $_GET['user_id'] : die();
  $result = $client->search();
  $num = $result->rowCount();

  if($num > 0) {
    $client_arr = array();
    $client_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $client_item = array(
        'user_id' => $user_id,
        'first_name' => $first_name,
        'last_name' => $last_name,
        'password' => $password,
        'birthdate' => $birthdate,
        'address' => $address,
        'phone_number' => $phone_number,
        'sex' => $sex,
      );
      array_push($client_arr['data'], $client_item);
    }
    echo json_encode($client_arr);
  } else {
    echo json_encode(
      array('message' => 'No Client Found')
    );
  }
