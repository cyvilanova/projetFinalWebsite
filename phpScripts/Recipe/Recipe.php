<?php
/****************************************
	 Fichier : Recipe.php
	 Auteur : Cynthia Vilanova
	 Fonctionnalité : W3 - Gestion des recettes
	 Date : 2019-04-17
	 Vérification : 
	 Date Nom Approuvé
	 =========================================================
	 Historique de modifications :
	 Date Nom Description
	 2019-04-19 CV Added Id
	 =========================================================
 ****************************************/

class Recipe implements JsonSerializable {

	private $id; // Recipe's id
	private $name; // Recipe's name
	private $ingredients; // Array of products used for the recipe
	private $finalProduct; // Id of the product the recipe creates
	private $custom; // If it's a custom or standard recipe
	private $steps; // All the steps of the recipe

	/**
	 * Recipe constructor with parameters.
	 * @param  string $name the name of the recipe
	 * @param  Product $finalProduct the final product of the recipe
	 * @param  boolean $custom if it's a custom or standard recipe
	 * @param  string $steps steps of the recipe
	 *
	 */
	public function __construct($name, $finalProduct, $custom, $steps) {
		$this->name = $name;
		$this->finalProduct = $finalProduct;
		$this->custom = $custom;
		$this->steps = $steps;
	}

	/**
	 * Makes an array with all the properties of the object 
	 * and returns it for the js to use.
	 * @return array of all the properties of the object
	 * 
	 */
	public function jsonSerialize() {
		return array(
				'id'=>$this->id,
				'name'=>$this->name,
				'ingredients'=>$this->ingredients,
				'finalProduct'=>$this->finalProduct,
				'custom'=>$this->custom,
				'steps'=>$this->steps
		);
}

	/**
	 * Gets the id of the recipe
	 * @return int $id the id of the recipe
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Sets the id of the recipe
	 * @param int $id
	 *
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * Gets the name of the recipe
	 * @return string $name the name of the recipe
	 * 
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets the name of the recipe
	 * @param string $name
	 * 
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Gets the array of products used in the recipe
	 * @return array $ingredients a list of the products used
	 * 
	 */
	public function getIngredients() {
		return $this->ingredients;
	}

	/**
	 * Sets the array of products used in the recipe
	 * @param  array $ingredients a list of the products used
	 * 
	 */
	public function setIngredients($ingredients) {
		$this->ingredients = $ingredients;
	}

	/**
	 * Gets the name of the final product
	 * @return Product $finalProduct the name of the final product
	 * 
	 */
	public function getFinalProduct() {
		return $this->finalProduct;
	}

	/**
	 * Sets the name of the final product
	 * @param Product $finalProduct the name of the final product
	 * 
	 */
	public function setFinalProduct($finalProduct) {
		$this->finalProduct = $finalProduct;
	}

	/**
	 * If the recipe is personnalized for a particular client, returns true.
	 * If the recipe is for a standarized product, return false.
	 * @return boolean $custom
	 * 
	 */
	public function isCustom() {
		return $this->custom;
	}

	/**
	 * Sets it the recipe is custom made or not.
	 * @param boolean $custom
	 * 
	 */
	public function setIsCustom($custom) {
		$this->custom = $custom;
	}

	/**
	 * Gets the steps to make the recipe
	 * @return string $steps
	 * 
	 */
	public function getSteps() {
		return $this->steps;
	}

	/**
	 * Sets the steps to make the recipe
	 * @param string $steps
	 * 
	 */
	public function setSteps($steps) {
		$this->steps = $steps;
	}

}

?>
