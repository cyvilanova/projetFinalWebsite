<?php
	/****************************************
	 Fichier : Product.php
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

	class Product{

		private $name;
		private $categories; //array of categories in wich the product belongs
		private $isSellable;
		private $price;
		private $description;
		private $quantity;



		public function __construct($name,$categories,$isSellable,$price,$description,$quantity){
				$this->name = $name;
				$this->categories = $categories;
				$this->isSellable = $isSellable;
				$this->price = $price;
				$this->description = $description;
				$this->quantity = $quantity;
		}

	
	    /**
	     * @return mixed
	     */
	    public function getName()
	    {
	        return $this->name;
	    }

	    /**
	     * @param mixed $name
	     *
	     * @return self
	     */
	    public function setName($name)
	    {
	        $this->name = $name;
	    }

	    /**
	     * @return mixed
	     */
	    public function getCategories()
	    {
	        return $this->categories;
	    }

	    /**
	     * @param mixed $categories
	     *
	     * @return self
	     */
	    public function setCategories($categories)
	    {
	        $this->categories = $categories;
	    }

	    /**
	     * @return mixed
	     */
	    public function getIsSellable()
	    {
	        return $this->isSellable;
	    }

	    /**
	     * @param mixed $isSellable
	     *
	     * @return self
	     */
	    public function setIsSellable($isSellable)
	    {
	        $this->isSellable = $isSellable;
	    }

	    /**
	     * @return mixed
	     */
	    public function getPrice()
	    {
	        return $this->price;
	    }

	    /**
	     * @param mixed $price
	     *
	     * @return self
	     */
	    public function setPrice($price)
	    {
	        $this->price = $price;
	    }

	    /**
	     * @return mixed
	     */
	    public function getDescription()
	    {
	        return $this->description;
	    }

	    /**
	     * @param mixed $description
	     *
	     * @return self
	     */
	    public function setDescription($description)
	    {
	        $this->description = $description;
	    }

	    /**
	     * @return mixed
	     */
	    public function getQuantity()
	    {
	        return $this->quantity;
	    }

	    /**
	     * @param mixed $quantity
	     *
	     * @return self
	     */
	    public function setQuantity($quantity)
	    {
	        $this->quantity = $quantity;
	    }
}
?>