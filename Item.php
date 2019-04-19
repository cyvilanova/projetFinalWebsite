<?php
/****************************************
Fichier : Item.php
Auteur : David Gaulin
Fonctionnalité : W7 - Consultation d'un catalogue de produit
Date : 2019-04-19
Vérification :
Date Nom Approuvé
=========================================================
Historique de modifications :
Date Nom Description
=========================================================
 ****************************************/

session_start();

include_once "phpScripts/Product/CtrlProduct.php";

$ctrl = new CtrlProduct();

?>

	 <!DOCTYPE html>
	 <html>
	 <head>
	 	<title>Quintessentiel</title>
	 	<meta charset="utf-8"/>
	 	<link rel="stylesheet" type="text/css" href="css/style.css"/>
	 	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	 	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	 	<!-- Bootstrap CSS -->
	 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
	 	integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	 </head>
	 <body>
	 	<div class="page">
		 	<header class="nav-bar"> <!-- Page header -->
		 		<nav class="navbar navbar-expand-lg navbar-light bg-light">
		 			<a class="navbar-brand" href="#">
		 				<img src="images/logo.png" alt="Quintessentiel logo" class="img-logo-nav" />
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
		 				<li class="nav-item">
		 					<a class="nav-link" href="#">Nous joindre</a>
		 				</li>
		 			</ul>
		 		</div>
		 	</nav>
		 </header>
		 <section class="main-section"> <!-- Page section -->
		 	<?php
		 		if(!empty($_GET["productId"])){
		 			$ctrl -> loadProductById($_GET["productId"]);
		 		}
		 	?>


		 </section>
		 <footer class="classic-footer">
		 		<p>Insérez du texte ici</p>
		 </footer>
		</div>

	 	<script>

	 	</script>
	 	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
	 	integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	 	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
	 	integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	 </body>
	 </html>