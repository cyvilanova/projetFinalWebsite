<?php
	/****************************************
	 Fichier : MgrOrder.php
	 Auteure : Catherine Bronsard
	 Fonctionnalité : Commandes clients
	 Date : 2019-04-20
	 Vérification :
	 Date Nom Approuvé
	 =========================================================
	 Historique de modifications :
	 Date Nom Description
	 2019-05-01 CB Appel fonctions par JS-Ajax 
	 =========================================================
	****************************************/
	require_once __DIR__ . '/MgrOrder.php';
	require_once __DIR__ . '/Order.php';


	if (isset($_POST['function'])) {
		switch ($_POST['function']) {
			case 'addOrder':
					$ctrlO = new CtrlOrder();

					$ctrlO->addOrder(0, $_POST['productsId'], _POST['productsQty']);
				break;
			
			default:
				# code...
				break;
		}

	}

	class CtrlOrder
	{
		
		private $mgrOrder;

		/**
		 * __construct
		 */
		function __construct()
		{
			$this->mgrOrder = new MgrOrder();
		}

		/**
		 * Load all the orders on the gestionnaire
		 */
		public function loadAllOrders()
		{
			$orders = $this->mgrOrder->getAllOrders();
			
			foreach ($orders as $row) {
				
				$element = "<tr class=\"order\">";
				$element .= "<td id=\"id-order-" . $row['id_order'] . "\">" . $row['id_order'] . "</td>";
				$element .= "<td id=\"client-name-" . $row['id_order'] . "\">" . $row['client_name'] . "</td>";
				$element .= "<td id=\"address-" . $row['id_order'] . "\">" . $row['address'] . "</td>";
				$element .= "<td id=\"city-" . $row['id_order'] . "\">" . $row['city'] . "</td>";
				$element .= "<td id=\"province-" . $row['id_order'] . "\">" . $row['province'] . "</td>";
				$element .= "<td id=\"postal_code-" . $row['id_order'] . "\">" . $row['postal_code'] . "</td>";
				$element .= "<td id=\"state-name-" . $row['id_order'] . "\">" . $row['state_name'] . "</td>";
				$element .= "</tr>";
				
				echo $element;
			}
		}

		/**
		 * Add an order to the database
		 *
		 * @param  double $price
		 * @param  ArrayList of Products $products
		 * @param  ArrayList of int $quantities
		 * @param  int $id_client
		 */
		public function addOrder($price, $products, $quantities, $id_client)
		{
			$order = new Order("", $price, "", $products, $quantities);
			$this->mgrOrder->calculatePrice($order);
			
			$this->mgrOrder->insertOrder($order, $id_client, $id_method);
		}

		/**
		 * Update an order in the data base
		 *
		 * @param  int $id_order
		 * @param  int $id_client
		 * @param  ArrayList of Products $product
		 * @param  ArrayList of int $quantity
		 * @param  string $adress
		 *
		 * @return void
		 */
		public function editOrder($id_order, $id_client, $product, $quantity, $adress)
		{
			$order = new Order($id_order, "", "", $product,"");
			$this->mgrOrder->updateOrder($order, $id_client);
		}

		/**
		 * Delete an order from the database
		 *
		 * @param  int $id_order
		 */
		public function deleteOrder($id_order)
		{
			$this->mgrOrder->deleteOrder($id_order);
		}
	}
?>

