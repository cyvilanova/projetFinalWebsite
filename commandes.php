<?php

  include_once ("phpScripts/Order/CtrlOrder.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <title>Quintessentiel - Gestion des commandes clients</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">
      <img src="images/logo_h.png" alt="Quintessentiel logo" class="img-logo-nav" />
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
      aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2" id="navbarNavDropdown">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Accueil <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Produits</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Gestion
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="#">Recettes</a>
            <a class="dropdown-item" href="#">Inventaire</a>
            <a class="dropdown-item" href="#">Commandes</a>
            <a class="dropdown-item" href="#">Livraisons</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Déconnexion</a>
        </li>
      </ul>
    </div>
  </nav>
  
  <div class="page-title-bar">
    <h1>Commandes - Clients</h1>
  </div>
<div class="boutons" data-toggle="collapse">
  <div>
  	<div class="gauche">
  		<button type="button" class="btn btn-light">Nouvelle commande</button>
  	</div>
    <div class="droite">
    	<button type="button" class="btn btn-danger"><img class="btn-img" src="images/trashcan.png"></button>
   		<button type="button" class="btn btn-primary"><img class="btn-img" src="images/pencil-edit.png"></button>
    	<button type="button" class="btn btn-success"><img class="btn-img" src="images/plus-add.png"></button>
    </div>
  </div>
</div>
<br>
<div class="boutons">
	    <div class="tableau">
    	<table width="100%">
    		<thead>
    			<tr class="tab-header">
    				<th class="cases">&nbsp</th>
    				<th class="cases">No Commande</th>
    				<th class="cases">Client</th>
    				<th class="cases">Adresse</th>
    				<th class="cases">Produit</th>
    				<th class="cases">Quantité</th>
    			</tr>
    		</thead>
    		<tbody>
				<?php 
					$m = new CtrlOrder();
					$m->loadAllOrders();
				?>
    		</tbody>

    	</table>
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