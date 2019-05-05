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
    private $categories; // Array of categories in wich the product belongs
    private $isSellable; // If the product is sellable and viewable in the catalog
    private $price; 
    private $description; 
    private $quantity; // The quantity in stock
    private $imagePath; // The filename of the image
    private $volumeUsed; // Quantity of product used in recipe in mL

    /**
     * Constructor of a product
     *
     * @param  string $name
     * @param  array $categories
     * @param  boolean $isSellable
     * @param  double $price
     * @param  string $description
     * @param  int $quantity
     * @param  string $imagePath
     * @param  double $volumeUsed
     *
     */
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
            'categories' => $this->categories,
            'isSellable' => $this->isSellable,
            'price' => $this->price,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'imagePath' => $this->imagePath,
            'volumeUsed' => $this->volumeUsed
        );
    }
    
    /**
     * Gets the id of the product
     * @return int $id The id of the product
     * 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the id of a product
     * @param int $id The id of the product
     *
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Gets the name of the product
     * @return string $name The name of the product
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the name of the product
     * @param string $name The name of the product
     *
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Gets the list of categories of the product
     * @return array $categories The categories of the product
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Sets the list of categories of a product
     * @param array $categories The categories of the product
     *
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;
    }

    /**
     * Tells if the product is sellable or not
     * @return boolean
     */
    public function getIsSellable()
    {
        return $this->isSellable;
    }

    /**
     * Sets if the product is sellable or not
     * @param boolean $isSellable
     *
     */
    public function setIsSellable($isSellable)
    {
        $this->isSellable = $isSellable;
    }

    /**
     * Gets the price of the product
     * @return double $price The price of the product
     * 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Sets the price of a product
     * @param double $price The price of the product
     *
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * Gets the description of the product
     * @return string $description The description of the product
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets the description of the product
     * @param string $description The quantity in stock of the product
     *
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Gets the quantity in stock of the product
     * @return string $quantity The quantity in stock of the product
     * 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Sets the quantity in stock of the product
     * @param string $quantity The quantity in stock of the product
     *
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }


    /**
     * Gets the name of the image file 
     * @return string $imagePath
     * 
     */
    public function getImagePath()
    {
        return $this->imagePath;
    }

    /**
     * Sets the name of the image file 
     * @param string $imagePath
     *
     */
    public function setImagePath($imagePath)
    {
        $this->imagePath = $imagePath;
    }

    /**
     * Sets the quantity of product used in a recipe in mL
     * @param double $volume
     *
     */
    public function setVolumeUsed($volume)
    {
        $this->volumeUsed = $volume;
    }
}
