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
 =========================================================
****************************************/

class Category
{
  private $id; // Identification number of the category
  private $name;  // Name of the category
  private $active;  // If the category is active
  private $description; // Description of the category

  /**
   * Category constructor with parameters.
   * @param int $id the identification number of the Category
   * @param string $name the name of the Category
   * @param boolean $active the state of activity of the category
   * @param string $description the description of the category
   * 
   */
  public function __construct($id, $name, $active, $description)
  {
    $this->setId($id);
    $this->setName($name);
    $this->setActive($active);
    $this->setDescription($description);
  }

  /**
   *Gets the id of the category
   * @return int $id of the category
   * 
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   *Sets the id of the category
   * @param int $id
   * 
   */
  public function setId($id)
  {
    $this->id = $id;
  }

  /**
   *Gets the name of the category
   * @return string $name of the category
   * 
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   *Sets the name of the category
   * @param string $name
   * 
   */
  public function setName($name)
  {
    $this->name = $name;
  }

  /**
   *Gets the activity of the category
   * @return boolean $active of the category
   * 
   */
  public function isActive()
  {
    return $this->active;
  }

  /**
   *Sets the activity of the category
   * @param boolean $active
   * 
   */
  public function setActive($active)
  {
    $this->active = $active;
  }

  /**
   *Gets the description of the category
   * @return string $description of the category
   * 
   */
  public function getDescription()
  {
    return $this->description;
  }

  /**
   *Sets the description of the category
   * @param string $description
   * 
   */
  public function setDescription($description)
  {
    $this->description = $description;
  }
}

?>
