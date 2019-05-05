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
05-02 David Gaulin Ajout de la fonction de paiement
=========================================================
 ****************************************/

require_once __DIR__ . '/../QueryEngine.php';
require_once __DIR__ . '/../Shipping/MgrShipping.php';
require_once __DIR__ . '/Order.php';
require_once __DIR__ . '/../Product/Product.php';
require_once __DIR__ . '/../Product/CtrlProduct.php';
require_once __DIR__ . '/../Product/MgrProduct.php';
require_once __DIR__ . '/../Client/Client.php';
require_once __DIR__ . '/../Stripe/init.php';
/**
 *
 */
class MgrOrder
{

    private $shipping;
    private $query_engine;
    private $mgrProduct;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->shipping = new MgrShipping();
        $this->query_engine = new QueryEngine();
        $this->mgrProduct = new MgrProduct();
    }

    /**
     * Get All Orders in an ArrayList
     *
     * @return void
     */
    public function getAllOrders()
    {
        // TODO -> à refaire, pas pratique /!\
        $query = "SELECT `order`.`id_order`, `order`.`total`, `order`.`id_method`,`client`.`id_client`, `client`.`name` as 'client_name', client.address, client.city, client.province, client.postal_code, state.name as 'state_name' FROM `order` INNER JOIN `state` ON `order`.id_state = `state`.id_state INNER JOIN `client` ON `client`.`id_client` = `order`.`id_client` INNER JOIN `shipping_method` ON `shipping_method`.`id_method` = `order`.`id_method` WHERE `state`.name != 'Fermée'";

			$resultSet = $this->query_engine->executeQuery($query);
			
			$orders = $this->resultToArray($resultSet);

			return $orders;
		}

		public function resultToArray($resultSet)
		{
			$orders = [];
			foreach ($resultSet as $row) {

				$order = new Order(
					$row['id_order'],
					new Client(
						$row['address'],
						$row['city'],
						$row['client_name'],
						$row['postal_code'],
						$row['province'],
						$row['id_client']
					),
					"",
					$row['total'],
					$this->getProductsId($row['id_order']),
					$this->getProductsQty($row['id_order']),
					$row['state_name']
				);
				array_push($orders, $order);
			}
			
			return $orders;
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

			#var_dump($order);
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
			$this->deleteProducts($id_order);

			$deleteOrder = "DELETE FROM `order` WHERE `id_order` = :id_order";
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
			if(!$this->query_engine->executeQuery($deleteProducts, $parametersProductOrder)) {
				echo "Erreur lors de la suppression des produits de la commande";
			}
			
		}

		/**
		 * Update an order to the data base
		 *
		 * @param  Order $order
		 * @param  int $id_client
		 */
		public function updateOrder($order)
		{
			$this->deleteProducts($order->getId());

			$query = "UPDATE `order` SET `id_client` = :id_client, `tps` = :tps, `tvq` = :tvq, `total` = :total WHERE `order`.`id_order` = :id_order";

			$query2 = "UPDATE `client` SET `name` = :name, `address` = :address, `city` = :city, `province` = :province, `postal_code` = :zip WHERE `client`.`id_client` = :id_client";

			$parametersClient = 
			[
				":id_client" => $order->getClient()->getId(),
				":name" => $order->getClient()->getName(),
				":address" => $order->getClient()->getAddress(),
				":city" => $order->getClient()->getCity(),
				":province" => $order->getClient()->getProvince(),
				":zip" => $order->getClient()->getPostalCode(),
			];	
			

			$this->calculatePrice($order);
			var_dump($order);
			$parametersOrders = 
			[
				"id_order" => $order->getId(),
				":id_client" => $order->getClient()->getId(),
				":tps" => $this->calculateTPS($order),
				":tvq" => $this->calculateTVQ($order),
				":total" => $order->getTotal(),
			];

			if(!$this->query_engine->executeQuery($query2, $parametersClient)) {
				echo "Erreur lors de la modification du client";
			}			

			if(!$this->query_engine->executeQuery($query, $parametersOrders)) {
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
			$i = 0;
			foreach ($order->getProducts() as $p) {
				$total .= ($p->getPrice()*$order->getQuantities()[$i]);
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

		public function getProductsQty($id_order)
		{
			$query = "SELECT quantity FROM `ta_order_product` WHERE id_order = " . $id_order;

			$parametersOrders = 
			[
				"id" => $id_order,
			];

			$resultSet = $this->query_engine->executeQuery($query);
			$qty = [];
			foreach ($resultSet as $row) {
				array_push($qty, $row['quantity']);
			}

			return $qty;
		}


		public function getProductsId($id_order)
		{
			$query = "SELECT id_product FROM `ta_order_product` WHERE id_order = " . $id_order;

			$parametersOrders = 
			[
				"id" => $id_order,
			];

			$resultSet = $this->query_engine->executeQuery($query);
			$products= [];
			foreach ($resultSet as $row) {
				#var_dump($row['id_product']);
				$this->mgrProduct->getProductById($row['id_product']);
				$pro = $this->mgrProduct->getProduct();
				#var_dump($pro);
				array_push($products, $pro);
			}
			#var_dump($products);
			return $products;
		}
		
    public function makePayment($tokenId, $price)
    {

        $price *= 100;

        try {
            \Stripe\Stripe::setApiKey("sk_test_IHvUqWlOZpF6fpSXlX9k119n00Cf1LJM5v");

            $charge = \Stripe\Charge::create([
                'amount' => $price,
                'currency' => 'cad',
                'description' => 'Commande quintessentiel',
                'source' => $tokenId,
            ]);

        } catch (\Stripe\Error\Card $e) {
            //When a card is declined
            return 2;
            echo "carte invalide!";
        } catch (Exception $e) {
            // Something else happened, completely unrelated to Stripe
            return 3;
        }

        return 1; //worked perfectly
    }

    /**
     * Gets the total of an order from
     * the DB with it's Id.
     *
     * @param $id_order is the id of the order
     * @return the total
     */
    public function getTotalById($id_order)
    {
        //Gets the total for an order

        $query = "SELECT total FROM `order` WHERE id_order = :id_order";
        $parametersOrder =
            [
            "id_order" => $id_order,
        ];

        $result = $this->query_engine->executeQuery($query, $parametersOrder);

        if (!$result) {
            echo "Erreur lors de la sélection du prix de la commande";
            throw new Exception("Cannot get the total");
        } else {
            $total = $result->fetch();

            return $total["total"];
        }
    }
}

?>
