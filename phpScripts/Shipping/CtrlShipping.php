<?php
/****************************************
Fichier : CtrlShipping.php
Auteur : Catherine Bronsard
Fonctionnalité : W9 - Gestion livraisons
Date : 2019-04-19
Vérification :
Date Nom Approuvé
=========================================================
Historique de modifications :
Date Nom Description
2019-04-31 CB Afficher livraison dans un select
=========================================================
 ****************************************/

	require_once __DIR__ . '/Shipping.php';
	require_once __DIR__ . '/MgrShipping.php';
	require_once __DIR__ . '/../QueryEngine.php';

	
if (isset($_POST['function'])) {
		switch ($_POST['function']) {
			case 'add':
				$ctrl = new CtrlShipping();
				$ctrl->addShipping($_POST['method'], $_POST['company'], $_POST['cost']);
				break;
		}
	}

	/**
	 * 
	 */
	class CtrlShipping
	{
		private $mgrshipping;
		
		/**
		 * __construct
		 */
		function __construct()
		{
			$this->mgrshipping = new MgrShipping();
		}

		public function loadAllShippingSelect()
		{
			$shippings = $this->mgrshipping->getAllShippingsMethod();

			$element = "";
			foreach ($shippings as $row) {
				$element .= "<option id=\"" . $row['id_method'] ."\" value=\"" . $row['method_name'] . "\"> " . $row['company_name'] . "-" .  $row['method_name'] . "</option>";
			}
			echo $element;
		}

		public function loadAllShippingTable()
		{
			$shippings = $this->mgrshipping->getAllShippingsMethod();

			$element = "";
			foreach ($shippings as $row) {
				$element = "<tr class=\"order\" onclick='openModalTable(this)'>";
				$element .= "<td id=\"" . $row['id_method'] . "\">". $row['id_method'] ."</td>";
				$element .= "<td id=\"" . $row['id_method'] . "\">". $row['method_name'] ."</td>";
				$element .= "<td id=\"" . $row['id_method'] . "\">". $row['company_name'] ."</td>";
				$element .= "<td id=\"" . $row['id_method'] . "\">". $row['price'] ."</td>";
				$element .= "</tr>";
				echo $element;
			}
		}

		/**
		 * Add a shipping company and a shipping method
		 *
		 * @param  string $shipping_name
		 * @param  string $method_name
		 * @param  double $price
		 */
		public function addShipping($shipping_name, $method_name, $price)
		{
			$shipping = new Shipping($shipping_name, $method_name, $price);
			$this->mgrshipping->insertShippingCompany($shipping);
			
			$id = $this->mgrshipping->getCompanyId($shipping->getCompany());

			$this->mgrshipping->insertShippingMethod($id, $method_name, $price);
		}

	}

?>

