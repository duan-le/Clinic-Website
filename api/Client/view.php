<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../model/Client.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate category object
  $client = new Client($db);

  // Category read query
  $result = $client->view();

  // Get row count
  $num = $result->rowCount();

  // Check if any categories
  if($num > 0) {
        // Cat array
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

          // Push to "data"
          array_push($client_arr['data'], $client_item);
        }

        // Turn to JSON & output
        echo json_encode($client_arr);

  } else {
        // No Categories
        echo json_encode(
          array('message' => 'No Categories Found')
        );
  }
