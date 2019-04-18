<?php
/****************************************
Fichier : QueryEngine.php
Auteur : David Gaulin
Fonctionnalité : Moteur de requête DB
Date : 2019-04-16
Vérification :
Date Nom Approuvé
=========================================================
Historique de modifications :
Date Nom Description
=========================================================
 ****************************************/

include_once "MgrDbConnection.php";

class QueryEngine
{

    private $db; //MgrDbConnection object

    public function __construct()
    {
        $this->db = new MgrDbConnection("quintessentieldb", "root", "", true);
    }

    //Delete when no longer needed
    public function test()
    {
        //Use this function to test if the connection works
        $add = $this->db->getDbConn()->query("INSERT INTO category VALUES (DEFAULT,'test',true,'Tessst')");
    }

    //Adds a product to the DB
    public function addProduct($name, $isSellable, $description, $price, $quantity)
    {
        $conn = $this->db->getDbConn();

        $adding = $conn->prepare("INSERT INTO Product VALUES (DEFAULT,:name,:isSellable,:description,:price,:quantity)");
        $adding->bindValue(":name", $name);
        $adding->bindValue(":isSellable", $isSellable);
        $adding->bindValue(":description", $description);
        $adding->bindValue(":price", $price);
        $adding->bindValue(":quantity", $quantity);

        if (!$adding->execute()) {
            throw new Exception("Error trying to add a new product");
        } else {
            echo 'Product added';
        }
    }

    //Gets every product from the DB
    public function getAllProducts($filter)
    {

        $conn = $this->db->getDbConn();
        $loading;

        $query = "SELECT * FROM Product ";

        if($filter != null){
            $query .= "ORDER BY ".$filter;
        }

        if (!$loading = $conn->query($query)) {
            throw new Exception("Error trying to load the product list");
        } else {
            return $loading;
        }
    }

    //Gets every sellable products from the DB
    public function getAllSellables($filter)
    {
        $conn = $this->db->getDbConn();
        $loading;
        $query = "SELECT * FROM Product WHERE is_sellable = 1";

        if($filter != null){
            $query .= "ORDER BY ".$filter;
        }

        if (!$loading = $conn->query($query)) {
            throw new Exception("Error trying to load the product list");
        } else {
            return $loading;
        }

    }

    //Gets every ingredients (products) from a recipe
    public function getIngredients($idRecipe)
    {
        $conn = $this->db->getDbConn();

        $query = "SELECT * FROM Product INNER JOIN ta_recipe_product ON Product.id_product = ta_recipe_product.id_product WHERE ta_recipe_product.id_recipe = :idRecipe";

        $loading = $conn->prepare($query);
        $loading->bindValue(":idRecipe", $idRecipe);

        if (!$loading->execute()) {
            throw new Exception("Error trying to add a new product");
        } else {
            return $loading;
        }
    }

    public function getProductsByName($name,$filter)
    {   
        $conn = $this->db->getDbConn();

        $query = "SELECT * FROM Product WHERE name LIKE :name ";

        if($filter != null){
            $query .= "ORDER BY ".$filter;
        }

        $loading = $conn->prepare($query);
        $loading->bindValue(":name", '%'.$name.'%');

        if (!$loading->execute()) {
            throw new Exception("Error trying load products by name");
        } else {
            return $loading;
        }
    }
}
