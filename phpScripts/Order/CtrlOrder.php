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
	require_once __DIR__ . '\..\Product\MgrProduct.php';	

	if (isset($_POST['function'])) {
		switch ($_POST['function']) {
			case 'addOrder':
					$ctrlO = new CtrlOrder();
					$client = array($_POST['clientName'], $_POST['clientAddress'], $_POST['clientCity'], $_POST['clientProvince'], $_POST['clientZip']);
					$ctrlO->addOrder(0, $_POST['productsId'], $_POST['productsQty'], $_POST['methodId'], $client);
				break;
			case 'delOrder':
				$ctrlO = new CtrlOrder();
				$ctrlO->deleteOrder($_POST['id_order']);

				break;
			case 'editOrder':
				$ctrlO = new CtrlOrder();
				$client = array($_POST['clientName'], $_POST['clientAddress'], $_POST['clientCity'], $_POST['clientProvince'], $_POST['clientZip']);
				//$ctrlO->editOrder();
				break;
			case 'productsId':
					$ctrlO = new CtrlOrder();
					$ctrlO->getProducts($_POST['id']);
				break;
		}

	}

	class CtrlOrder
	{
		
		private $mgrOrder;
		private $mgrProduct;

		/**
		 * __construct
		 */
		function __construct()
		{
			$this->mgrOrder = new MgrOrder();
			$this->mgrProduct = new MgrProduct();
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
		public function addOrder($price, $products_id, $quantities, $id_method, $client)
		{
			$products = [];
			foreach ($products_id as $id) {
				$this->mgrProduct->getProductById($id);
				array_push($products, $this->mgrProduct->getProduct()[0]);
			}
			

			$order = new Order("", $price, "", $products, $quantities);
			$this->mgrOrder->calculatePrice($order);

			$this->mgrOrder->insertOrder($order, $client, $id_method);
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
		public function editOrder($id_order, $client, $product, $quantity, $adress)
		{
			$order = new Order($id_order, "", "", $product,"");
			$this->mgrOrder->updateOrder($order, $client);
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


		public function getProducts($id_order)
		{
			$id = json_encode($this->mgrOrder->getProductsId($id_order));
			echo $id;
			return $id;
		}
	}
?>

