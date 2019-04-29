<?php
/****************************************
Fichier : CtrlShipping.php
Auteur : Catherine Bronsard
Fonctionnalité : W9 - Gestion livraisons
Date : 2019-04-19
Vérification :
Date Nom Approuvé
=========================================================
Historique de modifications :
Date Nom Description
=========================================================
 ****************************************/

	require_once __DIR__ . '/Shipping.php';
	require_once __DIR__ . '/MgrShipping.php';
	require_once __DIR__ . '/../QueryEngine.php';

	/**
	 * 
	 */
	class CtrlShipping
	{
		private $mgrshipping;
		
		/**
		 * __construct
		 */
		function __construct()
		{
			$mgrshipping = new MgrShipping();
		}

		/**
		 * Add a shipping company and a shipping method
		 *
		 * @param  string $shipping_name
		 * @param  string $method_name
		 * @param  double $price
		 */
		public function addShipping($shipping_name, $method_name, $price)
		{
			$shipping = new Shipping($shipping_name, $method_name, $price);
			$mgrshipping->insertShippingCompany($shipping);
			
			$id = $mgrshipping->getCompanyId($shipping->getCompany());

			$mgrshipping->insertShippingMethod($id, $method_name, $price);
		}

	}

?>

