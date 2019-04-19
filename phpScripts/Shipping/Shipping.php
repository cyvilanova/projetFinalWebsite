<?php

	/**
	 * 
	 */
	class Shipping
	{
		
		private $company;
		private $method;
		private $price;
		
		function __construct($company, $method, $price)
		{
			$this->company = $company;
			$this->method = $method;
			$this->price = $price;
		}


		public function getCompany()
		{
		    return $this->company;
		}
		 
		public function setCompany($company)
		{
		    $this->company = $company;
		    return $this;
		}


		public function getMethod()
		{
		    return $this->method;
		}
		 
		public function setMethod($method)
		{
		    $this->method = $method;
		    return $this;
		}


		public function getPrice()
		{
		    return $this->price;
		}
		 
		public function setPrice($price)
		{
		    $this->price = $price;
		    return $this;
		}
	}

?>