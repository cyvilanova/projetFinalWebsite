<?php

echo $_POST['id'] ."\n";
echo $_POST['isNew'] ."\n";
echo $_POST['name'] ."\n";
echo $_POST['steps'] ."\n";
echo $_POST['productName'] ."\n";
echo $_POST['productDesc'] ."\n";
echo $_POST['categories'] ."\n";

$categoriesData = html_entity_decode( $_POST['categories'] );
$formattedCategoriesData = json_decode($categoriesData);

$ingredientsData = html_entity_decode( $_POST['ingredients'] );
$formattedIngredientsData = json_decode($ingredientsData);

foreach($formattedIngredientsData as $a) {
  foreach($a as $b)
    echo $b;
}

?>
