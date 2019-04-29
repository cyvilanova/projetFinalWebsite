<?php
/****************************************
Fichier : MgrShipping.php
Auteur : Catherine Bronsard
Fonctionnalité : W9 - Gestion livraisons
Date : 2019-04-17
Vérification :
Date Nom Approuvé
=========================================================
Historique de modifications :
Date Nom Description
=========================================================
 ****************************************/

	require_once __DIR__ . '/Shipping.php';
	require_once __DIR__ . '/../QueryEngine.php';

	class MgrShipping
	{

		private $query_engine;

		/**
		 * Constructor
		 *
		 */
		function __construct()
		{
			$this->query_engine = new QueryEngine();
		}

		/**
		 * Returns shipping id from the method name
		 *
		 * @param  string $method_name
		 *
		 * @return shipping id
		 */
		public function getShippingId($method_name)
		{
			$query = "SELECT shipping_method.id_method FROM shipping_method WHERE shipping_method.name = :name";

			$parameters = [
				":name" => $method_name,
			];

			$resultSet = $this->query_engine->executeQuery($query,$parameters);

			$shipping = resultToArray($resultSet, "id_method");

			foreach ($shipping as $row) {
				return $row['id_method'];
			}
		}
		/**
		* Takes a ResultSet and turns it into an array with all the shippings id
		*
		* @param ResultSet $resultSet
		*
		* @return array of id
		*/
	    private function resultToArray($resultSet, $column)
	    {
	        $array = array();

	        foreach($resultSet->fetchAll(\PDO::FETCH_NUM) as $result) {
	            $element = $result[$column];

	            array_push($array, $element);
	        }
	        return $array;
	    }

		/**
		 * Adds a shipping company to the data base
		 *
		 * @param  string $shipping
		 *
		 */
		public function insertShippingCompany($shipping)
		{
			$query = "INSERT INTO shipping_company (`id_company`, `name`) VALUES (DEFAULT, :name)";

			$parameters = [
				":name" => $shipping,
			];

			$result = $this->query_engine->executeQuery($query, $parameters);

			if (!$result) {
				echo "Erreur durant l'ajout de la compagnie de livraison.";
			}
		}


		/**
		 * Add a shipping method to a company
		 *
		 * @param  int $id_company
		 * @param  string $method_name
		 * @param  double $price
		 */
		public function insertShippingMethod($id_company, $method_name, $price)
		{
			$query = "INSERT INTO shipping_method (id_method, id_company, name, price) VALUES (DEFAULT, :id_company, :method_name, :price)";

			$parameters = [
				":id_company" => $id_company,
				":method_name" => $method_name,
				":price" => $price,
			];

			$result = $this->query_engine->executeQuery($query, $parameters);

			if (!$result) {
				echo "Erreur durant l'ajout de la méthode de livraison.";
			}
		}


		/**
		 * Returns the company id from the name
		 *
		 * @param  string $name
		 *
		 * @return company id
		 */
		public function getCompanyId($name)
		{
			$query = "SELECT shipping_company.id_company FROM shipping_company WHERE shipping_company.name = :company_name";

			$parameters = [
				":company_name" => $name,
			];

			$resultSet = $this->query_engine->executeQuery($query,[]);

			$result = resultToArray($resultSet, "id_company");

			foreach ($result as $row) {
				return $row['id_company'];
			}
		}
	}

?>

