<?php
  session_start();

  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  if (isset($_SESSION['user_id'])
    && isset($_SESSION['user_type'])
  ) {
    session_unset();
    session_destroy();
    header("Location: http://localhost/massageClinic/frontend/Nonuser/home.php");
    echo json_encode(array('message' => 'Logged Out'));
  } else {
    echo json_encode(array('message' => 'You Were Never Logged In'));
  }
?>