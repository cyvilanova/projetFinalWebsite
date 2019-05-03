<?php
include_once "../Order/CtrlOrder.php";

$ctrl = new CtrlOrder();

if (!empty($_POST["tokenId"]) && !empty($_POST["orderId"]) && $ctrl->isIdValid($_POST["orderId"])){
	
	
	if($ctrl->makePayment($_POST["tokenId"],$_POST["orderId"])){ //If payment worked
		$ctrl->changeOrderStateById($_POST["orderId"]);
	}

} else {
    echo "You do not have access to this page!";
}
