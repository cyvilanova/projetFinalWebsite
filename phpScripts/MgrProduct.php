<?php
	/****************************************
	 Fichier : MgrProduct.php
	 Auteur : David Gaulin
	 Fonctionnalité : W7 - Consultation d'un catalogue de produit
	 Date : 2019-04-15
	 Vérification : 
	 Date Nom Approuvé
	 =========================================================
	 Historique de modifications :
	 Date Nom Description
	 =========================================================
	****************************************/

	class MgrProduct{

		private $product;	//Product object
		private $category; //MgrCategory object


		public function __construct($product,$category){
			$this->product = $product;
			$this->category = $category;
		}

	    /**
	     * @return mixed
	     */
	    public function getProduct()
	    {
	        return $this->product;
	    }

	    /**
	     * @param mixed $product
	     *
	     * @return self
	     */
	    public function setProduct($product)
	    {
	        $this->product = $product;
	    }

	    /**
	     * @return mixed
	     */
	    public function getCategory()
	    {
	        return $this->category;
	    }

	    /**
	     * @param mixed $category
	     *
	     * @return self
	     */
	    public function setCategory($category)
	    {
	        $this->category = $category;
	    }
}
?>