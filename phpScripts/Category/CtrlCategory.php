<?php
/****************************************
Fichier : CtrlCategory.php
Auteur : Philippe Audit-Allaire
Fonctionnalité : W6- Gestion de categorie
Date : 2019-04-19
****************************************/

include_once "MgrCategory.php";

  class CtrlCategory{
    private $mgrCategory;
    private $pageNumber;
    private $pageItems;

    public function __construct(){
    $this->mgrCategory = new MgrCategory();
    $this->pageNumber = 0;
    $this->pageItems = 10;
    }

    /**
    * Loads all the categories from the database
    *
    */
    public function loadAllCategories(){
      $this->pageNumber = 0;
      $categoryList = $this->mgrCategory->selectAllCategories();
      $this->displayCategoriesRows();
    }

    /**
    * Displays the categories in a table
    * @return string of the html code to include in the html page myCategories
    *
    */
    private function displayCategoriesRows(){
      $categories = $this->mgrCategory->getCategories();
      $html = "";

      foreach ($categories as $category) {

      $html .= "<tr data-toggle=\"modal\" data-target=\"#editModal\" onclick=\"editCategory('".$category->getId()."','".$category->getName()."','".$category->getActive()."','".$category->getDescription()."'".")\" title=\"Modifier la categorie\" id=\"" . $category->getId() . "\">";
      $html .= "<td>" . $category->getId() . "</td>";
      $html .= "<td>" . $category->getName() . "</td>";
      if($category->getActive()==1){
      $html .= "<td>Actif</td>";
      }
      else{
      $html .= "<td>Inactif</td>";
      }
      $html .= "<td>" . $category->getDescription() . "</td>";

      $html .= "</tr>";
      }

      echo $html;
    }

    /**
    * Adds a category to the database
    * @param $name the name of the category to create
    * @param $description the description of the category to create
    */
    public function addCategory($name, $description){
      $newCategory = new Category(1,$name, 1, $description);
      $this->mgrCategory->addCategory($newCategory);
    }

    /**
    * Adds a category to the database
    * @param $id the id of the category to edit
    * @param $name the name of the category to edit
    * @param $activity the state of activity of the category to edit
    * @param $description the description of the category to edit
    */
    public function editCategory($id,$name,$activity,$description){
      $newCategory = new Category($id,$name, $activity, $description);
      $this->mgrCategory->editCategory($newCategory);
    }

    public function loadCategoriesOptions()
    {
      $this->mgrCategory->selectAllCategories(1);
      $categories = $this->mgrCategory->getCategories();
      $html = "";

      foreach ($categories as $category) {

          $html .= "<option title=\"" . $category->getDescription() . "\" ";
          $html .= "id=\"" . $category->getId() . "\" ";
          $html .= "class=\"product-category\" ";
          $html .= "value=\"" . $category->getId() . "\">";
          $html .= $category->getName() . "</div>";
      }

      echo $html;
    }

    /**
    * Deletes a category to the database
    * @param $id the id of the category to delete
    * @param $name the name of the category to delete
    * @param $description the description of the category to delete
    */
    public function deleteCategory($id,$name,$description){
      $newCategory = new Category($id,$name, 0, $description);
      $this->mgrCategory->deleteCategory($newCategory);
    }

  }
?>
