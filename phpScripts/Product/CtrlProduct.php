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
    public function loadAllProductsTable()
    {
        $productList = $this->mgrProduct->getAllProducts($filter);
        $this->displayProductRows($productList);
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
    public function loadProductsByName($name, $filter)
    {
        $productList = $this->mgrProduct->getProductsByName($name, $filter);
        $this->displayProduct($productList);
    }

    //Displays the products on the page
    private function displayProduct($list)
    {
        $html = "";

        if ($list->rowCount()) {
            while ($product = $list->fetch()) {

                $html .= "<div class='product'>";
                $html .= "<img src='".$product["image_path"]."'/>";
                $html .= "<h2>" . $product["name"] . "</h2>";
                $html .= "<p>" . $product["description"] . "</p>";
                $html .= "<p class='bottom-text'><span class='stock'>" . $product["quantity"] . " en stock</span><span class='prix'>" . $product["price"] . "</span></p>";
                $html .= "</div>";

            }

            echo $html;
        } else {
            echo "<p>Aucun item ne correspond!</p>";
        }
    }

    //Displays the products in rows on the page
    private function displayProductRows($list)
    {

        while ($product = $list->fetch()) {
            echo "<tr id=" . $product["id_product"] . ">";
            echo "<td><input type='checkbox' class='select'></td>";
            echo "<td>" . $product["name"] . "</td>";
            echo "<td>" . $product["description"] . "</td>";
            echo "<td><img src='" . $product["image_path"] . "'/></td>";
            echo "<td>Catégorie Produit</td>";
            echo "<td>" . $product["quantity"] . "</td>";
            echo "<td>" . $product["price"] . "$</td>";
            if($product["is_sellable"] == 1)
            {
                echo "<td><input disabled checked type='checkbox'></td>";
            }
            else
            {
                echo "<td><input disabled type='checkbox'></td>";
            }
            echo "</tr>";
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
