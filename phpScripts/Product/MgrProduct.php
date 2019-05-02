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
2019-05-01 CV PHPDoc
=========================================================
 ****************************************/

include_once "Product.php";
require_once __DIR__ . '/../QueryEngine.php';
//include_once("Category.php"); manque la class de phil

class MgrProduct
{
    private $products; //Product object list array
    private $ingredientsQuantities; //Product object list array
    private $mgrCategory; //MgrCategory object

    /**
     * Constructor for MgrProduct
     *
     */
    public function __construct()
    {
        #$mgrCategory = new MgrCategory(); manque la classe de phil
        $this->products = array();
        $this->ingredientsQuantities = array();
    }

    /**
     * Send to the QueryEngine a prepared statement in string form
     * along with its parameters as a map.
     * Sends a query to the database to insert a new row in the table product
     * 
     * @param Product $product The new product and its informations
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
                ":quantity" => $product->getQuantity()
            ];
        if (!$queryEngine->executeQuery($query, $parameters)) {
            echo "Error while trying to add a product";
        }
    }

    /**
     * Send to the QueryEngine a prepared statement in string form
     * along with its parameters as a map.
     * Updates the row of the desired product in the database.
     *
     * @param Product $product The product containing the informations to update
     *
     */
    public function updateProduct($product)
    {
        $queryEngine = new QueryEngine();
        $query = "UPDATE Product 
                SET name= :name, image_path= :image_path, 
                is_sellable = :is_sellable, description = :description, 
                price= :price, quantity= :quantity 
                WHERE id_product= :id";

        $parameters =
            [
                ":name" => $product->getName(),
                ":image_path" => $product->getImagePath(),
                ":is_sellable" => $product->getIsSellable(),
                ":description" => $product->getDescription(),
                ":price" => $product->getPrice(),
                ":quantity" => $product->getQuantity(),
                ":id" => $product->getId()
            ];
            
        if (!$queryEngine->executeQuery($query, $parameters)) {
            echo "Error while trying to add a product";
        }
    }

    /**
     * Send to the QueryEngine a prepared statement in string form
     * along with its parameters as a map.
     * Sends a query to the database to delete a particular product.
     *
     * @param int $id The id of the product to remove
     *
     */
    public function removeProduct($id)
    {
        $queryEngine = new QueryEngine();
        $query = "DELETE FROM Product WHERE id_product= :id";

        $parameters =
            [
                ":id" => $id
            ];

        if (!$queryEngine->executeQuery($query, $parameters)) {
            echo "Error while trying to add a product";
        }
    }

    /**
     * Send to the QueryEngine a prepared statement in string form
     * along with its parameters as a map
     *
     * @param string $name The name of the product
     * @param string $filter 
     *
     */
    public function getProductsByName($name, $filter = null)
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
     * @param int $id_product The id of the product desired
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
     * Gets a list of all the products from the database, ordered or not.
     *
     * @param string $filter 
     *
     */
    public function getAllProducts($filter = null)
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
     * @param int $recipeId The recipe's id
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
     * @param mixed $resultSet The result of the query
     *
     */
    private function resultToArray($resultSet)
    {
        $this->products = array();
        foreach ($resultSet->fetchAll(\PDO::FETCH_NUM) as $result) {
            $product = new Product(
                $result[1], // name
                [],        // Categories
                $result[2], // is_sellable
                $result[4], // price
                $result[3], // description
                $result[5], // quantity
                $result[6] //path

            );

            $product->setId($result[0]); // id
            if (isset($result[7])) {
                $product->setVolumeUsed($result[7]); // qty_ml
            }

            array_push($this->products, $product);
        }
    }

    /**
     * Gets the array of products
     * @return array $products Array of products
     */
    public function getProduct()
    {
        return $this->products;
    }

    /**
     * Sets the array of products
     * @param array $products
     *
     */
    public function setProduct($products)
    {
        $this->products = $products;
    }

    /**
     * Gets the array of the product's categories
     * @return array $productCategories Array of the product's categories
     */
    public function getProductCategories()
    {
        return $this->productCategories;
    }

    /**
     * Sets the array of the product's categories
     * @param array $productCategories Array of the product's categories
     *
     */
    public function setProductCategories($productCategories)
    {
        $this->productCategories = $productCategories;
    }
}
?>
