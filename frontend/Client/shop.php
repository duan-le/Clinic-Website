<?php
include_once '../../config/Database.php';
include_once '../../model/product.php';

$database = new Database();
$db = $database->connect();

$product = new Product($db);
$result = $product->view();

$num = $result->rowCount();
$articles = $result->fetchAll(\PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>

<head>
  <title>Shop</title>
  <meta charset="utf-8">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous" />

  <!-- Montserrat font -->
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet" />

  <!-- My CSS -->
  <link rel="stylesheet" href="style.css" />
</head>

<body>

  <nav class="navbar fixed-top navbar-expand-sm navbar-light bg-white">
    <div class="container">
      <a class="navbar-brand" href="../home.php">Massage Clinic</a>

      <button class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-menu">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbar-collapse-menu">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="createClient.php">Client</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="bookAppointment.php">Appointments</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="shop.php">Shop</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="seeServices.php">Services</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <main>
    <section id="product">
      <div class="container">
        <div class="row">
          <div class="col">
            <table>
              <tr>
                <th>Product ID </th>
                <th> Name </th>
                <th> Price </th>
              </tr>
              <?php foreach ($articles as $article) : ?>
                <tr>
                  <td> <?php echo $article['product_id']; ?> </td>
                  <td> <?php echo $article['name']; ?> </td>
                  <td> <?php echo $article['price']; ?> </td>
                </tr>
              <?php endforeach ?>
            </table>

            <form method="post" action="buyProduct.php">
              <fieldset>
                <br>
                <br>
                <h2><b>Buy Product</b></h2>
                <input type="checkbox" name="products[]" value="1" id="lot">
                <label for="lot">Lotion</label><br>
                <input type="checkbox" name="products[]" value="2" id="diffb">
                <label for="diffb">Diffuser Blend</label><br>
                <input type="checkbox" name="products[]" value="3" id="massoil">
                <label for="massoil">Massage Oil</label><br>
                <input type="checkbox" name="products[]" value="4" id="diff">
                <label for="diff">Diffuser</label><br>
                <input type="checkbox" name="products[]" value="5" id="cand">
                <label for="cand">Candle</label><br>
                <input type="checkbox" name="products[]" value="6" id="green">
                <label for="green">Green Tea</label><br>
              </fieldset>
              <br />

              <button onClick="window.location.reload();">Buy</button>
            </form>
          </div>
        </div>
      </div>
  </main>

</body>

</html>