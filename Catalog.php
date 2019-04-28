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
			<?php include("nav_inv.html"); ?>
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

				$ctrl->loadAllProducts();
				$_SESSION["ctrlProduct"] = serialize($ctrl);
				?>
		 	</section>
		 	<footer class="classic-footer">
		 		<p>Insérez du texte ici</p>
		 	</footer>
		 </section>
		</div>

	 	<script>

	 		let searchBar = document.getElementById("searchBar");
	 		let filterSelect = document.getElementById("filter");
	 		let productSection = document.getElementsByClassName("product-section")[0];
	 		let selectedFilter = null;
	 		let searchText = "";

	 		//Ajax for the search bar
	 		searchBar.addEventListener("keyup",function(){
	 			loadProducts();
	 		},false);

	 		filterSelect.addEventListener("change",function(){
	 			loadProducts();
	 		},false);

	 		//Calls the script via Ajax
	 		function loadProducts(){
	 			changeSelectedFilter();
	 			changeSelectedText();

	 			$.ajax({
	 				type: "POST",
	 				url: "phpScripts/methodCall/scriptCatalog.php",
	 				data: {name: searchText,
	 					   filter: selectedFilter,
	 					},
	 				success: function(output) {
                      productSection.innerHTML = output;
                  	}
	 			});
	 		}

	 		function changePage(pageNumber){
	 			
	 			$.ajax({
	 				type: "POST",
	 				url: "phpScripts/methodCall/scriptCatalog.php",
	 				data: {changePage: pageNumber
	 					},
	 				success: function(output) {
                      productSection.innerHTML = output;
                  	}
	 			});
	 		}

	 		//Changes the selected filter variable
	 		function changeSelectedFilter(){
	 			selectedFilter = filter[filter.selectedIndex].value;
	 		}

	 		//Changes the selected text variable
	 		function changeSelectedText(){
	 			searchText = searchBar.value;
	 		}
	 	</script>

	 </body>
	 </html>