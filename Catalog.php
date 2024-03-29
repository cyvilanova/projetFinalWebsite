<?php

/****************************************
Fichier : Catalog.php
Auteur : David Gaulin
Fonctionnalité : W7 - Consultation d'un catalogue de produit
Date : 2019-04-15
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
	 </head>
	 <body>
	 	<div class="page">
		<header>
			<?php
      if(!isset($_SESSION["username"])||$_SESSION["username"]!="admin"){
          include("nav_inv.html");
      }
      else{
        include("nav_admin.html");
      }
      ?>
		</header>

		 <section class="main-section"> <!-- Page section -->
		 	<div class="page-title-bar">
		 		<h1>Produits</h1>
		 	</div>

		 	<section class="search-section"> <!-- search section -->
		 		<div>	<!-- search bar -->
		 			<input type="text" name="search" placeholder="Rechercher ..." id="searchBar"/>
		 		</div>
		 		<p>Trier par: </p>
		 		<select name="filter" id="filter">
		 			<option disabled selected value>Sélectionner un filtre</option>
		 			<option value="name">Nom</option>
		 			<option value="price">Prix</option>
		 			<option value="quantity">Quantité</option>
		 		</select>
		 	</section>
		 	<section class="product-section"> <!-- products section -->
		 		<?php

				$ctrl->loadAllSellables();
				$_SESSION["ctrlProduct"] = serialize($ctrl);
				?>
		 	</section>
		 </section>
		</div>

	 	<script src="javascript/catalog.js"></script>

	 </body>
	 </html>
