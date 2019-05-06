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
			orderId: orderId,
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
	stripe.createToken(card).then(tokenCreated);
});


/*
	Displays a message in the form message area
*/
function displayFormMessage(message){
	let paymentState = document.getElementById("payment-state");
	paymentState.innerHTML = message;
}