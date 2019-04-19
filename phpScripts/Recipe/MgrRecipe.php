<?php
/****************************************
	 Fichier : MgrRecipe.php
	 Auteur : Cynthia Vilanova
	 Fonctionnalité : W3 - Gestion des recettes
	 Date : 2019-04-17
	 Vérification : 
	 Date Nom Approuvé
	 =========================================================
	 Historique de modifications :
	 Date Nom Description
	 2019-04-18 CV Requêtes
	 2019-04-19 CV Affichage
	 =========================================================
 ****************************************/

require_once 'Recipe.php';
require_once __DIR__ . '/../QueryEngine.php';
require_once __DIR__ . '/../Product/MgrProduct.php';

class MgrRecipe
{
	private $mgrProduct; // 
	private $recipes; // Array of recipes
	private $queryEngine;

	public function __construct()
	{
		$this->mgrProduct = new MgrProduct();
		$this->queryEngine = new QueryEngine();
	}

	/**
	 * Send to the QueryEngine a prepared statement in string form
	 * along with its parameters as a map to insert a new recipe. 
	 *
	 */
	public function addNewRecipe()
	{
		$query = "INSERT INTO recipe(name, is_custom) VALUES (:name, :is_custom)";
		$parameters =
			[
				":name" => "Test2",
				":is_custom" => "1",
			];

		if (!$this->queryEngine->executeQuery($query, $parameters)) {
			echo "Error in the query";
		}
	}

	/**
	 * Send to the QueryEngine a prepared statement in string form
	 * along with its parameters as a map to select the recipes needed. 
	 *
	 * @param string $filter 
	 *
	 * @return array of all the recipes found in the database
	 */
	public function selectAllRecipes($filter = NULL)
	{
		$query = "SELECT * FROM recipe";

		if ($filter != NULL) {
			//Adds the filter
			$query .= " ORDER BY " . $filter;
		}

		$resultSet = 	$this->queryEngine->executeQuery($query);

		if (!$resultSet) {
			echo "Error while trying to load all recipes";
		} else {
			$this->resultToArray($resultSet);
		}
	}

	/**
	 * Takes a resultSet as parameter and
	 * adds every row into the Recipes array
	 *
	 */
	private function resultToArray($resultSet)
	{
		$this->recipes = array();

		while ($result = $resultSet->fetch()) {

			$recipe = new Recipe(
				$result["name"],
				$result["id_product"],
				$result["is_custom"],
				$result["steps"],
				$result["description"]
			);

			$recipe->setId($result["id_recipe"]);

			array_push($this->recipes, $recipe);
		}
	}

	/**
	 * Gets the array of recipes
	 * @return recipe $recipes
	 * 
	 */
	public function getRecipesArray()
	{
		return $this->recipes;
	}

	/**
	 * setRecipe
	 * @param recipe $recipe
	 * 
	 */
	public function setRecipe($recipe)
	{
		$this->recipe = $recipe;
	}
}
?>
