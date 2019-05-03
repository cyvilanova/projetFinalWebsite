<?php
include_once "../Order/CtrlOrder.php";

$order = 1; //Order id

if (!empty($_POST["tokenId"]) && !empty($order)) {
	$ctrl = new CtrlOrder();
	$ctrl->makePayment($_POST["tokenId"],$order);

} else {
    echo "You do not have access to this page!";
}
