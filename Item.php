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
	 	<link rel="stylesheet" type="text/css" href="css/style_index.css"/>
	 	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	 	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	 	<!-- Bootstrap CSS -->
	 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
	 	integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	 </head>
	 <body>
	 	<div class="page">
		 	<header class="nav-bar"> <!-- Page header -->
				<?php include("nav_inv.html"); ?>
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