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
	require_once __DIR__ . '/../Client/Client.php';
	/**
	 *
	 */
	class Order implements JsonSerializable
	{
		private $id; // Id of the order
		private $quantities = []; // Quantities of the products
		private $price; // price of the order
		private $total; // total (price + taxes)
		private $products = []; // ArrayList of products or ids
		private $client;
		private $state;

		/**
		 * __construct
		 *
		 * @param  int $id
		 * @param  double $price
		 * @param  double $total
		 * @param  array of Products $products
		 * @param  arrayList of int of the $quantities
		 *
		 * @return void
		 */
		function __construct($id, $client, $price, $total, $products, $quantities, $state)
		{
			$this->id = $id;
			$this->price = $price;
			$this->total = $total;
			$this->products = $products;
			$this->quantities = $quantities;
			$this->client = $client;
			$this->state = $state;
		}


	public function jsonSerialize() {
		return array(
				'id'=>$this->id,
				'client'=>$this->client,
				'products'=>$this->products,
				'quantities'=>$this->quantities,
				'state'=>$this->state
		);
	}

		public function getState()
		{
		    return $this->state;
		}
		 
		public function setState($state)
		{
		    $this->state = $state;
		    return $this;
		}

		public function getClient()
		{
		    return $this->client;
		}
		 
		public function setClient($client)
		{
		    $this->client = $client;
		    return $this;
		}


		/**
		 * Edit the product
		 *
		 * @param  Product $new_product New Produit
		 * @param  Product $old_product Old Produit
		 *
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
		 * Add a product to the arraylist of products
		 *
		 * @param  Product $product to add
		 *
		 */
		public function addProduct($product)
		{
			array_push($this->products, $product);
		}


		public function getQuantities()
		{
		    return $this->quantities;
		}
		 
		public function setQuantities($quantities)
		{
		    $this->quantities = $quantities;
		    return $this;
		}

		/**
		 * Delete a product from the arraylist of products
		 *
		 * @param  string $product_name
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
		 * Change the quantity of a product
		 *
		 * @param  string $product_name
		 * @param  int $new_qty 
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
		 * getId
		 *
		 * @return int
		 */
		public function getId()
		{
		    return $this->id;
		}
		 
		/**
		 * setId
		 *
		 * @param  int $id
		 */
		public function setId($id)
		{
		    $this->id = $id;
		}


		/**
		 * getPrice
		 *
		 * @return double
		 */
		public function getPrice()
		{
		    return $this->price;
		}
		 
		/**
		 * setPrice
		 *
		 * @param  double $price
		 */
		public function setPrice($price)
		{
		    $this->price = $price;
		}


		/**
		 * getTotal
		 *
		 * @return double
		 */
		public function getTotal()
		{
		    return $this->total;
		}
		 
		/**
		 * setTotal
		 *
		 * @param  double $total
		 */
		public function setTotal($total)
		{
		    $this->total = $total;
		}


		/**
		 * getProducts
		 *
		 * @return arraylisy of Products
		 */
		public function getProducts()
		{
		    return $this->products;
		}
		 
		/**
		 * setProducts
		 *
		 * @param  arraylisy of Products $products
		 */
		public function setProducts($products)
		{
		    $this->products = $products;
		}
	}
	
?>

