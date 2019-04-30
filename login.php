<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width = device-width, initial-scale = 1.0">
  <link href="css/style_index.css" rel=stylesheet>
  <title>Connexion</title>
</head>

<body>
  <?php include("nav_inv.html"); ?>

  <div class="page-title-bar">
    <h1>Connexion</h1>
  </div>
  <div class="login-container">
    <div class="loginConnect">
      <form action="phpScripts/User/MgrLogin.php" method="post">
        <label for="uname" >Nom d'utilisateur:</label>
        <input type="text" name="uname" required="required" pattern="[A-Za-z0-9]{1,20}">
        <label for="pwd">Mot de passe:</label>
        <input type="password" name="pwd" required="required" pattern="[A-Za-z0-9]{1,20}">
        <input type="submit" value="Se connecter">
      </form>

    </div>
  </div>

</body>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
  integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
  integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</html>
