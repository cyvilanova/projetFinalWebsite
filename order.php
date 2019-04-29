<?php

  include_once ("phpScripts/Order/CtrlOrder.php");
  include_once ("phpScripts/Product/CtrlProduct.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include("nav_admin.html"); ?>
  <script type="text/javascript" src="javascript/order.js"></script>
  <title>Quintessentiel - Gestion des commandes clients</title>
</head>

<body onload="commandesOnLoad()">


  

<div class="modal fade" id="modal-add" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal Add product -->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Ajouter un produit</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body left">
          <form>
            
            <label for="nb-commande"># Commande </label>
            <input type="text" name="nb-commande">
            <br>
            <label for="id-client">ID Client</label>
            <input type="text" name="id-client">
            <br>
            <label for="address">Adresse</label>
            <input type="text" name="address">
            <br>
            <label for="product">Produit</label>
            <select name="product">
              <?php
                $ctrlP = new CtrlProduct();
                $ctrlP->loadAllProductsSelect();
              ?>
            </select>
          
        </div>
        <div class="modal-footer">
 
          <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
          <button type="button" class="btn btn-default" id="btn-add-modal">Ajouter</button>
          </form>
        </div>
      </div>
  </div>
</div>

  <div class="page-title-bar">
    <h1>Commandes - Clients</h1>
  </div>
<div class="buttons" data-toggle="collapse">
  <div>
  	<div class="left">
  		<button type="button" class="btn btn-light" id="new">Nouvelle commande</button>
  	</div>
    <div class="right">
    	<button type="button" class="btn btn-danger" id="delete"><img class="btn-img" src="images/delete.png"></button>
   		<button type="button" class="btn btn-primary" id="edit"><img class="btn-img" src="images/edit.png"></button>
    	<button type="button" class="btn btn-success" id="add"><img class="btn-img" src="images/add.png"></button>
    </div>
  </div>
</div>
<br>
<div class="panel col-12 col-mb-12 col-lg-12 full">

    <div class="panel-header">
        <h3>Gestionnaire des commandes</h3>
    </div>
  <div class="panel-body">

	    <div class="inventory-manager-table">
    	<table>
    		<thead>
    			<tr>
    				<th>&nbsp</th>
    				<th>No Commande</th>
    				<th>Client</th>
    				<th>Adresse</th>
    				<th>Produit</th>
    				<th>Quantité</th>
    			</tr>
    		</thead>
    		<tbody class="orders">
				<?php 
					$m = new CtrlOrder();
					$m->loadAllOrders();
				?>
    		</tbody>

    	</table>
    </div>
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