<?php

	require_once __DIR__ . '/Shipping.php';
	require_once __DIR__ . '/../QueryEngine.php';
	/**
	 * 
	 */
	class MgrShipping
	{
		
		private $query_engine;

		/**
		 * __construct
		 *
		 * @return void
		 */
		function __construct()
		{
			$this->query_engine = new QueryEngine();
		}

		/**
		 * getShippingId
		 *
		 * @param  mixed $method_name
		 *
		 * @return void
		 */
		public function getShippingId($method_name)
		{
			$query = "SELECT shipping_method.id_method FROM shipping_method WHERE shipping_method.name = '" . $method_name . "'";

			$resultSet = $this->query_engine->executeSelect($query,[]);
			
			foreach ($resultSet as $row) {
				echo $row['id_method'];
			}
		}


		/**
		 * insertShippingCompany
		 *
		 * @param  mixed $shipping
		 *
		 * @return void
		 */
		public function insertShippingCompany($shipping)
		{
			$query = "INSERT INTO shipping_company (`id_company`, `name`) VALUES (DEFAULT, '" . $name . "')";

			$result = $this->query_engine->executeQuery($query,[]);

			if (!$result) {
				echo "Erreur durant l'ajout de la compagnie de livraison.";
			}
		}


		/**
		 * insertShippingMethod
		 *
		 * @param  mixed $id_company
		 * @param  mixed $method_name
		 * @param  mixed $price
		 *
		 * @return void
		 */
		public function insertShippingMethod($id_company, $method_name, $price)
		{
			$query = "INSERT INTO shipping_method (id_method, id_company, name, price) VALUES (DEFAULT, '" . $id_company . "', '" . $method_name . "', " . $price . ")";
			var_dump($query);
			$result = $this->query_engine->executeQuery($query,[]);

			if (!$result) {
				echo "Erreur durant l'ajout de la méthode de livraison.";
			}
		}


		/**
		 * getCompanyId
		 *
		 * @param  mixed $name
		 *
		 * @return void
		 */
		public function getCompanyId($name)
		{
			$query = "SELECT shipping_company.id_company FROM shipping_company WHERE shipping_company.name = '" . $name . "'";
			#var_dump($query);
			$resultSet = $this->query_engine->executeSelect($query,[]);
			#var_dump($resultSet);

			foreach ($resultSet as $row) {
				return $row['id_company'];
			}
		}
	}

?>