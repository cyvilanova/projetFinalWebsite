<?php
/****************************************
Fichier : Shipping.php
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
	class Shipping
	{

		private $company;
		private $method;
		private $price;


		/**
		 * Constructor
		 *
		 * @param  string $company name
		 * @param  string $method name
		 * @param  double $price of the method
		 *
		 */
		function __construct($company, $method, $price)
		{
			$this->company = $company;
			$this->method = $method;
			$this->price = $price;
		}


		/**
		 * Returns the name of the shipping company
		 *
		 * @return company name (string $name)
		 */
		public function getCompany()
		{
		    return $this->company;
		}

		/**
		 * Sets the name of the shipping company
		 *
		 * @param  String $company

		 */
		public function setCompany($company)
		{
		    $this->company = $company;
		}


		/**
		 * Returns the name of the shipping method
		 *
		 * @return the name of the shipping method
		 */
		public function getMethod()
		{
		    return $this->method;
		}

		/**
		 * Sets the name of the shipping method
		 *
		 * @param  string $method
		 *
		 */
		public function setMethod($method)
		{
		    $this->method = $method;
		}


		/**
		 * Returns the price of the shipping method
		 *
		 * @return double
		 */
		public function getPrice()
		{
		    return $this->price;
		}

		/**
		 * Sets the price of the shipping method
		 *
		 * @param  double $price
		 *
		 */
		public function setPrice($price)
		{
		    $this->price = $price;
		}
	}

?>

