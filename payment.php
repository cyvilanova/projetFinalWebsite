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

		card.addEventListener('change', ({error}) => {
		  const displayError = document.getElementById('card-errors');
		  if (error) {
		    displayError.textContent = error.message;
		  } else {
		    displayError.textContent = '';
		  }
		});

		function tokenCreated(result){

		  if (result.token) {	//If it worked

		  	let form = document.getElementsByTagName("form")[0];
		  	let input = document.createElement("input");
		  	input.name = "value";
		  	input.value = result.token.id;
		  	form.append(input);

		  	form.submit();

		  } else if (result.error) { //If it didn't
			console.log("error");
		  }
		}

		
		document.getElementById("btnConfirm").addEventListener("click",function(e){
			e.preventDefault();

			/*
			Might get deleted -- Not sure yet
			const options = {
				name: document.getElementById("firstName").value + " " + document.getElementById("lastName").value,
				address: document.getElementById("address").value,
				city: document.getElementById("city").value,
				province: document.getElementById("province").value,
				postalCode: document.getElementById("postalCode").value
			};
			*/

			stripe.createToken(card).then(tokenCreated)
		});
	</script>
</body>
</html>