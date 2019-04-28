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

	require_once __DIR__ . '/../Product/Product.php';

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

		/**
		 * __construct
		 *
		 * @param  mixed $id
		 * @param  mixed $price
		 * @param  mixed $total
		 * @param  mixed $products
		 * @param  mixed $quantities
		 *
		 * @return void
		 */
		function __construct($id, $price, $total, $products, $quantities)
		{
			$this->id = $id;
			$this->price = $price;
			$this->total = $total;
			$this->products = $products;
			$this->quantities = $quantities;
			calculatePrice();
			calculateTaxes();
		}


		/**
		 * editProduct
		 *
		 * @param  mixed $new_product Nouveau Produit
		 * @param  mixed $old_product Ancien Produit
		 *
		 * @return void
		 */
		public function editProduct($new_product, $old_product)
		{
			foreach ($this->products as $p) {
				if ($p->getName() == $old_product->getName()) 
				{
					$p = $new_product;
				}
			}
		}

		/**
		 * addProduct
		 *
		 * @param  mixed $product to add
		 *
		 * @return void
		 */
		public function addProduct($product)
		{
			array_push($this->products, $product);
		}


		/**
		 * deleteProduct
		 *
		 * @param  mixed $product_name
		 *
		 * @return void
		 */
		public function deleteProduct($product_name)
		{
			foreach ($this->products as $key => $product) {
				if ($key->getName() == $product_name) 
				{
					unset($this->products[$key]);
				}
			}
		}

		/**
		 * changeQuantity of a product
		 *
		 * @param  mixed $product_name
		 * @param  mixed $new_qty 
		 *
		 * @return void
		 */
		public function changeQuantity($product_name, $new_qty)
		{
			foreach ($this->products as $p) {
				if ($p->getName() == $product_name) 
				{
					$p->setQuantity($new_qty);
				}
			}
		}


		/**
		 * calculatePrice (and recalculating Taxes)
		 *
		 * @return void
		 */
		public function calculatePrice()
		{
			$this->price = 0;
			foreach ($this->products as $p) {
				$this->price .= $p->getPrice();
			}
			calculateTaxes();
		}

		/**
		 * calculateTaxes (including TPS and TVQ)
		 *
		 * @return void
		 */
		public function calculateTaxes()
		{
			calculateTPS();
			calculateTVQ();
			$this->total = ($this->price + $tps + $tvq);
		}


		/**
		 * calculateTPS
		 *
		 * @return TPS
		 */
		public function calculateTPS()
		{
			return ($this->price * 0.05);
		}


		/**
		 * calculateTVQ 
		 *
		 * @return TVQ
		 */
		public function calculateTVQ()
		{
			return ($this->price * 0.09975);
		}


		/**
		 * getId
		 *
		 * @return void
		 */
		public function getId()
		{
		    return $this->id;
		}
		 
		/**
		 * setId
		 *
		 * @param  mixed $id
		 *
		 * @return void
		 */
		public function setId($id)
		{
		    $this->id = $id;
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


		/**
		 * getTotal
		 *
		 * @return void
		 */
		public function getTotal()
		{
		    return $this->total;
		}
		 
		/**
		 * setTotal
		 *
		 * @param  mixed $total
		 *
		 * @return void
		 */
		public function setTotal($total)
		{
		    $this->total = $total;
		    return $this;
		}


		/**
		 * getProducts
		 *
		 * @return void
		 */
		public function getProducts()
		{
		    return $this->products;
		}
		 
		/**
		 * setProducts
		 *
		 * @param  mixed $products
		 *
		 * @return void
		 */
		public function setProducts($products)
		{
		    $this->products = $products;
		    return $this;
		}
	}
	
?>