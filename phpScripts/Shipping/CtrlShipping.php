<?php

	require_once __DIR__ . '/Shipping.php';
	require_once __DIR__ . '/MgrShipping.php';
	require_once __DIR__ . '/../QueryEngine.php';
	/**
	 * 
	 */
	/**
	 * 
	 */
	class CtrlShipping
	{
		private $mgrshipping;
		
		/**
		 * __construct
		 *
		 * @return void
		 */
		function __construct()
		{
			$mgrshipping = new MgrShipping();
		}

		/**
		 * addShipping
		 *
		 * @param  mixed $shipping_name
		 * @param  mixed $method_name
		 * @param  mixed $price
		 *
		 * @return void
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