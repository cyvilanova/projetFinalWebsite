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

class Recipe {

	private $id; // Recipe's id
	private $name; // Recipe's name
	private $ingredients; // Array of products used for the recipe
	private $idFinalProduct; // Id of the product the recipe creates
	private $custom; // If it's a custom or standard recipe
	private $steps; // All the steps of the recipe
	private $description; // Description of the recipe

	/**
	 * Recipe constructor with parameters.
	 * @param  mixed $name the name of the recipe
	 * @param  mixed $idFinalProduct the final product of the recipe
	 * @param  mixed $custom if it's a custom or standard recipe
	 * @param  mixed $steps steps of the recipe
	 * @param  mixed $description description of the recipe
	 *
	 */
	public function __construct($name, $idFinalProduct, $custom, $steps, $description) {
		$this->name = $name;
		$this->idFinalProduct = $idFinalProduct;
		$this->custom = $custom;
		$this->steps = $steps;
		$this->description = $description;
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
	 * @param  mixed $id
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
	 * @return string $idFinalProduct the name of the final product
	 * 
	 */
	public function getIdFinalProduct() {
		return $this->idFinalProduct;
	}

	/**
	 * Sets the name of the final product
	 * @param string $idFinalProduct the name of the final product
	 * 
	 */
	public function setIdFinalProduct($idFinalProduct) {
		$this->idFinalProduct = $idFinalProduct;
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

	/**
	 * Gets the description of the recipe
	 * @return string $description
	 * 
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Sets the description of the recipe
	 * @param string $description
	 * 
	 */
	public function setDescription($description) {
		$this->description = $description;
	}
}
?>
