/****************************************
Fichier : shipping.js
Auteur : Catherine Bronsard
Fonctionnalité : W9 - Livraisons
Date : 30-04 CB 
Vérification :
Date Nom Approuvé
=========================================================
Historique de modifications :
Date Nom Description
03-05 CB Vérifications form + reload
=========================================================
****************************************/

let newShip = false; // Adding a new shipping ?
let currentShip;

function shipOnLoad() {
	let modAddBtn = document.getElementById("btnAdd");
	let newShipBtn = document.getElementById("new-ship");

	newShipBtn.addEventListener("click", function(e) {
		emptyForm();
		$('#modal-add-ship').modal('show');
		newShip = true;
	});

	modAddBtn.addEventListener("click", function(e) {
		e.preventDefault();
		if (newShip) {
			addShip();
		}
		else {
			editShip();
		}
		
	});
}

function reload() {
	location.reload();
}

function editShip() {
	validForm();
	$.ajax({
		url: "phpScripts\\Shipping\\CtrlShipping.php",
		type : 'POST',
		data : {
			function : 'edit',
			id_method : currentShip.cells[0],
			method : currentShip.cells[1],
			company : currentShip.cells[2],
			cost : currentShip.cells[3],
		},
    	error : function(msg) {
    		alert("Erreur lors de la modification");
    	},
    	success : function() {
    		reload();
    	},
	});
}

function validForm() {
	let texte = document.getElementById('cost').value;
	texte = text.replace(",", ".");
	document.getElementById('cost').value = texte;
}

function addShip() {
	$.ajax({
	url: "phpScripts\\Shipping\\CtrlShipping.php",
	type : 'POST',
	data : {
		function : 'add',
		method : document.getElementById('method').value,
		company : document.getElementById('company').value,
		cost : document.getElementById('cost').value,
	},
	success: function(data) {
    	alert("Livraison ajoutée"); 
    	reload();
	},
});
}

function emptyForm() {
	document.getElementById('method').value = "";
	document.getElementById('company').value = "";
	document.getElementById('cost').value = "";
}

function openModalTable(row) {
	newShip = false;
	currentShip = row;
	document.getElementById('method').value = row.cells[1].innerHTML;
	document.getElementById('company').value = row.cells[2].innerHTML;
	document.getElementById('cost').value = row.cells[3].innerHTML;
	$('#modal-add-ship').modal('show');
}

