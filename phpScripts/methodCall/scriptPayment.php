<?php
include_once "../Order/CtrlOrder.php";


if (!empty($_POST["tokenId"]) && !empty($_POST["orderId"])) {
	$ctrl = new CtrlOrder();
	$ctrl->makePayment($_POST["tokenId"],$_POST["orderId"]);

} else {
    echo "You do not have access to this page!";
}
