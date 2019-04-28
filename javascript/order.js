

function commandesOnLoad() {
	let deleteBtn = document.getElementById("delete");
	let editBtn = document.getElementById("edit");
	let addBtn = document.getElementById("add");
	let newBtn = document.getElementById("new");

	let modAddBtn = document.getElementById("btn-add-modal");

	addBtn.addEventListener("click", function(){
		showAddOrder();
	});

	editBtn.addEventListener("click", function(){
		showEditOrder(1);
	});

	deleteBtn.addEventListener("click", function(){
		showDeleteOrder(1);
	});
	
	newBtn.addEventListener("click", function(){
		showNewOrder();
	});

	modAddBtn.addEventListener("click", function(){
		addOrder();
	});
}

function addOrder() {
	
}

function showAddOrder() 
{
	$('#modal-add').modal('show');
}

function showEditOrder(idOrder) 
{
	$('#modal-edit').modal('show');
}

function showDeleteOrder(idOrder) 
{
	$('#modal-delete').modal('show');
}

function showNewOrder() 
{
	window.open("addOrder.php");
}