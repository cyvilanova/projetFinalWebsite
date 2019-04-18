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
    private $queryEngine;

    public function __construct()
    {
        #$mgrCategory = new MgrCategory(); manque la classe de cath
        $this->queryEngine = new QueryEngine();
    }
    /*
    public function insertProduct($product)
    {
        $add = new QueryEngine();
        $add->addProduct($product->getName(),
            $product->getIsSellable(),
            $product->getDescription(),
            $product->getPrice(),
            $product->getQuantity());
    }

    public function getAllSellables()
    {
        $load = new QueryEngine();
        $resultSet = $load->getAllSellables();

        return $resultSet;
    }

    public function getProductsByName($name, $filter)
    {
        $load = new QueryEngine();
        $resultSet = $load->getProductsByName($name, $filter);

        return $resultSet;
    }
    */
    //gets all the products from the db et returns it
    public function getAllProducts($filter)
    {
        $query = "SELECT * FROM Product";

        if($filter != null){    //Adds the filter
            $query .= " ORDER BY ".$filter;
        }

        $resultSet = $this->queryEngine->executeQuery($query,[]);

        if (!$resultSet) {
            echo "Error while trying to load all products";
        } else {

            while ($test = $resultSet->fetch()) {
                var_dump($test);
            }

        }
    }
    /*
    public function getIngredients($receipeId)
    {
        $load = new QueryEngine();
        $resultSet = $load->getIngredients($receipeId);

        return $resultSet;
    }
    */

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
