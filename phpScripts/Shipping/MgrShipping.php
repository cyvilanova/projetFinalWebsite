<?php

	include_once "Shipping.php";
	require __DIR__ . '/../QueryEngine.php';
	/**
	 * 
	 */
	class MgrShipping
	{
		
		private $shipping;
		private $query_engine;

		function __construct()
		{
			#$this->shipping = $shipping;
			$this->query_engine = new QueryEngine();
		}

		public function getShippingId($method_name)
		{
			$query = "SELECT shipping_method.id_method FROM shipping_method WHERE shipping_method.name = '" . $method_name . "'";

			$resultSet = $this->query_engine->executeSelect($query,[]);
			
			foreach ($resultSet as $row) {
				echo $row['id_method'];
			}
		}


		public function insertShippingCompany($name)
		{
			$query = "INSERT INTO shipping_company (`id_company`, `name`) VALUES (DEFAULT, '" . $name . "')";

			$result = $this->query_engine->executeQuery($query,[]);

			if (!$result) {
				echo "Erreur durant l'ajout de la compagnie de livraison.";
			}
		}


		public function insertShippingMethod($id_company, $method_name, $price)
		{
			$query = "INSERT INTO shipping_method (id_method, id_company, name, price) VALUES (DEFAULT, '" . $id_company . "', '" . $method_name . "', " . $price . ")";
			var_dump($query);
			$result = $this->query_engine->executeQuery($query,[]);

			if (!$result) {
				echo "Erreur durant l'ajout de la compagnie de livraison.";
			}
		}


		public function getCompanyId($name)
		{
			$query = "SELECT shipping_company.id_company FROM shipping_company WHERE shipping_company.name = '" . $name . "'";
			#var_dump($query);
			$resultSet = $this->query_engine->executeSelect($query,[]);
			#var_dump($resultSet);

			foreach ($resultSet as $row) {
				echo $row['id_company'];
			}

		}



		public function getShipping()
		{
		    return $this->shipping;
		}
		 
		public function setShipping($shipping)
		{
		    $this->shipping = $shipping;
		    return $this;
		}
	}

?>