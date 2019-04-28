<?php
/****************************************
Fichier : Product.php
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

class Product implements JsonSerializable
{
    private $id;
    private $name;
    private $categories; //array of categories in wich the product belongs
    private $isSellable;
    private $price;
    private $description;
    private $quantity;
    private $imagePath;
    private $volumeUsed; // Quantity of product used in recipe in mL

    public function __construct($name, $categories, $isSellable, $price, $description, $quantity, $imagePath, $volumeUsed = 0)
    {
        $this->name = $name;
        $this->categories = $categories;
        $this->isSellable = $isSellable;
        $this->price = $price;
        $this->description = $description;
        $this->quantity = $quantity;
        $this->imagePath = $imagePath;
        $this->volumeUsed = $volumeUsed;
    }

    /**
     * Makes an array with all the properties of the object 
     * and returns it for the js to use.
     * @return array of all the properties of the object
     * 
     */
    public function jsonSerialize() {
        return array(
            'id' => $this->id,
            'name' => $this->name,
            'isSellable' => $this->isSellable,
            'price' => $this->price,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'imagePath' => $this->imagePath,
            'volumeUsed' => $this->volumeUsed
        );
    }
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     *
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param mixed $categories
     *
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;
    }

    /**
     * @return mixed
     */
    public function getIsSellable()
    {
        return $this->isSellable;
    }

    /**
     * @param mixed $isSellable
     *
     */
    public function setIsSellable($isSellable)
    {
        $this->isSellable = $isSellable;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     *
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     *
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     *
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }


    /**
     * @return mixed
     */
    public function getImagePath()
    {
        return $this->imagePath;
    }

    /**
     * @param mixed $quantity
     *
     */
    public function setImagePath($imagePath)
    {
        $this->imagePath = $imagePath;
    }

    /**
     * Sets the quantity of product used in a recipe in mL
     * @param int $volume
     *
     */
    public function setVolumeUsed($volume)
    {
        $this->volumeUsed = $volume;
    }
}
