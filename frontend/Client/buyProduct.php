<?php
    include_once '../../config/Database.php';
    include_once '../../model/Receipt.php';
    include_once '../../model/ProductReceipt.php';
    
    $database = new Database();
    $db = $database->connect();
    
    $receipt = new Receipt($db);
    $receipt->date = date("m/d/Y");

    $receipt->insert();
    $result = $receipt->view();
    $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);

    $num = $result->rowCount();
    $articles = $result->fetchAll(\PDO::FETCH_ASSOC);

    foreach ($articles as $article) :
        $receiptnum = $article['number'];
    endforeach;

    $database = new Database();
    $db = $database->connect();
    
    $productreceipt = new ProductReceipt($db);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $products = $_POST['products'];
        foreach ($products as $product) :
            $productreceipt->product_id = $product;
            $productreceipt->receipt_number = $receiptnum;

            $productreceipt->insert();
            $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);
        endforeach;
    }
?>
<!DOCTYPE html>
<html>

<head>
  <style>
      body {background-color: powderblue;}
      h1   {color: blue;}
  </style>
  <title>Massage Clinic</title>
  <meta charset="utf-8">
</head>

<body>
  <h1>Products bought</h1>
  <button onclick="location.href = '../home.php';">Return to homepage</button>
</body>

  </html>