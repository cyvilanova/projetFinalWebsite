<?php
include_once "../Order/CtrlOrder.php";

$order = new Order(1,[2,4,1],20,50,[1,5,2]);
//Normalement, on aurait une variable de session/POST contenant l'objet order en question

if (!empty($_POST["tokenId"]) && !empty($order)) {
	$ctrl = new CtrlOrder();
	$ctrl->makePayment($_POST["tokenId"],$order);

} else {
    echo "You do not have access to this page!";
}
