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

    
    /**
     * Loads all the products and
     * displays it in tables
     * */
    public function loadAllProductsTable()
    {
        $this->setPageNumber(0);
        $productList = $this->getMgrProduct()->getAllProducts();
        $this->displayProductRows();
    }

    
    /**
     * Loads every products and 
     * displys it as a product
     * $filter: ORDER BY $filter
     * */
    public function loadAllProducts($filter = null)
    {
        $this->pageNumber = 0;
        $productList = $this->getMgrProduct()->getAllProducts($filter);
        $this->displayProduct();
    }

    
    /**
     * Loads all the sellables products
     * */
    public function loadAllSellables()
    {
        $this->pageNumber = 0;
        $sellableProductList = $this->getMgrProduct()->getAllSellables();
        $this->displayProduct();
    }

    /**
     * Loads the products relative to
     * the given letters
     *
     * $name: letters given by the user
     * $filter: ORDER BY $filter
     * */
    public function loadProductsByName($name, $filter = null)
    {
        $this->pageNumber = 0;
        $productList = $this->getMgrProduct()->getProductsByName($name, $filter);
        $this->displayProduct();
    }

    /**
     * Displays the list of product
     * */
    private function displayProduct()
    {
        $products = $this->getMgrProduct()->getProduct();

        $from = $this->getItemPerPage() * $this->getPageNumber(); //Number of item skipped
        $to = (sizeof($products) - $from >= $this->getItemPerPage() ? $from + $this->getItemPerPage() : sizeof($products)); //Number of item to display
        $maxNumberOfPage = round(sizeof($products) / $this->getItemPerPage());

        $html = "";

        if(!empty($products)) {

            for ($i = $from; $i < $to; $i++) {
                $description = str_split($products[$i]->getDescription(),50);
                $dots = (sizeof($description) > 1 ? "..." : ""); //if description is more than 50 chars
                $description = (!empty($description) ? $description[0] : $description);

                $html .= "<div class='product'>";
                $html .= "<img src='" . $products[$i]->getImagePath() . "' alt='un produit'/>";
                $html .= "<h2>" . $products[$i]->getName() . "</h2>";
                $html .= "<p>" .  $description . $dots ."</p>";
                $html .= "<p class='bottom-text'><span class='stock'>" . $products[$i]->getQuantity() . " en stock</span>";
                $html .= "<span class='prix'>" . $products[$i]->getPrice() . "</span></p>";
                $html .= "</div>";
            }

        } else {
            $html .= "<p>Aucun item ne correspond!</p>";
        }

        $html .= $this->genertePageButton($maxNumberOfPage);

        echo $html;
    }

    /**
     * Generates the 1,2,3,previous,next, etc buttons
     * The number of buttons loaded is dynamicaly determined by
     * the number of element to show
     *
     * $maxNumberOfPage: total number of pages
     * number of elements to load divided by elements per page
     * */
    private function genertePageButton($maxNumberOfPage)
    {
        $html = "<div class='link-page-box'>";

        //Page buttons
        if ($this->getPageNumber() > 0) {
            //Previous button
            $html .= "<a href='#' title='page précédente' onclick='changePage(" . ($this->getPageNumber() - 1) . ");return false'>Précédent</a>";
        }

        for ($j = 0; $j < $maxNumberOfPage; $j++) {

            if ($this->getPageNumber() == $j) {
                //Currently on this page
                $html .= "<a href='#' title='autre page' style='color:black;' onclick='changePage(" . $j . ");return false'>" . ($j + 1) . "</a>";
            } else {
                //Other pages
                $html .= "<a href='#' title='autre page' onclick='changePage(" . $j . ");return false'>" . ($j + 1) . "</a>";
            }

        }

        if ($this->getPageNumber() < $maxNumberOfPage - 1) {
            //Next button
            $html .= "<a href='#' title='page suivante' onclick='changePage(" . ($this->getPageNumber() + 1) . ");return false'>Suivant</a>";
        }

        $html .= "</div>";

        return $html;
    }

    /**
     * Changes the page number and
     * loads the next elements
     * */
    public function changePage($pageNumber)
    {
        $this->setPageNumber($pageNumber);
        $this->displayProduct();
    }

    /**
     * Displays the product list in rows
     * */
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

    /**
     * @return mixed
     */
    public function getPageNumber()
    {
        return $this->pageNumber;
    }

    /**
     * @param mixed $mgrProduct
     *
     * @return self
     */
    public function setPageNumber($pageNumber)
    {
        $this->pageNumber = $pageNumber;
    }
}
