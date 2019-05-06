<?php
/****************************************
Fichier : NOMDUFICHIER.php
Auteur : NOM DE L’AUTEUR
Fonctionnalité : CODE LA FONCTIONNALITÉ TRAITÉE DANS CE FICHIER ET NOM DE LA
FONCTIONNALITÉ
Date : DATE DE LA PREMIERE VERSION
Vérification :
Date Nom Approuvé
=========================================================
Historique de modifications :
Date Nom Description
=========================================================
****************************************/
  include_once "phpScripts/Shipping/CtrlShipping.php";

?>

<!DOCTYPE html>
<html lang="en">


<head>
<title>Livraisons</title>
       <?php
      if(!isset($_SESSION["username"])||$_SESSION["username"]!="admin"){
          include("nav_admin.html");
          
      }
      else{
        include("nav_inv.html");
        echo "<script> location.href='Catalog.php'</script>";
      }
      ?> 
  
   <script type="text/javascript" src="javascript/shipping.js"></script>
</head>

<body onload="shipOnLoad()">
  
  <div class="page-title-bar">
    <h1>Livraisons</h1>
  </div>

<div class="modal fade" id="modal-add-ship" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal Add product -->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Livraison</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body left">
          <form>
           <div class="form-group">
              <label for="method" class="col-form-label">Méthode </label>
              <input type="text" name="method" class="form-control" placeholder="Express" required id="method">  
            </div>

          <div class="form-group">
              <label for="company" class="col-form-label">Compagnie </label>
              <input type="text" name="company" class="form-control" placeholder="Vroom Vroom" required id="company">  
            </div>

          <div class="form-group">
              <label for="cost" class="col-form-label">Coût </label>
              <input type="text" name="cost" class="form-control" placeholder="12.99" required id="cost">  
            </div>
        </div>
        <div class="modal-footer">
 
          <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
          <button type="button" class="btn btn-default"  id="btnAdd">Ajouter</button>
          </form>
        </div>
      </div>
  </div>
</div>

 <div class="recipes-wrapper table-responsive">

  <button type="button" class="btn btn-quintessentiel" id="new-ship">Nouvelle livraison</button>
      <table class="table table-bordered table-hover">
        <thead class="thead-light">
          <tr>
            <td>#</td>
            <td>Méthode</td>
            <td>Compagnie</td>
            <td>Coût</td>
          </tr>
        </thead>
        <tbody id="products">
        <?php 
          $ctrl = new CtrlShipping();
          $ctrl->loadAllShippingTable();
        ?>
        </tbody>

      </table>

</div>

    <!-- Deletion confirmation modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Êtes-vous certain de vouloir effectuer cette action ?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-quintessentiel" onclick="confirmation()">Oui</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
