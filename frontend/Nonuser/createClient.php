<?php
include_once '../../config/Database.php';
include_once '../../model/Client.php';

$database = new Database();
$db = $database->connect();

$client = new Client($db);
$result = $client->view();

$num = $result->rowCount();
$articles = $result->fetchAll(\PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>

<head>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous" />

  <!-- Montserrat font -->
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet" />

  <!-- My CSS -->
  <link rel="stylesheet" href="../style.css" />

  <meta charset="utf-8">
  <title>Client</title>
</head>

<body>

  <nav class="navbar fixed-top navbar-expand-sm navbar-light bg-white">
    <div class="container">
      <a class="navbar-brand" href="home.php">Massage Clinic</a>

      <button class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-menu">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbar-collapse-menu">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="createClient.php">Client</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="shop.php">Shop</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="seeServices.php">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <main>
    <section id="clientform">
      <div class="container">
        <div class="row">
        <div class="col">        
        <fieldset>
            <h2><b>Registration</b></h2>
            <form class="info" method="post" action="createdClient.php">
              <div>
                First Name: <input type="text" name="fname" placeholder="Required" required>
              </div>
              <br />
              <div>
                Last Name: <input type="text" name="lname" placeholder="Required" required>
              </div>
              <br />
              <div>
                Password: <input type="text" name="password" placeholder="Required" required>
              </div>
              <br />
              <div>
                Date of Birth: <input type="date" name="date" placeholder="Required" required>
              </div>
              <br />
              <div>
                Address: <input type="text" name="address" placeholder="Required" required>
              </div>
              <br />
              <div>
                Phone Number: <input type="text" name="phone" placeholder="Required" required>
              </div>
              <br />
              <div>
                Sex: 
                <select name="sex" placeholder="Required" required>
                  <option value="choose">Select an option</option>
                  <option value="M">Male</option>
                  <option value="F">Female</option>
                </select>
              </div>
              <br />
              <button>Create Profile</button>
            </form>
          </fieldset>
          </div>  
        </div>
      </div>
    </section>

  </main>
  <!-- jQuery and Bootstrap Bundle (includes Popper) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
  </script>
</body>

</html>