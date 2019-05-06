<?php
/****************************************
Fichier : payment.php
Auteure : David Gaulin
Fonctionnalité : Paiement en ligne
Date : 2019-04-29
Vérification :
Date Nom Approuvé
=========================================================
Historique de modifications :
Date Nom Description
=========================================================
 ****************************************/

include_once ("phpScripts/Order/CtrlOrder.php");
$ctrl = new CtrlOrder();

if(!empty($_GET["orderId"]) && $ctrl->isIdValid($_GET["orderId"]))
{

?>
<!DOCTYPE html>
<html>
<head>
	<title>Paiement</title>
	<meta charset="utf-8"/>
	<script src="https://js.stripe.com/v3/"></script>
	<script>let orderId = <?php echo $_GET["orderId"]; ?></script>
</head>
<body>
	<header>
		<?php include("nav_admin.html"); ?>
	</header>
	<section>
		<div class="page-title-bar">
		 	<h1>Paiement</h1>
		</div>
		<div class="infos-client">
			<p>Numéro de commande: #<?php echo $_GET["orderId"] ?></p>
			<p>Prix: <?php echo $ctrl->getTotalById($_GET["orderId"]) ?></p></p>
		</div>

		 <p id="payment-state"></p>
		 <form class="payment-form" action="phpScripts/methodCall/scriptPayment.php" method="POST">
		 	<div class="form-row">
		 		<label for="card-element">
		 			Carte de crédit ou de débit
		 		</label>
		 		<div id="card-element">
		 			<!-- Un élément stripe sera inséré ici -->
		 		</div>

		 		<div id="card-errors" role="alert"></div>
		 	</div>


		 	<button id="btnConfirm">Soumettre le paiement</button>
		 </form>
		 <p class="link-previous"><a href="Order.php">Retour aux commandes</a></p>
	</section>

	<script src="javascript/payment.js"></script>
</body>
</html>

<?php
}
else{
	echo "Vous n'avez pas accès à cette page!";
}
?>