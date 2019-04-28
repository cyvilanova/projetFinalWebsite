<?php
/****************************************
Fichier : myrecipes.php
Auteur : Cynthia Vilanova
Fonctionnalité : W3 - Gestion des recettes
Date : 2019-04-17
Vérification :
Date Nom Approuvé
=========================================================
Historique de modifications :
Date Nom Description
=========================================================
 ****************************************/
?>

<?php
include_once "phpScripts/Recipe/CtrlRecipe.php";
include_once "phpScripts/Product/CtrlProduct.php";
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width = device-width, initial-scale = 1.0">
    <link href="css/style_index.css" rel=stylesheet>
    <title>Mes recettes</title>
</head>

<body>

    <?php include("nav_admin.html"); ?>
    <div class="page-title-bar">
        <h1>Mes recettes</h1>
    </div>

    <div class="recipes-wrapper table-responsive">
        <button type="button" class="btn btn-add-recipe">Ajouter une recette</button>

        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <td>#</td>
                <td>Nom</td>
                <td>Produit</td>
                <td>Description</td>
                <td>Prix</td>
                <td>Personnalisée</td>
            </thead>
            <tbody id="products">
                <?php
                $ctrlR = new CtrlRecipe();
                $ctrlR->loadAllRecipesTable();
                ?>
            </tbody>
        </table>
    </div>


    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editRecipeModal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editRecipeModal">Modifier ou supprimer une recette</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="recipe-name" class="col-form-label">Nom de la recette</label>
                            <input type="text" class="form-control" id="recipe-name" disabled>
                        </div>
                        <div class="form-group">
                            <label for="recipe-ingredients" class="col-form-label">Ingrédients</label>
                            <select class="form-control selectpicker" data-live-search="true" onchange="addIngredient(this)" id="recipe-ingredients" data-live-search="true" disabled>
                                <?php
                                $ctrlP = new CtrlProduct();
                                $ctrlP->loadAllIngredients();
                                ?>
                            </select>
                            <div id="ingredients" class="ingredients-list">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="recipe-steps" class="col-form-label">Étapes de préparation</label>
                            <textarea class="form-control" id="recipe-steps" disabled></textarea>
                        </div>
                        <div class="form-group">
                            <label for="recipe-product" class="col-form-label">Produit final</label>
                            <input type="text" class="form-control" id="recipe-product" disabled>
                        </div>
                        <div class="form-group">
                            <label for="recipe-description" class="col-form-label">Description du produit final</label>
                            <input type="text" class="form-control" id="recipe-description" disabled>
                        </div>
                        <div class="form-group">
                            <label for="product-categories" class="col-form-label">Catégories du produit final</label>
                            <select class="form-control selectpicker" multiple data-live-search="true" id="product-categories" data-live-search="true" disabled>
                                <option>Mustard</option>
                                <option>Ketchup</option>
                                <option>Relish</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" onclick="enableEditing()">Modifier</button>
                    <button type="button" class="btn btn-primary">Sauvegarder</button>
                </div>
            </div>
        </div>
    </div>

</body>

<script src="javascript/manageRecipes.js"></script>

</html>
