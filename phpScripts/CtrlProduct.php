<?php
	include_once("MgrProduct.php");

	class CtrlProduct{

		private $mgrProduct;

		public function __construct(){
				$this->mgrProduct = new MgrProduct();
		}

		//loads all the products from the db
		public function loadAllProducts(){
			$productList = $this->mgrProduct->getAllProducts();
			
			while($product = $productList -> fetch())
			{
				echo "<div class='product'>";
				echo "<img src='image/produitTest.png'/>";
				echo "<h2>".$product["name"]."</h2>";
				echo "<p>".$product["description"]."</p>";
				echo "<p class='bottom-text'><span class='stock'>".$product["quantity"]." en stock</span><span class='prix'>".$product["price"]."</span></p>";
				echo "</div>";

			}
		}
	    /**
	     * @return mixed
	     */
	    public function getMgrProduct()
	    {	
	        return $this->mgrProduct;
	    }

	    /**
	     * @param mixed $mgrProduct
	     *
	     * @return self
	     */
	    public function setMgrProduct($mgrProduct)
	    {
	        $this->mgrProduct = $mgrProduct;
	    }
}
?>