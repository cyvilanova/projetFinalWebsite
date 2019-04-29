<?php

  include_once "phpScripts/Shipping/CtrlShipping.php";

?>

<!DOCTYPE html>
<html lang="en">


<head>

  <?php include("nav_admin.html"); ?>
  <title>Quintessentiel - Gestion des commandes clients</title>

</head>

<body>

  <div class="page-title-bar">
    <h1>Livraisons</h1>
  </div>
  <?php
  	$ctrl = new CtrlShipping();

  ?>

</body>
</html>
