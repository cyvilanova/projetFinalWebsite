<?php
	session_start();

	include_once "../Product/CtrlProduct.php";
	if(!empty($_SESSION["ctrlProduct"]))
	{
		$ctrl = unserialize($_SESSION["ctrlProduct"]);


		//Load products
		if(isset($_POST["name"]) && isset($_POST["filter"]) && !empty($_SESSION["ctrlProduct"]))
		{	
			if($_POST["name"] == ""){
				$ctrl->loadAllProducts(1,$_POST["filter"]);	
			}
			else{
				$ctrl->loadProductsByName($_POST["name"],1,$_POST["filter"]);	
			}

			
		}

		//Next page
		if(isset($_POST["changePage"]))
		{	
			$ctrl->changePage($_POST["changePage"]);
		}	

		$_SESSION["ctrlProduct"] = serialize($ctrl);
	}


?>