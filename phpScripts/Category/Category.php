<?php
/****************************************
Fichier : Category.php
Auteur : Philippe Audit-Allaire
Fonctionnalité : W - Category
Date : 2019-04-15
Vérification :
Date Nom Approuvé
=========================================================
Historique de modifications :
Date Nom Description
2019-04-19 Cynthia Vilanova JsonSerialize
=========================================================
****************************************/

 class Category implements JsonSerializable
 {
    private $id; //Identification umber of the category
    private $name;  //Name of the category
    private $active;  //If the category is active
    private $description; //Description of the category

    /**
    * Category constructor with parameters.
    * @param  mixed $id the identification number of the Category
    * @param  mixed $name the name of the Category
    * @param  mixed $active the state of activity of the category
    * @param  mixed $description the description of the category
    */
    public function __construct($id, $name, $active, $description){
      $this->setId($id);
      $this->setName($name);
      $this->setActive($active);
      $this->setDescription($description);
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
          'active' => $this->active,
          'description' => $this->description,
      );
    }

    /**
    *Gets the id of the category
    * @return int $id of the category
    */
    public function getId(){
      return $this->id;
    }

    /**
    *Sets the id of the category
    * @param mixed $id
    */
    public function setId($id){
      $this->id = $id;
    }

    /**
    *Gets the name of the category
    * @return int $name of the category
    */
    public function getName(){
      return $this->name;
    }

    /**
    *Sets the name of the category
    * @param mixed $name
    */
    public function setName($name){
      $this->name = $name;
    }

    /**
    *Gets the activity of the category
    * @return int $active of the category
    */
    public function getActive(){
      return $this->active;
    }

    /**
    *Sets the activity of the category
    * @param mixed $active
    */
    public function setActive($active){
      $this->active = $active;
    }

    /**
    *Gets the description of the category
    * @return string $description of the category
    */
    public function getDescription(){
      return $this->description;
    }

    /**
    *Sets the description of the category
    * @param mixed $description
    */
    public function setDescription($description){
      $this->description = $description;
    }
}

?>
