let id_products_order = new Array();
let qty_products_order = new Array();

function commandesOnLoad() {
	let newBtn = document.getElementById("new-order");

	let modAddBtn = document.getElementById("btn-add-modal");

	let edit = document.getElementsByClassName('order');

	for (var i = 0; i < edit.length; i++) {
		edit[i].addEventListener("click", function(argument) {
			openModalTable(this);
		});
	}

	newBtn.addEventListener("click", function(){
		openModal();
	});

	modAddBtn.addEventListener("click", function(e){
		e.preventDefault();
		addOrder();
	});

}

function emptyForm() {
	// body...
}

function productsQty() {
	for (var i = 0; i < id_products_order.length; i++) {
		alert(document.getElementById('products-qty-' + id_products_order[i]).value);
		qty_products_order.push(document.getElementById('products-qty-' + id_products_order[i]).value);
	}
}

function addOrder() {
	if (verifForm() && (id_products_order.length > 0)) {
		
		productsQty();

		$.ajax({
			url: "phpScripts\\Order\\CtrlOrder.php",
			type : 'POST',
			data : {
				function : 'addOrder',
				clientName: $('#client-name').val(),
				clientAddress : $('#client-address').val(),
				clientCity : $('#client-city').val(),
				clientProvince : $('#client-province').val(),
				productsId : id_products_order,
				productsQty : qty_products_order,
			},
			success: function(data) {
            alert(data); // Inspect this in your console
        },
		});
	}
	else {
		alert("Il y a des erreurs dans le formulaire.");
	}
}

function verifForm() {
	return true;
}

function addProduct(selected) {

  const productId = ($($('#product-order').find("option")[selected.selectedIndex]).attr("id"));

  let html1 = '<div class=\"product-item\" id="product-order-' + productId + '"></div>';
  const html2 = '<label for=\"product\" class=\"col-form-label\">' + $('#product-order').val() + '</label>';
  const html4 = '<input type=\"number\" step=\"1\" min=\"1\" lang=\"en\" class=\"form-control input-volume\" id=\"products-qty-' + productId + '\" value=1>';
  const html5 = '<label class=\"col-form-label label-volume\"> items </label>';
  const deleteBtn = '<button type="button" class="btn btn-light btn-remove" id="delete-product" onclick="deleteProduct(' + productId +')">X</button>';

  html1 = $(html1).append(html2, html4, html5, deleteBtn);
  $('#order-products').append(html1);

  id_products_order.push(productId);

}

function deleteProduct(id_product) {
	document.getElementById("product-order-" + id_product).remove();

	for (var i = 0; i < id_products_order.length; i++) {
		if (id_products_order[i] == id_product) {
			id_products_order.splice(i, 1);
		}
	}
}



function showNewOrder() 
{
	//window.open("addOrder.php");
	openModal();
}

function openModal() {
	$('#modal-add-orders').modal('show');
}

function openModalTable(order) {
	let modal = $('#modal-edit-orders');
	let id = order.cells[0];
	let client = order.cells[1];
	let address = order.cells[2];
	let state = order.cells[3];


	$('#modal-edit-orders').modal('show');

}