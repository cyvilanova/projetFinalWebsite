<?php
/****************************************
 Fichier : CtrlCategory.php
 Auteur : Philippe Audit-Allaire
 Fonctionnalité : W - Connexion de l'utilisateur
 Date : 2019-04-15
 Vérification :
 Date Nom Approuvé
 =========================================================
 Historique de modifications :
 Date Nom Description
 =========================================================
****************************************/

include_once "mgrCategory.php";

class CtrlCategory{
  private $mgrCategory;
  private $pageNumber;
  private $pageItems;

  public function __construct(){
    $this->mgrCategory = new MgrCategory();
    $this->pageNumber = 0;
    $this->pageItems = 10;
  }

  /**
	 * Loads all the recipes from the database
	 *
	 */
	public function loadAllCategories(){
		$this->pageNumber = 0;
		$categoryList = $this->mgrCategory->selectAllCategories();
		$this->displayCategoriesRows();
	}

  /**
	 * Displays the recipes in a table
	 * @return string of the html code to include in the html page myrecipes
	 *
	 */
	private function displayCategoriesRows(){

		$categories = $this->mgrCategory->getCategories();
		$html = "";

		foreach ($categories as $category) {

			$html .= "<tr data-toggle=\"modal\" data-target=\"#editModal\" onclick='editRecipe(".json_encode($category, JSON_HEX_APOS, JSON_HEX_QUOT).");' title=\"Modifier la categorie\" id=\"" . $category->getId() . "\">";
			$html .= "<td>" . $category->getId() . "</td>";
			$html .= "<td>" . $category->getName() . "</td>";
      if($category->getActive()==1){
        $html .= "<td>Actif</td>";
      }
      else{
        $html .= "<td>Inactif</td>";
      }
			$html .= "<td>" . $category->getDescription() . "</td>";

			$html .= "</tr>";
		}

		echo $html;
	}
}
?>
