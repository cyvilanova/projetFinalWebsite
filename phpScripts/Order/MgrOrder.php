<?php
	/****************************************
	 Fichier : MgrOrder.php
	 Auteure : Catherine Bronsard
	 Fonctionnalité : Commandes clients
	 Date : 2019-04-18
	 Vérification :
	 Date Nom Approuvé
	 =========================================================
	 Historique de modifications :
	 Date Nom Description
	 2019-05-01 CB Modifications insert - client
	 =========================================================
	****************************************/

	require_once __DIR__ . '/../QueryEngine.php';
	require_once __DIR__ . '/../Shipping/MgrShipping.php';
	require_once __DIR__ . '/Order.php';
	require_once __DIR__ . '/../Product/Product.php';
	require_once __DIR__ . '/../Product/CtrlProduct.php';
	/**
	 * 
	 */
	class MgrOrder
	{
		
		private $shipping;
		private $query_engine;
		
		/**
		 * __construct
		 *
		 * @return void
		 */
		function __construct()
		{
			$this->shipping = new MgrShipping();
			$this->query_engine = new QueryEngine();
		}

		/**
		 * Get All Orders in an ArrayList
		 *
		 * @return void
		 */
		public function getAllOrders()
		{
			// TODO -> à refaire, pas pratique /!\
			$query = "SELECT `order`.`id_order`, `client`.`name` AS 'client_name', `client`.`address`, `client`.`city`, `client`.`province`, 
				`client`.`postal_code`, `state`.`name` as 'state_name' 
			FROM `order` 
			INNER JOIN `state` ON `order`.id_state = `state`.id_state 
			INNER JOIN `client` ON `client`.`id_client` = `order`.`id_client` 
			WHERE `state`.name != 'Fermée'";

			$resultSet = $this->query_engine->executeQuery($query);
			
			return $resultSet;
		}

		/**
		 * Add an order to the database
		 *
		 * @param  Order $order
		 * @param  int $id_client
		 * @param  int $id_method
		 */
		public function insertOrder($order, $client_infos, $id_method)
		{

			$insertClient = "INSERT INTO `client` (`id_client`, `name`, `address`, `city`, `province`, `postal_code`) VALUES (default, :name, :address, :city, :province, :postal_code)";

			$parametersClient = 
			[
				":name" => $client_infos[0],
				":address" => $client_infos[1],
				":city" => $client_infos[2],
				":province" => $client_infos[3],
				":postal_code" => $client_infos[4],
			];		

			if(!$this->query_engine->executeQuery($insertClient, $parametersClient)) {
				echo "Erreur lors de l'ajout du client";
			}

			$id_client = $this->query_engine->getLastInsertedId();

			$insertOrder = "INSERT INTO `order` (`id_client`, `id_user`, `id_state`, `id_method`, `tps`, `tvq`, `total`) VALUES (:client, 1, 2, :method, :tps, :tvq, :total)";
			

			$parametersOrders = 
			[
				":client" => $id_client,
				":method" => $id_method,
				":tps" => $this->calculateTPS($order),
				":tvq" => $this->calculateTVQ($order),
				":total" => $order->getTotal(),
			];

			if(!$this->query_engine->executeQuery($insertOrder, $parametersOrders)) {
				echo "Erreur lors de l'ajout de la commande";
			}

			$id_order = $this->query_engine->getLastInsertedId();
			$order->setId($id_order);

			$this->insertProducts($order);
		}

		/**
		 * Add products to an order in the database
		 *
		 * @param Order $order
		 */
		private function insertProducts($order)
		{
			$id_order = $this->query_engine->getLastInsertedId();
			var_dump($order);
			$qty = 0;
			foreach ($order->getProducts() as $product) {
				$insertProductOrders = "INSERT INTO `ta_order_product` (`id_order`, `id_product`, `quantity`) VALUES (:id_order, :id_product, :quantity)";
				$parametersProductOrder = 
				[
					":id_order" => $order->getId(),
					":id_product" => $product->getId(),
					":quantity" => $order->getQuantities()[$qty],
				];
				var_dump($product);
				var_dump($parametersProductOrder);
				if (!$this->query_engine->executeQuery($insertProductOrders, $parametersProductOrder)) {
					echo "Erreur lors de l'ajout des produits de la commande";
				}
				$qty++;
			}			
		}

		/**
		 * Delete an order from the database
		 *
		 * @param  int $id_order
		 */
		public function deleteOrder($id_order)
		{
			$this->deleteProducts();

			$deleteOrder = "DELETE FROM order WHERE `id_order` = :id_order";
			$parametersOrder = 
				[
					":id_order" => $id_order,
				];
			if(!$this->query_engine->executeQuery($deleteOrder, $parametersOrder)) {
				echo "Erreur lors de la suppression de la commande";
			}
		}

		/**
		 * Delete the products related to an order
		 *
		 * @param  int $id_order
		 */
		private function deleteProducts($id_order)
		{
			$deleteProducts = "DELETE FROM ta_order_product WHERE `id_order` = :id_order";
			$parametersProductOrder = 
				[
					":id_order" => $id_order,
				];
			if(!$this->query_engine->executeQuery($deleteProducts, $parametersProducts)) {
				echo "Erreur lors de la suppression des produits de la commande";
			}
			
		}

		/**
		 * Update an order to the data base
		 *
		 * @param  Order $order
		 * @param  int $id_client
		 */
		public function updateOrder($order, $id_client)
		{
			$this->deleteProducts($order->getId());

			$query = "UPDATE `order` SET `id_client` = :id_client, `tps` = :tps, `tvq` = :tvq, `total` = :total WHERE `order`.`id_order` = :id_order";
			$parametersOrders = 
			[
				"id_order" => $order->getId(),
				":id_client" => $id_client,
				":tps" => $order->calculateTPS(),
				":tvq" => $order->calculateTVQ(),
				":total" => $order->getTotal(),
			];
			if(!$this->query_engine->executeQuery($deleteOrder, $parametersOrder)) {
				echo "Erreur lors de la modification de la commande";
			}
			$this->insertProducts($order);
		}


		/**
		 * Calculate the price of an order (via the products' prices)
		 *
		 * @param  Order $order
		 */
		public function calculatePrice($order)
		{
			$order->setPrice(0);
			$total = 0;
			foreach ($order->getProducts() as $p) {
				$total .= $p->getPrice();
			}
			$order->setPrice($total);
			$this->calculateTaxes($order);
		}

		/**
		 * Calculate the taxes of an order with the price
		 *
		 * @param  Order $order
		 */
		public function calculateTaxes($order)
		{
			$taxes1 = $this->calculateTPS($order);
			$taxes2 = $this->calculateTVQ($order);

			$order->setTotal($order->getPrice() + $taxes1 + $taxes2);
			return ($taxes1+$taxes2);
		}

		/**
		 * Calculate the TPS of an order with the price
		 *
		 * @param  Order $order
		 */
		public function calculateTPS($order)
		{
			return ($order->getPrice() *  0.05);
		}

		/**
		 * Calculate the TVQ of an order with the price
		 *
		 * @param  Order $order
		 */
		public function calculateTVQ($order)
		{
			return ($order->getPrice() * 0.09975);
		}
	}	
?>

