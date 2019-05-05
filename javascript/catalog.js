let searchBar = document.getElementById("searchBar");
let filterSelect = document.getElementById("filter");
let productSection = document.getElementsByClassName("product-section")[0];
let selectedFilter = null;
let searchText = "";

//Ajax for the search bar
searchBar.addEventListener("keyup",function(){
	loadProducts();
},false);

filterSelect.addEventListener("change",function(){
	loadProducts();
},false);

//Calls the script via Ajax
function loadProducts(){
	changeSelectedFilter();
	changeSelectedText();

	$.ajax({
		type: "POST",
		url: "phpScripts/methodCall/scriptCatalog.php",
		data: {name: searchText,
			   filter: selectedFilter,
			},
		success: function(output) {
          productSection.innerHTML = output;
      	}
	});
}

function changePage(pageNumber){

	$.ajax({
		type: "POST",
		url: "phpScripts/methodCall/scriptCatalog.php",
		data: {changePage: pageNumber
			},
		success: function(output) {
          productSection.innerHTML = output;
      	}
	});
}

//Changes the selected filter variable
function changeSelectedFilter(){
	selectedFilter = filter[filter.selectedIndex].value;
}

//Changes the selected text variable
function changeSelectedText(){
	searchText = searchBar.value;
}