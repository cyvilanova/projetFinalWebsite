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
	 05-02 David Gaulin Ajout de la fonction de paiement
     05-01 CB Appel fonctions par JS-Ajax 
	 =========================================================
	****************************************/
	require_once __DIR__ . '/MgrOrder.php';
	require_once __DIR__ . '/Order.php';
	require_once __DIR__ . '/../Product/MgrProduct.php';	

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
				$client = new Client($_POST['clientAddress'], $_POST['clientCity'], $_POST['clientName'], $_POST['clientZip'], $_POST['clientProvince'], $_POST['clientId']);

				$ctrlO->editOrder($_POST['id'], $client, $_POST['productsId'], $_POST['productsQty']);
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
			//var_dump($orders);
			foreach ($orders as $order) {
				
				$element = "<tr class=\"order\" onclick='openModalTable(" . json_encode($order, JSON_HEX_APOS, JSON_HEX_QUOT) . ")'>";
				$element .= "<td id=\"id-order-" . $order->getId() . "\">" . $order->getId() . "</td>";
				$element .= "<td id=\"client-name-" . $order->getId() . "\">" . $order->getClient()->getName() . "</td>";
				$element .= "<td id=\"address-" . $order->getId() . "\">" . $order->getClient()->getAddress() . "</td>";
				$element .= "<td id=\"city-" . $order->getId() . "\">" . $order->getClient()->getCity() . "</td>";
				$element .= "<td id=\"province-" . $order->getId() . "\">" . $order->getClient()->getProvince() . "</td>";
				$element .= "<td id=\"postal_code-" . $order->getId() . "\">" . $order->getClient()->getPostalCode() . "</td>";
				$element .= "<td id=\"state-name-" . $order->getId() . "\">" . $order->getState() . "</td>";


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
			
			var_dump($quantities);
			$order = new Order("", $client, $price, "", $products, $quantities, 'Ouverte');
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
		public function editOrder($id_order, $client, $product, $quantity)
		{
			$products = [];
			var_dump($product);
			foreach ($product as $id) {
				var_dump($id);
				$this->mgrProduct->getProductById($id);
				array_push($products, $this->mgrProduct->getProduct()[0]);
			}

			$order = new Order($id_order, $client, "", "", $products, $quantity, "Ouverte");
			var_dump(($order->getProducts()));
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
			/*$id = json_encode($this->mgrOrder->getProductsId($id_order));
			echo $id;
			return $id;*/
		}
	
    /**
     * Makes a payment via the stripe API
     *
     * @param $tokenId Id of the user's token
     * @param $order order object
     */
    public function makePayment($tokenId, $orderId)
    {

        try{
            $price = $this->mgrOrder->getTotalById($orderId);
            $response = $this->mgrOrder->makePayment($tokenId, $price);


            switch ($response) {
                case 1: //Worked perfectly
                    echo "<span class='payment-success'>Paiement effectué!</span>";
                    break;
                case 2:
                    echo "<span class='payment-error'>Carte refusée!</span>";
                    break;
                case 3:
                    echo "<span class='payment-error'>Erreur lors de la tentative de paiement.</span>";
                    break;
            }
        }
        catch(Exception $e){ //Cannot load total
            echo $e;
        }
    }
}

?>