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
	 * along with its parameters as a map to select the recipes needed. 
	 * 
	 * @return array of all the recipes found in the database
	 * 
	 */
	public function selectAllRecipes()
	{
		$query = "SELECT * FROM recipe";

		$resultSet = 	$this->queryEngine->executeQuery($query);

		if (!$resultSet) {
			echo "Error while trying to load all recipes";
		} else {
			$this->resultToArray($resultSet);
		}
	}

	/**
	 * Takes a resultSet as parameter and
	 * adds every row into the Recipes array.
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
	 * Gets the array of recipes.
	 * 
	 * @return recipe $recipes
	 * 
	 */
	public function getRecipesArray()
	{
		return $this->recipes;
	}

	/**
	 * Gets the list of ingredients used in the recipe.
	 * 
	 * @param int $recipeId the id of the recipe
	 * 
	 * @return array of products
	 * 
	 */
	public function getIngredientsArray($recipeId) {
		$this->mgrProduct->getIngredients($recipeId);
		$ingredients = $this->mgrProduct->getProduct();
		return $ingredients;
	}

	/**
	 * Gets the product manager to access the products linked to the recipe.
	 * 
	 * @return MgrProduct $mgrProduct
	 * 
	 */
	public function getMgrProduct()
	{
		return $this->mgrProduct;
	}

	/**
	 * Send to the QueryEngine a prepared statement in string form
	 * along with its parameters as a map to insert a new recipe. 
	 *
	 * @param string $recipeName
	 * @param boolean $recipeIsCustom
	 * @param string $recipeSteps
	 * @param string $finalProductName
	 *
	 */
	public function createRecipe($recipeName, $recipeIsCustom, $recipeSteps, $finalProductName, 
															 $finalProductDescription, $finalProductCategories, $recipeIngredients)
	{
		$finalProductId = $this->mgrProduct->createNewProduct($finalProductName, $finalProductDescription, $finalProductCategories);

		$query = "INSERT INTO recipe(name, is_custom, steps, id_product) 
							VALUES (:name, :is_custom, :steps, :id_product)";
		$parameters =
			[
				":name" => $recipeName,
				":is_custom" => $recipeIsCustom,
				":steps" => $recipeSteps,
				":id_product" => $finalProductId
			];

			if(!$this->queryEngine->executeQuery($query, $parameters)) {
				echo "Error while trying to insert a recipe in database.";
			} 
			else {
				$recipeId = $this->queryEngine->getLastInsertedId();
				$this->addIngredients($recipeId,  $recipeIngredients);
			}
	}

	/**
	 * Send to the QueryEngine a prepared statement in string form
	 * along with its parameters as a map to insert a new recipe. 
	 * 1- Update recipe
	 * 2- Update the final product informations
	 * 	2.1 - Update the product's categories
	 * 3- Update the ingredients
	 *
	 * @param int $recipeId
	 * @param boolean $recipeIsCustom
	 * @param string $recipeSteps
	 * @param string $finalProductName
	 *
	 */
	public function updateRecipe($recipeId, $recipeName, $recipeIsCustom, $recipeSteps, $recipeIngredients)
	{
		$query = "UPDATE recipe SET name = :name, 
							is_custom = :is_custom, 
							steps = :steps
							WHERE id_recipe = :id";

		$parameters =
			[
				":name" => $recipeName,
				":is_custom" => $recipeIsCustom,
				":steps" => $recipeSteps,
				":id" => $recipeId
			];

		if ($this->queryEngine->executeQuery($query, $parameters)) {
			$this->updateRecipeIngredients($recipeId, $recipeIngredients);
		} else {
			echo "Error while trying to update a recipe's informations.";
		}
	}

	/**
	 * Deletes the associations of recipe and products
	 * and creates the edited ones.
	 *
	 * @param int $recipeId The id of the recipe to edit
	 * @param array $recipeIngredients The ingredients used
	 *
	 */
	public function updateRecipeIngredients($recipeId, $recipeIngredients)
	{
		$this->deleteFromTAProduct($recipeId);
		$this->addIngredients($recipeId,  $recipeIngredients);
	}

	/**
	 * Associates the recipe with products(ingredients) in the association table.
	 *
	 * @param int $recipeId The id of the recipe
	 * @param array $recipeIngredients The array containing the id of the product and the quantity used in ml
	 *
	 */
	public function addIngredients($recipeId,  $recipeIngredients)
	{
		for ($i = 0, $size = count($recipeIngredients); $i < $size; ++$i) {
			$query = "INSERT INTO ta_recipe_product(id_recipe, id_product, qty_ml)
								VALUES(:id_recipe, :id_product, :qty_ml)";

			$parameters =
				[
					":id_recipe" => $recipeId, // recipe's id
					":id_product" => $recipeIngredients[$i][0], // ingredient's id
					":qty_ml" => $recipeIngredients[$i][1] // ingredient's quantity in ml

				];

			if (!$this->queryEngine->executeQuery($query, $parameters)) {
				echo "Error while trying to insert an ingredient in the recipe. id_product = " . $recipeIngredients[$i][0];
			}
		}
	}

	/**
	 * Deletes the recipe from the database.
	 *
	 * @param int $recipeId The id of the recipe we want to delete
	 *
	 */
	public function deleteRecipe($recipeId)
	{
		$this->deleteFromTAProduct($recipeId);
		$query = "DELETE FROM recipe WHERE id_recipe= :id";

		$parameters =
			[
				":id" => $recipeId
			];

		if (!$this->queryEngine->executeQuery($query, $parameters)) {
			echo "Error while trying to delete a recipe";
		}
	}

	/**
	 * Deletes the association between the recipe and the products
	 * in ta_recipe_product.
	 *
	 * @param int $recipeId The id of the recipe we want to delete
	 * 
	 */
	public function deleteFromTAProduct($recipeId)
	{
		$query = "DELETE FROM ta_recipe_product WHERE id_recipe= :id";

		$parameters =
			[
				":id" => $recipeId
			];

		if (!$this->queryEngine->executeQuery($query, $parameters)) {
			echo "Error while trying to delete the associations between the recipe and the ingredients.";
		}
	}
}

?>
