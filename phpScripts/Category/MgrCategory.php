<?php
/****************************************
 Fichier : Category.php
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

class MgrCategory{

  private $categories; //array of category

  /**
  * Category manager constructor without parameters
  */
  public function __construct(){}

  /**
  *Gets the the array of categories
  * @return array $categories of the manager
  */
  public function getCategories(){
    return $this->categories;
  }

  /**
  *Add a category to the database
  *@param mixed $category category to add to the array
  */
  public function addCategory($category){

    $queryEngine = new QueryEngine();
    $parameters =
      [
        ":name" => $category->getName(),
        ":is_active" => $category->getActive(),
        ":desc" =>$category->getDescription(),
      ];

    $query = "INSERT INTO category(name, is_active,description) VALUES (:name, :is_active,:desc)";

    if ($queryEngine->executeQuery($query, $parameters)) {
      echo "Error in the query";
    }
  }

  /**
  *Edit an existing category in the database
  *@param mixed $updatedCategory category containing the updated information
  */
  public function editCategory($updatedCategory){
    $queryEngine = new QueryEngine();
    $parameters =
      [
        ":id" =>$updatedCategory->getId(),
        ":name" => $updatedCategory->getName(),
        ":activity" => $updatedCategory->getActive(),
        ":description" =>$updatedCategory->getDescription(),
      ];

    $query = "UPDATE category SET name=:name, is_active=:activity, description=:description WHERE id_category=:id";

    if (!$queryEngine->executeQuery($query, $parameters)) {
      echo "Error in the query\n";
      echo $updatedCategory->getId()."\n";
      echo $updatedCategory->getName()."\n";
      echo $updatedCategory->getActive()."\n";
      echo $updatedCategory->getDescription()."\n";

    }
  }

  /**
   * Fetches the categories from the database
   * @param int $active Filter the active categories
   *
   */
  public function selectAllCategories($active = null)
  {
    $queryEngine = new QueryEngine();
    $query = "SELECT * FROM category";

    if ($active != null) {
      // Adds the filter by active categories
      $query .= " WHERE is_active = " . $active;
    }

    $resultSet =  $queryEngine->executeQuery($query);

    if (!$resultSet) {
      echo "Error while trying to load all category";
    } else {
      $this->resultToArray($resultSet);
    }
  }

  /**
   * Gets all the categories in which a product is
   * @param int $productId The product's id
   *
   */
  public function getProductCategories($productId)
  {
    $queryEngine = new QueryEngine();
    $query = "SELECT category.id_category, category.name, category.is_active, category.description
              FROM ta_product_category
              INNER JOIN category
              ON category.id_category = ta_product_category.id_category
              WHERE id_product = :productId";
    $parameters =
        [
            "productId" => $productId,
        ];
    $resultSet = $queryEngine->executeQuery($query, $parameters);
    if (!$resultSet) {
        echo "Error while trying to load the categories of a product.";
    } else {
        $this->resultToArray($resultSet);
    }
  }

  /**
	*Use a result set of category and push every row in the array of $categories
  * @param mixed $resultSet The result set from the database
	*/
	private function resultToArray($resultSet){
		$this->categories = array();

		foreach($resultSet->fetchAll(\PDO::FETCH_NUM) as $result) {

			$category = new Category(
        $result[0], // id_category
        $result[1], // name
				$result[2], // is_active
				$result[3] // description
			);
			array_push($this->categories, $category);
		}
	}



}

?>
