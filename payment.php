<!DOCTYPE html>
<html>
<head>
	<title>Paiement</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
	<script src="https://js.stripe.com/v3/"></script>
</head>
<body>
	<header>
		<!-- La nav bar n'est pas la temporairement puisque son style brise le form de Stripe.. -->
		<?php include("nav_inv.html"); ?>
	</header>
	<section>
		<div class="page-title-bar">
		 	<h1>Paiement</h1>
		 </div>

		 <form class="payment-form" action="" method="POST">
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
		 		<label for="firstName">
		 			Prénom
		 		</label>
		 		<input type="text" name="firstName" id="firstName"/>
		 	</div>
		 	<div class="form-row">
		 		<label for="lastName">
		 			Nom de famille
		 		</label>
		 		<input type="text" name="lastName" id="lastName"/>
		 	</div>
		 	<div class="form-row">
		 		<label for="address">
		 			Adresse
		 		</label>
		 		<input type="text" name="address" id="address"/>
		 	</div>
		 	<div class="form-row">
		 		<label for="city">
		 			Ville
		 		</label>
		 		<input type="text" name="city" id="city"/>
		 	</div>
		 	<div class="form-row">
		 		<label for="province">
		 			Province
		 		</label>
		 		<select id="province">
		 			<option value="qc">Québec</option>
		 			<option value="on">Ontario</option>
		 			<option value="ma">Manitoba</option>
		 			<option value="sa">Saskatchewan</option>
		 			<option value="al">Alberta</option>
		 			<option value="cb">Colombie Britanique</option>
		 		</select>
		 	</div>
		 	<div class="form-row">
		 		<label for="postalCode">
		 			Code postal
		 		</label>
		 		<input type="text" id="postalCode"/>
		 	</div>


		 	<button id="btnConfirm">Soumettre le paiement</button>
		 </form>
	</section>
	<footer class="classic-footer">
		<p>Insérez du texte ici</p>
	</footer>

	<script>
		const stripe = Stripe('pk_test_EqumhjKd2yDQpLAkL0FfffWO00zbR2Knni');
		const elements = stripe.elements();

		const card = elements.create('card',{
		  hidePostalCode: true,
		  style: {
		    base: {
		      fontSize: '15px',
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
		  	console.log(result.token);
		    // In a real integration, you'd submit the form with the token to your backend server
		    //var form = document.querySelector('form');
		    //form.querySelector('input[name="token"]').setAttribute('value', result.token.id);
		    //form.submit();
		  } else if (result.error) { //If it didn't
			console.log("error");
		  }
		}

		
		document.getElementById("btnConfirm").addEventListener("click",function(e){
			e.preventDefault();


			const options = {
				name: document.getElementById("firstName").value + " " + document.getElementById("lastName").value,
				address: document.getElementById("address").value,
				city: document.getElementById("city").value,
				province: document.getElementById("province").value,
				postalCode: document.getElementById("postalCode").value
			};

			stripe.createToken(card,options).then(test)
		});

	</script>
</body>
</html>