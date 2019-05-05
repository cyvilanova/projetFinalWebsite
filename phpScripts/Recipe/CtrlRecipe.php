<?php
/****************************************
	 Fichier : CtrlRecipe.php
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

include_once "MgrRecipe.php";

class CtrlRecipe
{
	private $mgrRecipe;

	/**
	 * Constructor of CtrlRecipe
	 *
	 */
	public function __construct()
	{
		$this->mgrRecipe = new MgrRecipe();
	}

	/**
	 * Loads all the recipes from the database
	 *
	 */
	public function loadAllRecipesTable()
	{
		$this->mgrRecipe->selectAllRecipes();
		$this->displayRecipesRows();
	}

	/**
	 * Displays the recipes in a table
	 * @return string of the html code to include in the html page myrecipes
	 * 
	 */
	private function displayRecipesRows()
	{

		$recipes = $this->mgrRecipe->getRecipesArray();
		$html = "";

		foreach ($recipes as $recipe) {
			
			$this->mgrRecipe->getMgrProduct()->getProductById($recipe->getFinalProduct()->getId());
			$finalProduct = $this->mgrRecipe->getMgrProduct()->getProduct();			
		
			$html .= "<tr data-toggle=\"modal\" data-target=\"#editModal\" onclick='editRecipe(".json_encode($recipe, JSON_HEX_APOS, JSON_HEX_QUOT).");' title=\"Modifier la recette\" id=\"" . $recipe->getId() . "\">";
			$html .= "<td>" . $recipe->getId() . "</td>";
			$html .= "<td>" . $recipe->getName() . "</td>";
			$html .= "<td>" . $finalProduct[0]->getName() . "</td>";
			$html .= "<td>" . $finalProduct[0]->getDescription() . "</td>";
			$html .= "<td>" . $finalProduct[0]->getPrice() . "</td>";

			if ($recipe->isCustom() == 1) {
				$html .= "<td> Oui </td>";
			} else {
				$html .= "<td> Non </td>";
			}

			$html .= "</tr>";
		}

		echo $html;
	}

	/**
	 * addRecipe
	 *
	 * @param  string $recipeName
	 * @param  boolean $recipeIsCustom
	 * @param  string $recipeSteps
	 * @param  string $finalProductName
	 * @param  string $finalProductDescription
	 * @param  array $finalProductCategories
	 * @param  array $ingredients
	 *
	 */
	public function createRecipe($recipeName, $recipeIsCustom, $recipeSteps, $finalProductName, $finalProductDescription, $finalProductCategories, $ingredients)
	{
		$this->mgrRecipe->createRecipe($recipeName, $recipeIsCustom, $recipeSteps, $finalProductName, $finalProductDescription, $finalProductCategories, $ingredients);
	}
	
	public function updateRecipe() 
	{
		
	}
}
?>
