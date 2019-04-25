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
	 =========================================================
 ****************************************/

require_once 'Recipe.php';
require(__DIR__.'/../QueryEngine.php');

class MgrRecipe {

	private $recipe;		// Recipe object
	private $queryEngine; // QueryEngine instance

	public function __construct(){ 
		$this->queryEngine = new QueryEngine();
	}

	
	/**
	 * Send to the QueryEngine a prepared statement in string form
	 * along with its parameters as a map. 
	 *
	 */
	public function addNewRecipe() {
		$query = "INSERT INTO recipe(name, is_custom) VALUES (:name, :is_custom)";
		$parameters = 
		[
			":name" => "Test2",
			":is_custom" => "1",
		];

		if(!$this->queryEngine->executeQuery($query, $parameters)) {
			echo "Error in the query";
		}
	}
}

?>
