<?php
  include_once ("phpScripts/Order/CtrlOrder.php");
  include_once ("phpScripts/Product/CtrlProduct.php");
  include_once ("phpScripts/Shipping/CtrlShipping.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Commandes clients</title>

  <meta charset="UTF-8">
  <meta name="viewport" content="width = device-width, initial-scale = 1.0">
  <link href="css/style_index.css" rel=stylesheet>
  <script type="text/javascript" src="javascript/order.js"></script>
  
</head>

<body onload="commandesOnLoad()">

<?php include("nav_admin.html"); ?>
  

<div class="modal fade" id="modal-add-orders" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal Add product -->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Commande</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body left">
          <form>
           <div class="form-group">
              <label for="client" class="col-form-label">Client </label>
              <input type="text" name="client" class="form-control" placeholder="Roger Lapierre" required id="client-name">  
            </div>

          <div class="form-group">
              <label for="address" class="col-form-label">Adresse </label>
              <input type="text" name="address" class="form-control" placeholder="123 Rue de l'oranger" required id="client-address">  
            </div>

          <div class="form-group">
              <label for="city" class="col-form-label">Ville </label>
              <input type="text" name="city" class="form-control" placeholder="Sherbrooke" required id="client-city">  
            </div>

          <div class="form-group">
              <label for="zip" class="col-form-label">Code postal </label>
              <input type="text" name="zip" class="form-control" placeholder="J1N1Y9" required id="client-zip">  
          </div>

          <div class="form-group">
              <label for="province" class="col-form-label">Province </label>
              <select name="province" class="selectpicker form-control" id="client-province">
                <option value="Alberta">Alberta</option>
                <option value="Colombie-Britannique">Colombie-Britannique</option>
                <option value="Île-du-Prince-Édouard">Île-du-Prince-Édouard</option>
                <option value="Manitoba">Manitoba</option>
                <option value="Nouveau-Brunswick">Nouveau-Brunswick</option>
                <option value="Nouvelle-Écosse">Nouvelle-Écosse</option>
                <option value="Nunavut">Nunavut</option>
                <option value="Colombie-Britannique">Ontario</option>
                <option value="Québec" selected>Québec</option>
                <option value="Saskatchewan">Saskatchewan</option>
                <option value="Terre-Neuve-et-Labrador">Terre-Neuve-et-Labrador</option>
                <option value="Territoires du Nord-Ouest">Territoires du Nord-Ouest</option>
                <option value="Yukon">Yukon</option>
              </select> 
            </div>            
         <div class="form-group">
              <label for="shipping" class="col-form-label">Livraison </label>
              <select id="product-ship" name="products" class="selectpicker form-control" onchange="methodId(this)">
                <option disabled selected value>Choisir une méthode de livraison</option>
              <?php
                $ctrlL = new CtrlShipping();
                $ctrlL->loadAllShippingSelect();
              ?>
            </select>
            </div>
          <div class="form-group">
              <label for="products" class="col-form-label">Produits </label>
              <select id="product-order" name="products" class="selectpicker form-control" onchange="addProduct(this)">
                <option disabled selected value>Choisir un ou plusieurs produits</option>
              <?php
                $ctrlP = new CtrlProduct();
                $ctrlP->loadAllProductsSelect();
              ?>
            </select>
            </div>
            <div class="form-group" id="order-products">
              
            </div>
        </div>
        <div class="modal-footer">
 
          <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
          <button type="button" class="btn btn-light" id="btn-del-modal" disabled="true">Supprimer</button>
          <input type="submit" class="btn btn-default" id="btn-add-modal" value="Ajouter"/>
          </form>
        </div>
      </div>
  </div>
</div>

  <div class="page-title-bar">
    <h1>Commandes - Clients</h1>
  </div>

 <div class="recipes-wrapper table-responsive">

  <button type="button" class="btn" id="new-order">Nouvelle commande</button>
    	<table class="table table-bordered table-hover">
    		<thead class="thead-light">
    			<tr>
    				<td>#</td>
    				<td>Client</td>
    				<td>Adresse</td>
            <td>Ville</td>
            <td>Province</td>
            <td>Code postal</td>
    				<td>Statut de la commande</td>
    			</tr>
    		</thead>
    		<tbody id="products">
				<?php 
					$m = new CtrlOrder();
					$m->loadAllOrders();
				?>
    		</tbody>

    	</table>

</div>

</body>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
  integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
  integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</html>
