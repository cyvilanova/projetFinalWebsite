<?php
/****************************************
Fichier : CtrlProduct.php
Auteur : David Gaulin
Fonctionnalité : Contrôleur produit
Date : 2019-04-17
Vérification :
Date Nom Approuvé
=========================================================
Historique de modifications :
Date Nom Description
=========================================================
 ****************************************/
include_once "MgrProduct.php";

class CtrlProduct
{

    private $mgrProduct;

    public function __construct()
    {
        $this->mgrProduct = new MgrProduct();

    }

    //loads all the products from the db
    public function loadAllProducts()
    {
        $productList = $this->mgrProduct->getAllProducts();
        $this->displayProduct($productList);
    }

    //Loads all the sellable products
    public function loadAllSellables()
    {
        $sellableProductList = $this->mgrProduct->getAllSellables();
        $this->displayProduct($sellableProductList);
    }

    //Loads all products by name
    public function loadProductsByName($name)
    {
        $productList = $this->mgrProduct->getProductsByName($name);
        $this->displayProduct($productList);
    }

    //Displays the products on the page
    private function displayProduct($list)
    {   
        if ($list -> rowCount()) {
            while ($product = $list->fetch()) {

                echo "<div class='product'>";
                echo "<img src='image/produitTest.png'/>";
                echo "<h2>" . $product["name"] . "</h2>";
                echo "<p>" . $product["description"] . "</p>";
                echo "<p class='bottom-text'><span class='stock'>" . $product["quantity"] . " en stock</span><span class='prix'>" . $product["price"] . "</span></p>";
                echo "</div>";

            }
        }
        else{
            echo "<p>Aucun item ne correspond!</p>";
        }
    }

    /**
     * @return mixed
     */
    public function getMgrProduct()
    {
        return $this->mgrProduct;
    }

    /**
     * @param mixed $mgrProduct
     *
     * @return self
     */
    public function setMgrProduct($mgrProduct)
    {
        $this->mgrProduct = $mgrProduct;
    }
}
