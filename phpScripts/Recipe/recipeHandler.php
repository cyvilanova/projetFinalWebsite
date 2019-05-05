<?php

include_once "CtrlRecipe.php";

$isNew = $_POST['isNew'];

$categoriesData = html_entity_decode($_POST['categories']);
$formattedCategoriesData = json_decode($categoriesData);

$ingredientsData = html_entity_decode($_POST['ingredients']);
$formattedIngredientsData = json_decode($ingredientsData);

$ctrlRecipe = new CtrlRecipe();

// Add a new recipe
if ($isNew == "true") {
  $ctrlRecipe->createRecipe(
    $_POST['name'],
    $_POST['isCustom'],
    $_POST['steps'],
    $_POST['productName'],
    $_POST['productDesc'],
    $formattedCategoriesData,
    $formattedIngredientsData
  );
} 
elseif ($isNew == "false") { // Update a recipe
  echo $_POST['isNew'];
  echo $_POST['productId'];
  /*$ctrlRecipe->updateRecipe(
    $_POST['id'],
    $_POST['name'],
    $_POST['steps'],
    $_POST['productName'],
    $_POST['productDesc'],
    $formattedCategoriesData,
    $formattedIngredientsData
  );*/
}

?>
