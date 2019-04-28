<?php

  include_once "phpScripts/Shipping/CtrlShipping.php";
  include_once "phpScripts/Product/CtrlProduct.php";
?>

<!DOCTYPE html>
<html lang="en">


<head>

<?php include("nav_admin.html"); ?>
  <title>Quintessentiel - Gestion des commandes clients</title>
</head>

<body>
  
  <div class="page-title-bar">
    <h1>Ajouter une nouvelle commande</h1>

  </div>
  <div class="add-order">
    <form>
      <div>
        <div class="col-4 col-t-12 col-lg-4">
          <label for="name">Nom complet</label> 
          <br>
          <input type="text" name="nom" placeholder="Jonathan Blanchet">
          <br>
          <label for="tel">Téléphone</label> 
          <br>
          <input type="text" name="tel" placeholder="819-123-4567">
          <br>
          <label for="email">Courriel</label> 
          <br>
          <input type="text" name="email" placeholder="email@example.com">  
          <br>
          <label for="adresse">Adresse</label> 
          <br>
          <input type="text" name="adresse" placeholder="123 Rue des Canards">  
          <br>
          <label for="city">Ville</label> 
          <br>
          <input type="text" name="city" placeholder="Sherbrooke"> 
          <br>
          <label for="city">Province</label> 
          <br>
          <input type="text" name="city" placeholder="Québec">
        </div>
        <div class="col-8 col-t-12 col-lg-8">
          <section class="search-section"> <!-- search section -->
            <div> <!-- search bar -->
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

        </div>

    </div>
    </form>
  </div>

</body>
</html>