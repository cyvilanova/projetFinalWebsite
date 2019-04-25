<?php
/****************************************
Fichier : MgrProduct.php
Auteur : David Gaulin
Fonctionnalité : W7 - Consultation d'un catalogue de produit
Date : 2019-04-15
Vérification :
Date Nom Approuvé
=========================================================
Historique de modifications :
Date Nom Description
2019-04-22 CV Changer array product pour products
=========================================================
 ****************************************/

include_once "Product.php";
require_once __DIR__ . '/../QueryEngine.php';
//include_once("Category.php"); manque la class de cath

class MgrProduct
{

    private $products; //Product object list array
    private $ingredientsQuantities; //Product object list array
    private $mgrCategory; //MgrCategory object

    public function __construct()
    {
        #$mgrCategory = new MgrCategory(); manque la classe de cath
        $this->products = array();
        $this->ingredientsQuantities = array();
    }

    /**
     * Send to the QueryEngine a prepared statement in string form
     * along with its parameters as a map.
     *
     */
    public function insertProduct($product)
    {
        $queryEngine = new QueryEngine();

        $query = "INSERT INTO Product(name,image_path,is_sellable,description,price,quantity)
        VALUES(:name,:image_path,:is_sellable,:description,:price,:quantity)";

        $parameters =
            [
            ":name" => $product->getName(),
            ":image_path" => $product->getImagePath(),
            ":is_sellable" => $product->getIsSellable(),
            ":description" => $product->getDescription(),
            ":price" => $product->getPrice(),
            ":quantity" => $product->getQuantity(),
        ];

        if (!$queryEngine->executeQuery($query, $parameters)) {
            echo "Error while trying to add a product";
        }

    }

    /**
     * Send to the QueryEngine a prepared statement in string form
     * along with its parameters as a map
     *
     */
    public function getProductsByName($name, $filter=null)
    {
        $queryEngine = new QueryEngine();
        $query = "SELECT * FROM Product WHERE name LIKE :name";
        $parameters =
            [
            ":name" => "%" . $name . "%",
        ];

        if ($filter != null) {
            //Adds the filter
            $query .= " ORDER BY " . $filter;
        }

        $resultSet = $queryEngine->executeQuery($query, $parameters);

        if (!$resultSet) {
            echo "Error while trying to load products by name";
        } else {
            $this->resultToArray($resultSet);
        }
    }

    /**
     * Send to the QueryEngine a prepared statement in string form
     * along with its parameters as a map to select the product by its id.
     *
     */
    public function getProductById($id_product)
    {
        $queryEngine = new QueryEngine();
        $query = "SELECT * FROM Product WHERE id_product = :id";
        $parameters =
        [
            ":id" => $id_product
        ];

        $resultSet = $queryEngine->executeQuery($query, $parameters);

        if (!$resultSet) {
            echo "Error while trying to load products by id";
        } else {
            $this->resultToArray($resultSet);
        }
    }

    /**
     * Send to the QueryEngine a prepared statement in string form
     * along with its parameters as a map.
     *
     */
    public function getAllProducts($filter=null)
    {
        $queryEngine = new QueryEngine();
        $query = "SELECT * FROM Product";

        if ($filter != null) {
            //Adds the filter
            $query .= " ORDER BY " . $filter;
        }

        $resultSet = $queryEngine->executeQuery($query);

        if (!$resultSet) {
            echo "Error while trying to load all products";
        } else {
            $this->resultToArray($resultSet);
        }
    }

    /**
     * Send to the QueryEngine a prepared statement in string form
     * along with its parameters as a map.
     *
     */
    public function getIngredients($recipeId)
    {
        $queryEngine = new QueryEngine();
        $query = "SELECT product.id_product AS id_product, 
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
     * Takes a resultSet as parameter and
     * adds every row into the Products array
     *
     */
    private function resultToArray($resultSet)
    {
        $this->products = array();

        foreach($resultSet->fetchAll(\PDO::FETCH_NUM) as $result) {

            $product = new Product(
                $result[1], // name
                [],
                $result[2], // is_sellable
                $result[3], // price
                $result[4], // description
                $result[5], // quantity
                $result[6] // image_path
            );

            $product->setId($result[0]); // id

            if(isset($result[7])) {
                $product->setVolumeUsed($result[7]); // qty_ml
            }
            
            array_push($this->products, $product);
        }
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->products;
    }

    /**
     * @param mixed $product
     *
     * @return self
     */
    public function setProduct($product)
    {
        $this->products = $product;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     *
     * @return self
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }
}
