let id_products_order = new Array();
let qty_products_order = new Array();
let method;
let newOrd = false;
let row;
let productNames = new Array();

function commandesOnLoad() {
	let newBtn = document.getElementById("new-order");

	let modAddBtn = document.getElementById("btn-add-modal");

	let modDelBtn = document.getElementById("btn-del-modal");

	let select = document.getElementById("product-order");

	for (var i = 1; i < select.options.length; i++) {
		productNames.push(select.options[i].innerHTML);
	}

	let edit = document.getElementsByClassName('order');

	for (var i = 0; i < edit.length; i++) {
		edit[i].addEventListener("click", function(argument) {
			openModalTable(this);/*
			getProductsId(this.cells[0]);
			for (var i = 0; i < id_products_order.length; i++) {
				addProductId(id_products_order[i]);
			}*/
		});
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
			editOrder(row);
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
				id : order.cells[0].innerHTML,
				clientName: order.cells[1].innerHTML,
				clientAddress : order.cells[2].innerHTML,
				clientCity : order.cells[3].innerHTML,
				clientProvince : order.cells[4].innerHTML,
				clientZip : order.cells[5].innerHTML,
				productsId : id_products_order,
				productsQty : qty_products_order,
				methodId : method,
			},
			success: function(data) {
            	console.log("FML"); // Inspect this in your console
        	},
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

	id_products_order = new Array();
	qty_products_order = new Array();
}

function productsQty() {

	for (var i = 0; i < id_products_order.length-1; i++) {
		alert(document.getElementById('products-qty-' + id_products_order[i]).value);
		qty_products_order.push(document.getElementById('products-qty-' + id_products_order[i]).value);
	}
}

function addOrder() {
	if (verifForm() && (id_products_order.length > 0)) {
		
		productsQty();
		//alert(method);
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

  addProductId(productId);
}

function addProductId(productId) {

	let html1 = '<div class=\"product-item\" id="product-order-' + productId + '"></div>';
	const html2 = '<label for=\"product\" class=\"col-form-label\">' + productNames[productId] + '</label>';
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
	openModal();
}

function openModal() {
	newOrd = true;
	$('#modal-add-orders').modal('show');
}

function openModalTable(order) {
	row = order;
	newOrd = false;

	let id = order.cells[0];
	let client = order.cells[1];
	let address = order.cells[2];
	let city = order.cells[3];
	let province = order.cells[4];
	let zip = order.cells[5];
	let state = order.cells[6];

	let modDelBtn = document.getElementById("btn-del-modal");

	modDelBtn.addEventListener("click", function(){
		deleteOrder(id.innerHTML);
	});
	
	modDelBtn.disabled = false;

	document.getElementById('client-name').value = client.innerHTML;
	document.getElementById('client-address').value = address.innerHTML;
	document.getElementById('client-city').value = city.innerHTML;
	$('#client-province').val(province.innerHTML);
	document.getElementById('client-zip').value = zip.innerHTML;

	

	$('#modal-add-orders').modal('show');
}