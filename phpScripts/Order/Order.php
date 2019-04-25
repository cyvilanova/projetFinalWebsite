<?php
	/****************************************
	 Fichier : Order.php
	 Auteure : Catherine Bronsard
	 Fonctionnalité : Commandes clients
	 Date : 2019-04-17
	 Vérification :
	 Date Nom Approuvé
	 =========================================================
	 Historique de modifications :
	 Date Nom Description
	 =========================================================
	****************************************/

	include_once "..\Product\Product.php";

	/**
	 *
	 */
	class Order
	{
		private $id;

		private $quantities = []; // Quantities of the products
		private $price;
		private $total;
		private $products = []; // ArrayList of products

		function __construct($id, $price, $total, $products)
		{
			$this->id = $id;
			$this->price = $price;
			$this->total = $total;
			$this->products = $products;
			calculateTaxes();
		}



		public function addProduct($product)
		{
			array_push($this->products, $product);
		}


		public function deleteProduct($product_name)
		{
			foreach ($this->products as $key => $product) {
				if ($key->getName() == $product_name) 
				{
					unset($this->products[$key]);
				}
			}
		}


		public function changeQuantity($product_name, $new_qty)
		{
			foreach ($this->products as $key => $product) {
				if ($product->getName() == $product_name) 
				{
					$product->setQuantity($new_qty);
				}
			}
		}


		public function calculateTaxes()
		{
			$tps = ($this->price * 0,05);
			$tvq = ($this->price * 0,09975);
			$this->total = ($this->price + $tps + $tvq);
		}


		public function calculateTPS()
		{
			return ($this->price * 0,05);
		}


		public function calculateTVQ()
		{
			return ($this->price * 0,09975);
		}


		public function getId()
		{
		    return $this->id;
		}
		 
		public function setId($id)
		{
		    $this->id = $id;
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


		public function getTotal()
		{
		    return $this->total;
		}
		 
		public function setTotal($total)
		{
		    $this->total = $total;
		    return $this;
		}


		public function getProducts()
		{
		    return $this->products;
		}
		 
		public function setProducts($products)
		{
		    $this->products = $products;
		    return $this;
		}
	}
	
?>