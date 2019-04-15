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
?>

<!DOCTYPE html>
<html>
<head>
	<title>Quintessentiel</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>
	<header class="nav-bar"> <!-- Page header -->
		<img src="images/logo.png" alt="Logo" />
		<nav>
			<ul>
				<li><a href="#" title="Accueil">ACCUEIL</a></li>
				<li><a href="#" title="Produits">PRODUITS</a></li>
				<li><a href="#" title="Nous joindre">NOUS JOINDRE</a></li>
			</ul>
		</nav>
	</header>
	<section> <!-- Page section -->
		<h1 class="title-bar">Produits</h1>

		<section class="search-section"> <!-- search section -->
			<div>	<!-- search bar -->
				<input type="text" name="search" placeholder="Rechercher ..." />
			</div>
			<p>Filtrer par: </p>
			<select>
				<option value="category">Catégories</option>
				<option value="name">Nom</option>
				<option value="price">Prix</option>
			</select>
		</section>
		<section class="product-section"> <!-- products section -->
			<div class="product">
				<img src="images/produitTest.png"/>
				<h2>Baume à la lavande</h2>
				<p>Un joli baume dans une jolie bouteille qui émane une fragrance douce</p>
				<p class="bottom-text"><span class="stock">En stock</span><span class="prix">12,99$</span></p>
			</div>

			<div class="product">
				<img src="images/produitTest.png"/>
				<h2>Baume à la lavande</h2>
				<p>Un joli baume dans une jolie bouteille qui émane une fragrance douce</p>
				<p class="bottom-text"><span class="stock">En stock</span><span class="prix">12,99$</span></p>
			</div>

			<div class="product">
				<img src="images/produitTest.png"/>
				<h2>Baume à la lavande</h2>
				<p>Un joli baume dans une jolie bouteille qui émane une fragrance douce</p>
				<p class="bottom-text"><span class="stock">En stock</span><span class="prix">12,99$</span></p>
			</div>

			<div class="product">
				<img src="images/produitTest.png"/>
				<h2>Baume à la lavande</h2>
				<p>Un joli baume dans une jolie bouteille qui émane une fragrance douce</p>
				<p class="bottom-text"><span class="stock">En stock</span><span class="prix">12,99$</span></p>
			</div>
			
			<div class="product">
				<img src="images/produitTest.png"/>
				<h2>Baume à la lavande</h2>
				<p>Un joli baume dans une jolie bouteille qui émane une fragrance douce</p>
				<p class="bottom-text"><span class="stock">En stock</span><span class="prix">12,99$</span></p>
			</div>
			
	</section>
	<footer class="classic-footer">
		<p>Insérez du texte ici</p>
	</footer>

</body>
</html>