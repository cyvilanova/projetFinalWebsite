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
    public function loadAllProducts($filter)
    {
        $productList = $this->mgrProduct->getAllProducts($filter);
        $this->displayProduct($productList);
    }

    //Loads all the sellable products
    public function loadAllSellables()
    {
        $sellableProductList = $this->mgrProduct->getAllSellables();
        $this->displayProduct($sellableProductList);
    }

    //Loads all products by name
    public function loadProductsByName($name,$filter)
    {
        $productList = $this->mgrProduct->getProductsByName($name,$filter);
        $this->displayProduct($productList);
    }

    //Displays the products on the page
    private function displayProduct($list)
    {   
        $html = "";

        if ($list -> rowCount()) {
            while ($product = $list->fetch()) {

                $html .= "<div class='product'>";
                $html .= "<img src='image/produitTest.png'/>";
                $html .= "<h2>" . $product["name"] . "</h2>";
                $html .= "<p>" . $product["description"] . "</p>";
                $html .= "<p class='bottom-text'><span class='stock'>" . $product["quantity"] . " en stock</span><span class='prix'>" . $product["price"] . "</span></p>";
                $html .= "</div>";

            }

            echo $html;
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
