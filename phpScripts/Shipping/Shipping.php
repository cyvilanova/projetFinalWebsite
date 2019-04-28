<?php

	/**
	 * 
	 */
	class Shipping
	{
		
		private $company;
		private $method;
		private $price;
		
	
		/**
		 * __construct
		 *
		 * @param  mixed $company name
		 * @param  mixed $method name
		 * @param  mixed $price of the method
		 *
		 * @return void
		 */
		function __construct($company, $method, $price)
		{
			$this->company = $company;
			$this->method = $method;
			$this->price = $price;
		}


		/**
		 * getCompany
		 *
		 * @return void
		 */
		public function getCompany()
		{
		    return $this->company;
		}
		 
		/**
		 * setCompany
		 *
		 * @param  mixed $company
		 *
		 * @return void
		 */
		public function setCompany($company)
		{
		    $this->company = $company;
		    return $this;
		}


		/**
		 * getMethod
		 *
		 * @return void
		 */
		public function getMethod()
		{
		    return $this->method;
		}
		 
		/**
		 * setMethod
		 *
		 * @param  mixed $method
		 *
		 * @return void
		 */
		public function setMethod($method)
		{
		    $this->method = $method;
		    return $this;
		}


		/**
		 * getPrice
		 *
		 * @return void
		 */
		public function getPrice()
		{
		    return $this->price;
		}
		 
		/**
		 * setPrice
		 *
		 * @param  mixed $price
		 *
		 * @return void
		 */
		public function setPrice($price)
		{
		    $this->price = $price;
		    return $this;
		}
	}

?>