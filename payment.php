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
?>
<!DOCTYPE html>
<html>
<head>
	<title>Paiement</title>
	<meta charset="utf-8"/>
	<script src="https://js.stripe.com/v3/"></script>
</head>
<body>
	<header>
		<?php include("nav_admin.html"); ?>
	</header>
	<section>
		<div class="page-title-bar">
		 	<h1>Paiement</h1>
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
		 	<div class="form-row">
		 		<input type="text" name="firstName" id="firstName"/>
		 		<label for="firstName">
		 			Prénom
		 		</label>
		 	</div>
		 	<div class="form-row">
		 		<input type="text" name="lastName" id="lastName"/>
		 		<label for="lastName">
		 			Nom
		 		</label>
		 	</div>
		 	<div class="form-row">
		 		<input type="text" name="address" id="address"/>
		 		<label for="address">
		 			Adresse
		 		</label>
		 	</div>
		 	<div class="form-row">
		 		<input type="text" name="city" id="city"/>
		 		<label for="city">
		 			Ville
		 		</label>
		 	</div>
		 	<div class="form-row">
		 		<select id="province">
		 			<option selected disabled hidden></option>
		 			<option value="qc">Québec</option>
		 			<option value="on">Ontario</option>
		 			<option value="ma">Manitoba</option>
		 			<option value="sa">Saskatchewan</option>
		 			<option value="al">Alberta</option>
		 			<option value="cb">Colombie Britanique</option>
		 		</select>
		 		<label for="province">
		 			Province
		 		</label>
		 	</div>
		 	<div class="form-row">
		 		<input type="text" id="postalCode"/>
		 		<label for="postalCode">
		 			Code postal
		 		</label>
		 	</div>


		 	<button id="btnConfirm">Soumettre le paiement</button>
		 </form>
	</section>

	<script>
		const stripe = Stripe('pk_test_EqumhjKd2yDQpLAkL0FfffWO00zbR2Knni');
		const elements = stripe.elements();

		const card = elements.create('card',{
		  hidePostalCode: true,
		  style: {
		    base: {
		      fontSize: '20px',

		    },
		  }
		});


		card.mount("#card-element");

		/*
			Displays errors about the card infos entered
		*/
		card.addEventListener('change', ({error}) => {
		  const displayError = document.getElementById('card-errors');
		  if (error) {
		    displayError.textContent = error.message;
		  } else {
		    displayError.textContent = '';
		  }
		});

		/* Makes the ajax call if the token
			has been successfully created
		*/
		function tokenCreated(result){

		  if (result.token) {	//If it worked

		  	let form = document.getElementsByTagName("form")[0];

		  	$.ajax({	//Call the payment script
	 			type: "POST",
	 			url: "phpScripts/methodCall/scriptPayment.php",
	 			data: {
	 				tokenId: result.token.id,
	 				firstName: document.getElementById("firstName").value,
	 				lastName: document.getElementById("lastName").value,
	 				address: document.getElementById("address").value,
	 				city: document.getElementById("city").value,
	 				province: document.getElementById("province").value,
	 				postalCode: document.getElementById("postalCode").value,
	 			},
	 			success: function(output) {
                    displayFormMessage(output);
                }
	 		});

		  	form.reset();
		  	card.clear();

		  } else if (result.error) { //If it didn't
			displayFormMessage("<span class='payment-error'>Erreur lors de la tentative du paiement</span>");
		  }
		}

		
		/* Detects the click on the confirm button */
		document.getElementById("btnConfirm").addEventListener("click",function(e){
			e.preventDefault();
			if(formNotEmpty()){
				stripe.createToken(card).then(tokenCreated);
			}
			else{
				displayFormMessage("<span class='payment-error'>Veuillez remplir tout les champs</span>");
			}
		});

		/*
			Check if the form is empty
			and returns a bool
		*/
		function formNotEmpty(){

			let form = document.getElementsByTagName("form")[0];
			let input = form.getElementsByTagName("input");
			let select = document.getElementById("province");

			if(select.options[select.selectedIndex].value == ""){
				return false;
			}

			for(let i = 1;i < input.length;i++) //Starts at 1 because of Stripe input
			{	
				if(input[i].value == ""){
					return false;
				}
			}

			return true;
		}

		/*
			Displays a message in the form message area
		*/
		function displayFormMessage(message){
			let paymentState = document.getElementById("payment-state");
			paymentState.innerHTML = message;
		}
		
	</script>
</body>
</html>