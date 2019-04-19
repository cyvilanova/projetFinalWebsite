<?php
session_start();

include_once "phpScripts/Product/CtrlProduct.php";

$ctrl = new CtrlProduct();


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
		 	<div class="page-title-bar">
		 		<h1>Produits</h1>
		 	</div>

		 	<section class="search-section"> <!-- search section -->
		 		<div>	<!-- search bar -->
		 			<input type="text" name="search" placeholder="Rechercher ..." id="searchBar"/>
		 		</div>
		 		<p>Filtrer par: </p>
		 		<select name="filter" id="filter">
		 			<option disabled selected value>sélectionner un filtre</option>
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
	 	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
	 	integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	 	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
	 	integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	 </body>
	 </html>