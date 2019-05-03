<?php
/****************************************
 Fichier : MgrCategory.php
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

require_once 'Category.php';
require_once __DIR__ . '/../QueryEngine.php';

class MgrCategory
{
  private $queryEngine;  // New query engine
  private $categories; // Array of categories

  /**
   * Category manager constructor
   * 
   */
  public function __construct()
  {
    $this->queryEngine = new QueryEngine();
  }

  /**
   * Adds a category to the database
   * @param mixed $category category to add to the array
   *
   */
  public function addCategory($category)
  {
    $parameters =
      [
        ":name" => $category->getName(),
        ":is_active" => $category->isActive(),
        ":desc" => $category->getDescription(),
      ];

    $query = "INSERT INTO category(name, is_active,description) VALUES (:name, :is_active,:desc)";

    if (!$this->queryEngine->executeQuery($query, $parameters)) {
      echo "Error in the query";
    }
  }

  /**
   * Fetches the categories from the database
   *
   */
  public function selectAllCategories()
  {
    $query = "SELECT * FROM category";

    $resultSet =   $this->queryEngine->executeQuery($query);

    if (!$resultSet) {
      echo "Error while trying to load all category";
    } else {
      $this->resultToArray($resultSet);
    }
  }

  public function getProductCategories($productId)
  {
    $queryEngine = new QueryEngine();
    $query = "SELECT c.id_product AS id_product, 
            product.name AS name,
            product.is_sellable AS is_sellable, 
            product.price AS price,
            product.description AS description, 
            product.quantity AS quantity,
            product.image_path AS image_path, 
            ta_recipe_product.qty_ml AS qty_ml 
            FROM product
            INNER JOIN ta_recipe_product
            ON product.id_product = ta_recipe_product.id_product
            WHERE id_recipe = :idRecipe";
    $parameters =
        [
            "idRecipe" => $recipeId,
        ];
    $resultSet = $queryEngine->executeQuery($query, $parameters);
    if (!$resultSet) {
        echo "Error while trying to load the ingredients.";
    } else {
        $this->resultToArray($resultSet);
    }
  }

  /**
   * Takes a resultSet as parameter and adds every row into the categories array
   * @param mixed $resultSet The resultset from the database
   * 
   */
  private function resultToArray($resultSet)
  {
    $this->categories = array();

    foreach ($resultSet->fetchAll(\PDO::FETCH_NUM) as $result) {

      $category = new Category(
        $result[0], // id_category
        $result[1], // name
        $result[2], // is_active
        $result[3] // description
      );

      array_push($this->categories, $category);
    }
  }

  /**
   * Gets the the array of categories
   * @return array $categories of the manager
   * 
   */
  public function getCategories()
  {
    return $this->categories;
  }

}

?>
