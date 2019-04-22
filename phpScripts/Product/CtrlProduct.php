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
    private $pageNumber;
    private $itemPerPage;

    public function __construct()
    {
        $this->mgrProduct = new MgrProduct();
        $this->pageNumber = 0;
        $this->itemPerPage = 10;
    }

    //loads all the products from the db
    public function loadAllProductsTable()
    {
        $this->pageNumber = 0;
        $productList = $this->mgrProduct->getAllProducts();
        $this->displayProductRows();
    }

    //loads all the products from the db
    public function loadAllProducts($filter = null)
    {
        $this->pageNumber = 0;
        $productList = $this->mgrProduct->getAllProducts($filter);
        $this->displayProduct();
    }

    //Loads all the sellable products
    public function loadAllSellables()
    {
        $this->pageNumber = 0;
        $sellableProductList = $this->mgrProduct->getAllSellables();
        $this->displayProduct();
    }

    //Loads all products by name
    public function loadProductsByName($name, $filter = null)
    {
        $this->pageNumber = 0;
        $productList = $this->mgrProduct->getProductsByName($name, $filter);
        $this->displayProduct();
    }

    //Displays the products on the page
    private function displayProduct()
    {
        $products = $this->mgrProduct->getProduct();

        $from = $this->itemPerPage * $this->pageNumber; //Number of item skipped
        $to = (sizeof($products) - $from >= $this->itemPerPage ? $from + $this->itemPerPage : sizeof($products)); //Number of item to display
        $maxNumberOfPage = round(sizeof($products) / $this->itemPerPage);

        $html = "";

        if (!empty($products)) {

            for ($i = $from; $i < $to; $i++) {

                $html .= "<div class='product'>";
                $html .= "<img src='" . $products[$i]->getImagePath() . "' alt='un produit'/>";
                $html .= "<h2>" . $products[$i]->getName() . "</h2>";
                $html .= "<p>" . $products[$i]->getDescription() . "</p>";
                $html .= "<p class='bottom-text'><span class='stock'>" . $products[$i]->getQuantity() . " en stock</span>";
                $html .= "<span class='prix'>" . $products[$i]->getPrice() . "</span></p>";
                $html .= "</div>";
            }

            $html .= "<div class='link-page-box'>";

            //Page buttons
            if ($this->pageNumber > 0) {  //Previous button
                $html .= "<a href='#' title='page précédente' onclick='changePage(" . ($this->pageNumber - 1) . ")'>Précédent</a>";
            }


            for ($j = 0; $j < $maxNumberOfPage; $j++) {

                if ($this->pageNumber == $j) {    //Currently on this page
                    $html .= "<a href='#' title='autre page' style='color:black;' onclick='changePage(" . $j . ")'>" . ($j + 1) . "</a>";
                } else {   //Other pages
                    $html .= "<a href='#' title='autre page' onclick='changePage(" . $j . ")'>" . ($j + 1) . "</a>";
                }
            }

            if ($this->pageNumber < $maxNumberOfPage - 1) {   //Next button
                $html .= "<a href='#' title='page suivante' onclick='changePage(" . ($this->pageNumber + 1) . ")'>Suivant</a>";
            }


            $html .= "</div>";
        } else {
            $html .= "<p>Aucun item ne correspond!</p>";
        }

        echo $html;
    }

    //Displays the next products
    public function changePage($pageNumber)
    {
        $this->pageNumber = $pageNumber;
        $this->displayProduct();
    }

    //Displays the products in rows on the page
    private function displayProductRows()
    {

        $products = $this->mgrProduct->getProduct();
        $html = "";

        foreach ($products as $product) {

            $html .= "<tr id=" . $product->getId() . ">";
            $html .= "<td><input type='checkbox' class='select'/></td>";
            $html .= "<td>" . $product->getName() . "</td>";
            $html .= "<td>" . $product->getDescription() . "</td>";
            $html .= "<td><img src='" . $product->getImagePath() . "'/></td>";
            $html .= "<td>Catégorie Produit</td>";
            $html .= "<td>" . $product->getQuantity() . "</td>";
            $html .= "<td>" . $product->getPrice() . "$</td>";

            if ($product->getIsSellable() == 1) {
                $html .= "<td><input disabled checked type='checkbox'></td>";
            } else {
                $html .= "<td><input disabled type='checkbox'></td>";
            }

            $html .= "</tr>";
        }

        echo $html;
    }

    /**
     * Populate multiselect list of ingredients when creating a recipe.
     * 
     */
    public function loadAllIngredients() {
        $this->mgrProduct->getAllProducts();
        $products = $this->mgrProduct->getProduct();
        $html = "";

        foreach ($products as $product) {
            
            $html .= "<option ";
            $html .= "id=\"" . $product->getId() . "\" ";
            $html .= "value=\"" . $product->getName() . "\">";
            $html .= $product->getName() . "</div>";
        }

        echo $html;
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

    /**
     * @return mixed
     */
    public function getItemPerPage()
    {
        return $this->itemPerPage;
    }

    /**
     * @param mixed $mgrProduct
     *
     * @return self
     */
    public function setItemPerPage($itemPerPage)
    {
        $this->itemPerPage = $itemPerPage;
    }
}
