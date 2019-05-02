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
	public function addNewRecipe($recipeName, $recipeIsCustom, $recipeSteps, $finalProductName, 
															 $finalProductDescription, $categories, $ingredients)
	{
		$query = "INSERT INTO recipe(name, is_custom, steps, id_product) 
							OUTPUT Inserted.ID
							VALUES (:name, :is_custom, :steps, :id_product)";
		$parameters =
			[
				":name" => $recipeName,
				":is_custom" => $recipeIsCustom,
				":steps" => $recipeSteps,
				":id_product" => 2
			];

			$resultSet = 	$this->queryEngine->executeQuery($query, $parameters);
	
			if (!$resultSet) {
				echo "Error while trying to load all recipes";
			} else {
				$this->resultToArray($resultSet);
			}
	}

	/**
	 * Send to the QueryEngine a prepared statement in string form
	 * along with its parameters as a map to select the recipes needed. 
	 *
	 * @param string $filter 
	 * @return array of all the recipes found in the database
	 * 
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

		foreach($resultSet->fetchAll(\PDO::FETCH_NUM) as $result) {

			$this->mgrProduct->getProductById($result[1]);
			$finalProduct = $this->mgrProduct->getProduct();	

			$recipe = new Recipe(
				$result[2], // name
				$finalProduct[0], // finalProduct
				$result[3], // is_custom
				$result[4] // steps
			);

			$recipe->setId($result[0]);
			$recipe->setIngredients($this->getIngredientsArray($result[0]));
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
	 * Gets the list of ingredients used in the recipe
	 * @param int $recipeId the id of the recipe
	 * @return array of products
	 * 
	 */
	public function getIngredientsArray($recipeId) {
		$this->mgrProduct->getIngredients($recipeId);
		$ingredients = $this->mgrProduct->getProduct();
		return $ingredients;
	}

	/**
	 * Gets the product manager to access the products linked to the recipe
	 * @return MgrProduct $mgrProduct
	 * 
	 */
	public function getMgrProduct()
	{
		return $this->mgrProduct;
	}

}
?>
