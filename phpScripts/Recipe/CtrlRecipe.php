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
	private $pageNumber;
	private $itemsPerPage;

	public function __construct()
	{
		$this->mgrRecipe = new MgrRecipe();
		$this->pageNumber = 0;
		$this->itemsPerPage = 10;
	}

	/**
	 * Loads all the recipes from the database
	 *
	 */
	public function loadAllRecipesTable()
	{
		$this->pageNumber = 0;
		$recipesList = $this->mgrRecipe->selectAllRecipes();
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

			$this->mgrRecipe->getMgrProduct()->getProductById($recipe->getidFinalProduct());
			$finalProduct = $this->mgrRecipe->getMgrProduct()->getProduct();			
		
			$html .= "<tr data-toggle=\"modal\" data-target=\"#editModal\" onclick='editRecipe(".json_encode($recipe, JSON_HEX_APOS, JSON_HEX_QUOT).");' title=\"Modifier la recette\" id=\"" . $recipe->getId() . "\">";
			$html .= "<td>" . $recipe->getId() . "</td>";
			$html .= "<td>" . $recipe->getName() . "</td>";
			$html .= "<td>" . $finalProduct[0]->getName() . "</td>";
			$html .= "<td>" . $recipe->getDescription() . "</td>";
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

	public function loadRecipeIngredients($recipeId) {

		$html = "";
		$ingredients = $this->mgrRecipe->getIngredientsArray($recipeId);

		foreach ($ingredients as $ingredient) {

			$html .= "<div class=\"ingredient-item\" id=\"ingredient-item-" . $ingredient->getId() . "\">";
			$html .= "<label for=\"ingredient\" class=\"col-form-label\">" . $ingredient->getName() . "</label>";
			$html .= "<input type=\"number\" step=\"0.01\" min=\"0\" lang=\"en\" class=\"form-control input-volume\" id=\"recipe-ingredient\">";
			$html .= "<label class=\"col-form-label label-volume\"> mL </label>";
			$html .= "<button type=\"button\" class=\"btn btn-light btn-remove\" onclick=\"removeIngredient(" . $ingredient->getId() .")\">X</button>";
			$html .= "</div>";
		}

		echo $html;
	}
}
?>
