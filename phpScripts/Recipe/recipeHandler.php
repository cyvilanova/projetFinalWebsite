<?php

include_once "CtrlRecipe.php";

$categoriesData = html_entity_decode( $_POST['categories'] );
$formattedCategoriesData = json_decode($categoriesData);

$ingredientsData = html_entity_decode( $_POST['ingredients'] );
$formattedIngredientsData = json_decode($ingredientsData);

foreach($formattedIngredientsData as $a) {
  foreach($a as $b)
    echo $b;
}

$ctrlRecipe = new CtrlRecipe();

if(isNew) {
  $ctrlRecipe->addRecipe($_POST['name'], $_POST['isCustom'], $_POST['steps'], 
                        $_POST['productName'], $_POST['productDesc'],
                        $formattedCategoriesData, $formattedIngredientsData);
}
elseif(!isNew) {
  $ctrlRecipe->updateRecipe($_POST['id'], $_POST['name'], $_POST['steps'], 
                            $_POST['productName'], $_POST['productDesc'],
                            $formattedCategoriesData, $formattedIngredientsData);
}

?>
