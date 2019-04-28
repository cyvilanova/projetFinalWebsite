<?php

	require_once __DIR__ . '/../QueryEngine.php';
	require_once __DIR__ . '/../Shipping/MgrShipping.php';
	require_once __DIR__ . '/Order.php';
	require_once __DIR__ . '/../Product/Product.php';
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
		 * getAllOrders
		 *
		 * @return void
		 */
		public function getAllOrders()
		{
			$query = "SELECT `order`.`id_order`, `client`.`name` AS 'client_name', `client`.`address`, `product`.`name` AS 'product_name', `product`.`quantity` FROM `order` INNER JOIN `state` ON `order`.id_state = `state`.id_state INNER JOIN `client` ON `client`.`id_client` = `order`.`id_client` INNER JOIN `ta_order_product` ON `ta_order_product`.`id_order` = `order`.`id_order` INNER JOIN `product` ON `product`.`id_product` = `ta_order_product`.`id_product` WHERE `state`.name != 'closed'";

			$resultSet = $this->query_engine->executeSelect($query,[]);

			#var_dump($resultSet);

			return $resultSet;
		}

		/**
		 * insertOrder
		 *
		 * @param  mixed $order
		 * @param  mixed $id_client
		 * @param  mixed $id_method
		 *
		 * @return void
		 */
		public function insertOrder($order, $id_client, $id_method)
		{
			$insertOrder = "INSERT INTO `order` (`id_order`, `id_client`, `id_user`, `id_state`, `id_method`, `tps`, `tvq`, `total`) VALUES (DEFAULT, :client, 1, 2, :method, :tps, :tvq, :total)";

			$parametersOrders = 
			[
				":client" => $id_client,
				":method" => $id_method,
				":tps" => $order->calculateTPS(),
				":tvq" => $order->calculateTVQ(),
				":total" => $order->getTotal(),
			];


			if(!$this->query_engine->executeQuery($insertOrder, $parametersOrders)) {
				echo "Erreur lors de l'ajout de la commande";
			}

			insertProducts($order);
		}

		/**
		 * insertProducts
		 *
		 * @param  mixed $order
		 *
		 * @return void
		 */
		private function insertProducts($order)
		{
			$insertProductOrders = "INSERT INTO `ta_order_product` (`id_order`, `id_product`, `quantity`) VALUES (:id_order, id_product, :quantity)";


			$last_id = $this->query_engine->getLastInsertedId();

			foreach ($order->getProducts() as $product) {
				$parametersProductOrder = 
				[
					":id_order" => $last_id,
					":id_product" => $product->getId(),
					":quantity" => $product->getQuantity(),
				];

				if (!$this->query_engine->executeQuery($insertProductOrders, $parametersProductOrder)) {
					echo "Erreur lors de l'ajout des produits de la commande";
				}

			}			
		}

		/**
		 * deleteOrder
		 *
		 * @param  mixed $id_order
		 *
		 * @return void
		 */
		public function deleteOrder($id_order)
		{

			deleteProducts();

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
		 * deleteProducts
		 *
		 * @param  mixed $id_order
		 *
		 * @return void
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
		 * updateOrder
		 *
		 * @param  mixed $order
		 * @param  mixed $id_client
		 *
		 * @return void
		 */
		public function updateOrder($order, $id_client)
		{
			deleteProducts($order->getId());

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
			insertProducts($order);
		}
	}	
?>