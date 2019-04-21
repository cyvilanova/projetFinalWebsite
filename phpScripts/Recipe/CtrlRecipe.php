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
include_once __DIR__ . '/../Product/MgrProduct.php';

class CtrlRecipe
{

	private $mgrRecipe;
	private $mgrProduct;
	private $pageNumber;
	private $itemsPerPage;

	public function __construct()
	{
		$this->mgrRecipe = new MgrRecipe();
		$this->mgrProduct = new MgrProduct();
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

	//Displays the products in rows on the page
	private function displayRecipesRows()
	{

		$recipes = $this->mgrRecipe->getRecipesArray();
		$html = "";

		foreach ($recipes as $recipe) {

			$this->mgrProduct->getProductById($recipe->getidFinalProduct());
			$finalProduct = $this->mgrProduct->getProduct();			

			$html .= "<tr id=" . $recipe->getId() . ">";
			$html .= "<td><input type='checkbox' class='select'/></td>";
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
}
