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
		
		function __construct()
		{
			$this->shipping = new MgrShipping();
			$this->query_engine = new QueryEngine();
		}

		public function getAllOrders()
		{
			$query = "SELECT `order`.`id_order`, `client`.`name` AS 'client_name', `client`.`address`, `product`.`name` AS 'product_name', `product`.`quantity` FROM `order` INNER JOIN `state` ON `order`.id_state = `state`.id_state INNER JOIN `client` ON `client`.`id_client` = `order`.`id_client` INNER JOIN `ta_order_product` ON `ta_order_product`.`id_order` = `order`.`id_order` INNER JOIN `product` ON `product`.`id_product` = `ta_order_product`.`id_product` WHERE `state`.name != 'closed'";

			$resultSet = $this->query_engine->executeSelect($query,[]);

			#var_dump($resultSet);

			return $resultSet;
		}

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

			$insertProductOrders = "INSERT INTO `ta_order_product` (`id_order`, `id_product`) VALUES (:id_order, id_product)";


			$last_id = $this->query_engine->getLastInsertedId();

			foreach ($order->getProducts() as $product) {
				$parametersProductOrder = 
				[
					":id_order" => $last_id,
					":id_product" => $product,
				];

				if (!$this->query_engine->executeQuery($insertProductOrders, $parametersProductOrder)) {
					echo "Erreur lors de l'ajout des produits de la commande";
				}

			}


		}

		public function deleteOrder($id_order)
		{
			$query = "";
		}


		public function updateOrder($order = "", $id_order)
		{
			$query = "";
		}
	}	
?>