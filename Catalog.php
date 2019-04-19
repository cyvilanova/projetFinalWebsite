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
	<title>Quintessentiel - Catalogue des produits</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
	<header>

		<?php include("nav_inv.html"); ?>

	</header>

	<section>

		<!-- Page section -->
		<div class="page-title-bar">
			<h1>Produits</h1>
		</div>

		<section class="search-section">

			<!-- search section -->
			<div>
				<!-- search bar -->
				<input type="text" name="search" placeholder="Rechercher ..." id="searchBar" />
			</div>
			<p>Filtrer par: </p>
			<select name="filter" id="filter">
				<option disabled selected value>sélectionner un filtre</option>
				<option value="name">Nom</option>
				<option value="price">Prix</option>
				<option value="quantity">Quantité</option>
			</select>
		</section>

		<section class="product-section">

			<!-- products section -->
			<?php

			$ctrl->loadAllProducts();
			$_SESSION["ctrlProduct"] = serialize($ctrl);
			?>

		</section>

		<script>
			let searchBar = document.getElementById("searchBar");
			let filterSelect = document.getElementById("filter");
			let productSection = document.getElementsByClassName("product-section")[0];
			let selectedFilter = null;
			let searchText = "";

			//Ajax for the search bar
			searchBar.addEventListener("keyup", function() {
				loadProducts();
			}, false);

			filterSelect.addEventListener("change", function() {
				loadProducts();
			}, false);

			//Calls the script via Ajax
			function loadProducts() {
				changeSelectedFilter();
				changeSelectedText();

				$.ajax({
					type: "POST",
					url: "phpScripts/methodCall/scriptCallProductGetByName.php",
					data: {
						name: searchText,
						filter: selectedFilter,
					},
					success: function(output) {
						productSection.innerHTML = output;
					}
				});
			}

			function changePage(pageNumber) {
				console.log("ici.....")
				$.ajax({
					type: "POST",
					url: "phpScripts/methodCall/scriptCallProductGetByName.php",
					data: {
						changePage: pageNumber
					},
					success: function(output) {
						productSection.innerHTML = output;
					}
				});
			}

			//Changes the selected filter variable
			function changeSelectedFilter() {
				selectedFilter = filter[filter.selectedIndex].value;
			}

			//Changes the selected text variable
			function changeSelectedText() {
				searchText = searchBar.value;
			}
		</script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>