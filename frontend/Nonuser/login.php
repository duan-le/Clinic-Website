
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
  <title>Appointment</title>
  <meta charset="utf-8">
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
    <section id="appointform">
      <div class="container">
        <div class="row">
          <div class="col">
            <fieldset>
              <h2><b>Login to your account</b></h2>
              <form method="post" action="loginSubmit.php">
                <div>
                  User ID: <input type="number" name="id" placeholder="Required" required>
                </div>
                <br />
                <div>
                  Password: <input type="text" name="password" placeholder="Required" required>
                </div>            
                <br />
                <input type="submit" name="login" class="button" value="Login" />
              </form>
            </fieldset>

          </div>
        </div>
      </div>
    </section>

  </main>

</body>

</html>