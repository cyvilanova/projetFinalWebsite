<?php

include_once "CtrlRecipe.php";
$ctrlRecipe = new CtrlRecipe();

$actionToPerform = "";
$actionToPerform = $_POST['actionToPerform'];

if ($actionToPerform !== "deleteRecipe") {
  $categoriesData = html_entity_decode($_POST['categories']);
  $formattedCategoriesData = json_decode($categoriesData);

  $ingredientsData = html_entity_decode($_POST['ingredients']);
  $formattedIngredientsData = json_decode($ingredientsData);
}

if ($actionToPerform == "createRecipe") {
  $ctrlRecipe->createRecipe(
    $_POST['name'],
    $_POST['isCustom'],
    $_POST['steps'],
    $_POST['productName'],
    $_POST['productDesc'],
    $formattedCategoriesData,
    $formattedIngredientsData
  );
} else if ($actionToPerform == "updateRecipe") {
  $ctrlRecipe->updateRecipe(
    $_POST['id'],
    $_POST['name'],
    $_POST['isCustom'],
    $_POST['steps'],
    $formattedIngredientsData
  );
} else if ($actionToPerform == "deleteRecipe") {
  $ctrlRecipe->deleteRecipe($_POST['recipeId']);
}

?>
