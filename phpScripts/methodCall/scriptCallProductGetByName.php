<?php
	include_once "../CtrlProduct.php";

	if(isset($_POST["name"]) && isset($_POST["filter"]))
	{	
		$ctrlProduct = new CtrlProduct();

		if($_POST["name"] == ""){
			$ctrlProduct->loadAllProducts($_POST["filter"]);	
		}
		else{
			$ctrlProduct->loadProductsByName($_POST["name"],$_POST["filter"]);	
		}
	}
?>