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
        $this->displayProductsRows();
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
        $this->displayProducts();
    }

    
    /**
     * Loads all the sellables products
     * */
    public function loadAllSellables()
    {
        $this->pageNumber = 0;
        $sellableProductList = $this->getMgrProduct()->getAllSellables();
        $this->displayProducts();
    }

    /**
     * Loads a product by it's id
     * */
    public function loadProductById($id)
    {
        $product = $this->getMgrProduct()->getProductById($id);
        $this->displaySingleProduct();
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
        $this->displayProducts();
    }

    /**
     * Displays the list of product
     * */
    private function displayProducts()
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

                $html .= "<a class='product' href='Item.php?productId=".$products[$i]->getId()."' title='plus dinfo'>";
                $html .= "<img src='" . $products[$i]->getImagePath() . "' alt='un produit'/>";
                $html .= "<h2>" . $products[$i]->getName() . "</h2>";
                $html .= "<p>" .  $description . $dots ."</p>";
                $html .= "<p class='bottom-text'><span class='stock'>" . $products[$i]->getQuantity() . " en stock</span>";
                $html .= "<span class='prix'>" . $products[$i]->getPrice() . "$</span></p>";
                $html .= "</a>";
            }

        } else {
            $html .= "<p>Aucun item ne correspond!</p>";
        }

        $html .= $this->genertePageButton($maxNumberOfPage);

        echo $html;
    }

    #Cette function ne serait pas nécéssaire si on pouvait avoir plusieurs fichiers css..
    /**
     * Displays a single product
     * */
    private function displaySingleProduct()
    {
        $product = $this->getMgrProduct()->getProduct()[0];

        $html = "";

        $html .= "<div class='page-title-bar'>";
        $html .= "<h1>".$product->getName()."</h1>";
        $html .= "</div>";


        if(!empty($product)) {

                $html .= "<div class='single-product'>";
                $html .= "<img src='" . $product->getImagePath() . "' alt='un produit'/>";
                $html .= "<h2>" . $product->getName() . "</h2>";
                $html .= "<p class='desc'>" .  $product->getDescription() . "</p>";
                $html .= "<p class='bottom-text'><span class='stock'>" . $product->getQuantity() . " en stock</span>";
                $html .= "<span class='prix'>" . $product->getPrice() . "$</span></p>";
                $html .= "</div>";
        }
        else {
            $html .= "<p>Aucun item ne correspond!</p>";
        }

        $html .= "<p class='align-center'><a href='catalog.php' title='Page précédente'>Revenir au catalogue</a></p>";

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
        $this->displayProducts();
    }

    /**
     * Displays the product list in rows
     * */
    private function displayProductsRows()
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
