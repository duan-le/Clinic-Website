<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../model/PurchasedBy.php';

  $database = new Database();
  $db = $database->connect();

  $pb = new PurchasedBy($db);
  $pb->product_id = isset($_GET['product_id']) ? $_GET['product_id'] : die();
  $result = $pb->search();
  $num = $result->rowCount();

  if($num > 0) {
    $pb_arr = array();
    $pb_arr['data'] = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $pb_item = array(
        'product_id' => $product_id,
        'user_id' => $user_id
      );
      array_push($pb_arr['data'], $pb_item);
    }
    echo json_encode($pb_arr);
  } else {
    echo json_encode(
      array('message' => 'No Purchased By Found')
    );
  }
