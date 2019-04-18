<?php
	session_start();

	include_once "../Product/CtrlProduct.php";
	
	if(isset($_POST["name"]) && isset($_POST["filter"]) && !empty($_SESSION["ctrlProduct"]))
	{	
		$ctrl = unserialize($_SESSION["ctrlProduct"]);
		

		if($_POST["name"] == ""){
			$ctrl->loadAllProducts($_POST["filter"]);	
		}
		else{
			$ctrl->loadProductsByName($_POST["name"],$_POST["filter"]);	
		}

		$_SESSION["ctrlProduct"] = serialize($ctrl);
	}
?>