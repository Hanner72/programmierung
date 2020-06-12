<!doctype html>
<html lang="de">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <link rel="stylesheet" href="css/sidebar.css">

    <title>Login</title>
  </head>
  <body>

  <!-- Includes der Menüs -->
  <?php require "../header_login.php"; ?>

    <?php
    if(isset($_POST["submit"])){
      require("config.inc.php");
      $stmt = $mysql->prepare("SELECT * FROM user WHERE Benutzername = :user"); //Username überprüfen
      $stmt->bindParam(":user", $_POST["username"]);
      $stmt->execute();
      $count = $stmt->rowCount();
      if($count == 1){
        //Username ist frei
        $row = $stmt->fetch();
        if(password_verify($_POST["pw"], $row["Passwort"])){
          session_start();
          $_SESSION["username"] = $row["Benutzername"];
          header("Location: ../index.php");
        } else {
          echo "Der Login ist fehlgeschlagen";
        }
      } else {
        echo "Der Login ist fehlgeschlagen";
      }
    }
    ?>

    <div class="container-fluid bg-light">
      <div class="row">
        <div class="col">
          <h1>Überschrift</h1>
        </div>
      </div>
    </div>

    <div class="container is-fluid">
      <form  action="login.php" method="post">
        <div class="form-group">
          <div class="row mt-5 bg-warning">
            <div class="col-12">
              <h1>Login</h1><br>
              <h2>Hier kannst Du Dich einloggen.</h2>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-12 col-sm-6">
              <input class="form-control" type="text" name="username" placeholder="Username"  aria-describedby="userHelp">
              <small id="userHelp" class="form-text text-muted">Benutzernamen eintragen.</small>
            </div>
            <div class="col-12 col-sm-6">
              <input class="form-control" type="password" name="pw" placeholder="Passwort"   aria-describedby="pwHelp">
              <small id="pwHelp" class="form-text text-muted">Passwort eintragen.</small>
            </div>
          </div>
          <button type="submit" name="submit" class="btn btn-primary mt-3">Sign in</button>
        </div>
      </form>
      <div class="row">
        <div class="col">
          <a href="register.php">Noch keinen Account?</a><br>
          <a href="passwordreset.php">Hast du dein Passwor vergessen?</a>
        </div>
      </div>
    </div>

  </body>
</html>