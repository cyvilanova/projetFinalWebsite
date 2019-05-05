let id_products_order = new Array();
let qty_products_order = new Array();
let method;
let newOrd = false;
let row;
let productNames = new Array();
let currentOrder;


function commandesOnLoad() {
	let newBtn = document.getElementById("new-order");

	let modAddBtn = document.getElementById("btn-add-modal");

	let modDelBtn = document.getElementById("btn-del-modal");

	let select = document.getElementById("product-order");

	$("#modal-add-orders").on("hidden.bs.modal", function () {
	    emptyForm();
	});

	for (var i = 1; i < select.options.length; i++) {
		productNames.push(select.options[i].innerHTML);
	}

	newBtn.addEventListener("click", function(){
		emptyForm();
		openModal();
	});

	modAddBtn.addEventListener("click", function(e){
		e.preventDefault();
		if (newOrd) {
			addOrder();
		}
		else {
			editOrder(currentOrder);
		}
		
	});
}

function getProductsId(id_order) {
	console.log(id_order);
	$.ajax({
    url:"phpScripts\\Order\\CtrlOrder.php",
    type:"POST",
    data : {
    	function : 'productsId',
    	id : id_order,
    },
    success: function(id){
        id_products_order = id;
        
        console.log(id);

        id_products_order = id.split('|');
        
    },
    error : function (data) {
    	console.log(data);
    },
    dataType:"text"
});
}

function editOrder(order) {
	
	//getProductsId(order.cells[0].innerHTML);
	

	productsQty();

	edit(order);
}

function edit(order) {
	$.ajax({
			url: "phpScripts\\Order\\CtrlOrder.php",
			type : 'POST',
			data : {
				function : 'editOrder',
				id : order.id,
				clientName: $('#client-name').val(),
				clientAddress : $('#client-address').val(),
				clientCity : $('#client-city').val(),
				clientProvince : $('#client-province').val(),
				clientZip : $('#client-zip').val(),
				clientId : order.client.id,
				productsId : id_products_order,
				productsQty : qty_products_order,
				methodId : method,
			},
			success: function(data) {
            	console.log("djsgo");
            	console.log(data);
        	},
        	error : function(data) {
        		console.log("FML")
        	}
		});	
}

function deleteOrder(id) {
	$.ajax({
			url: "phpScripts\\Order\\CtrlOrder.php",
			type : 'POST',
			data : {
				function : 'delOrder',
				id_order : id,
			},
			success: function(data) {
            	console.log(data); // Inspect this in your console
        	},
		});
}

function methodId(selected) {
	method = ($($('#product-ship').find("option")[selected.selectedIndex]).attr("id"));
}

function emptyForm() {
	document.getElementById('client-name').value = "";
	document.getElementById('client-address').value = "";
	document.getElementById('client-city').value = "";
	$('#client-province').val("Québec");
	document.getElementById('client-zip').value = "";
	console.log(id_products_order);
	for (var i = 0; i < id_products_order.length; i++) {
		deleteProduct(id_products_order[i]);
	}

	if (id_products_order.length > 0) {
		deleteProduct(id_products_order[0]);
	}
	
	id_products_order = new Array();
	qty_products_order = new Array();
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
		console.log(id_products_order.length);
		$.ajax({
			url: "phpScripts\\Order\\CtrlOrder.php",
			type : 'POST',
			data : {
				function : 'addOrder',
				clientName: $('#client-name').val(),
				clientAddress : $('#client-address').val(),
				clientCity : $('#client-city').val(),
				clientProvince : $('#client-province').val(),
				clientZip : $('#client-zip').val(),
				productsId : id_products_order,
				productsQty : qty_products_order,
				methodId : method,
			},
			success: function(data) {
            	console.log(data); // Inspect this in your console
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

function addProductId(product) {

	let html1 = '<div class=\"product-item\" id="product-order-' + product.id + '"></div>';
	const html2 = '<label for=\"product\" class=\"col-form-label\">' + product.name + '</label>';
	const html4 = '<input type=\"number\" step=\"1\" min=\"1\" lang=\"en\" class=\"form-control input-volume\" id=\"products-qty-' + product.id + '\" value=' + 
		currentOrder.quantities[0] + '>';
	const html5 = '<label class=\"col-form-label label-volume\"> items </label>';
	const deleteBtn = '<button type="button" class="btn btn-light btn-remove" id="delete-product" onclick="deleteProduct(' + product.id +')">X</button>';

	html1 = $(html1).append(html2, html4, html5, deleteBtn);
	$('#order-products').append(html1);

	id_products_order.push(product.id);
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
	document.getElementById("btn-add-modal").value = "Ajouter";
	openModal();
}

function openModal() {
	newOrd = true;
	$('#modal-add-orders').modal('show');
}

function openModalTable(order) {

	currentOrder = order;
	newOrd = false;
	
	let id = order.id;
	let client = order.client.name;
	let address = order.client.address;
	let city = order.client.city;
	let province = order.client.province;
	let zip = order.client.postalCode;
	let state = order.state;

	let modDelBtn = document.getElementById("btn-del-modal");

	modDelBtn.addEventListener("click", function(){
		deleteOrder(id.innerHTML);
	});
	

	modDelBtn.disabled = false;

	let modPaybtn = document.getElementById("btn-pay-modal");

	modPaybtn.addEventListener("click",function(e){
		e.preventDefault();
		document.location.href = "payment.php?orderId="+id;
	},false);

	document.getElementById('client-name').value = client;
	document.getElementById('client-address').value = address;
	document.getElementById('client-city').value = city;
	$('#client-province').val(province);
	document.getElementById('client-zip').value = zip;

	for (var i = 0; i < order.products.length; i++) {
		addProductId(order.products[i][0]);
	}

	document.getElementById("btn-add-modal").value = "Sauvegarder";

	$('#modal-add-orders').modal('show');
	
	//console.log(order.products[0][0]);
}


