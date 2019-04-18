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
=========================================================
 ****************************************/

include_once "Product.php";
require __DIR__ . '/../QueryEngine.php';
//include_once("Category.php"); manque la class de cath

class MgrProduct
{

    private $product; //Product object list array
    private $mgrCategory; //MgrCategory object

    public function __construct()
    {
        #$mgrCategory = new MgrCategory(); manque la classe de cath
        $this->product = array();
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
    public function getIngredients($receipeId)
    {
        $queryEngine = new QueryEngine();
        $query = "SELECT * FROM Product
            INNER JOIN ta_recipe_product
            ON Product.id_product = ta_recipe_product.id_product
            WHERE ta_recipe_product.id_recipe = :idRecipe";

        $parameters =
            [
            "idRecipe" => $receipeId,
        ];

        if ($filter != null) {
            //Adds the filter
            $query .= " ORDER BY " . $filter;
        }

        $resultSet = $queryEngine->executeQuery($query, $parameters);

        if (!$resultSet) {
            echo "Error while trying to load the ingredients";
        } else {
            $this->resultToArray($resultSet);
        }
    }

    /**
     * Takes a resultSet as parameter and
     * adds every row into the Product array
     *
     */
    private function resultToArray($resultSet)
    {
        $this->product = array();

        while ($result = $resultSet->fetch()) {

            $product = new Product(
                $result["name"],
                [],
                $result["is_sellable"],
                $result["price"],
                $result["description"],
                $result["quantity"],
                $result["image_path"]);

            $product -> setId($result["id_product"]);

            array_push($this->product, $product);
        }
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param mixed $product
     *
     * @return self
     */
    public function setProduct($product)
    {
        $this->product = $product;
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
