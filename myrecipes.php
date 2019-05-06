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
include_once "phpScripts/Category/CtrlCategory.php";
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
        <div class="recipe-btn-wrapper">
            <button type="button" class="btn btn-quintessentiel" data-toggle="modal" data-target="#addModal">Ajouter une recette</button>
            <button type="button" class="btn btn-quintessentiel" data-toggle="modal" data-target="#estimationModal">Estimation d'un prix</button>
        </div>

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

    <!-- Edit a recipe modal -->
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
                            <div class="invalid-input" id="invalid-recipe-name"></div>
                        </div>
                        <div class="switch-wrapper">
                            <label class="switch">
                                <input type="checkbox" id="switch-custom-recipe" onchange="changeLabelCheckBox('#editModal')" disabled>
                                <span class="slider round"></span>
                            </label>
                            <label for="switch-custom-recipe" class="custom-recipe" id="custom-recipe-title"></label>
                        </div>
                        <div class="form-group">
                            <label for="recipe-ingredients" class="col-form-label">Ingrédients</label>
                            <select class="form-control selectpicker" data-live-search="true" onchange="editRecipeAddIngredientModal(this)" id="recipe-ingredients" data-live-search="true" disabled>
                                <?php
                                $ctrlP = new CtrlProduct();
                                $ctrlP->loadIngredientsOptions();
                                ?>
                            </select>
                            <div class="invalid-input" id="invalid-recipe-ingredients"></div>
                            <div id="ingredients" class="ingredients-list">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="recipe-steps" class="col-form-label">Étapes de préparation</label>
                            <textarea class="form-control" id="recipe-steps" disabled></textarea>
                            <div class="invalid-input" id="invalid-recipe-steps"></div>
                        </div>
                        <div class="form-group">
                            <label for="recipe-product" class="col-form-label">Nom du produit final</label>
                            <input type="text" class="form-control" id="recipe-product" disabled>
                            <div class="invalid-input" id="invalid-recipe-product"></div>
                        </div>
                        <div class="form-group">
                            <label for="product-description" class="col-form-label">Description du produit final</label>
                            <textarea type="text" class="form-control" id="product-description" disabled></textarea>
                            <div class="invalid-input" id="invalid-product-description"></div>
                        </div>
                        <div class="form-group">
                            <label for="product-categories" class="col-form-label">Catégories du produit final</label>
                            <select class="form-control selectpicker" multiple data-live-search="true" id="product-categories" disabled>
                                <?php
                                $ctrlC = new CtrlCategory();
                                $ctrlC->loadCategoriesOptions();
                                ?>
                            </select>
                            <div class="invalid-input" id="invalid-product-categories"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" title="Sortir du formulaire">Annuler</button>
                    <button type="button" class="btn btn-secondary" onclick="confirmationDelete()" title="Supprimer la recette">Supprimer</button>
                    <button type="button" class="btn btn-quintessentiel" onclick="enableEditing()" title="Activer la modification des champs">Modifier</button>
                    <button type="button" class="btn btn-quintessentiel" onclick="validateForm('#editModal', 'updateRecipe')" title="Créer la nouvelle recette">Sauvegarder</button>
                </div>
            </div>
        </div>
    </div>

    <!-- New recipe modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addRecipeModal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRecipeModal">Ajouter une nouvelle recette</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="recipe-name" class="col-form-label">Nom de la recette</label>
                            <input type="text" class="form-control" id="recipe-name">
                            <div class="invalid-input" id="invalid-recipe-name"></div>
                        </div>
                        <div class="switch-wrapper">
                            <label class="switch">
                                <input type="checkbox" id="switch-custom-recipe" onchange="changeLabelCheckBox('#addModal')">
                                <span class="slider round"></span>
                            </label>
                            <label for="switch-custom-recipe" class="custom-recipe" id="custom-recipe-title">Recette standard</label>
                        </div>
                        <div class="form-group">
                            <label for="recipe-ingredients" class="col-form-label">Ingrédients</label>
                            <select class="form-control selectpicker" data-live-search="true" onchange="addRecipeAddIngredientModal(this)" id="recipe-ingredients">
                                <?php
                                $ctrlP = new CtrlProduct();
                                $ctrlP->loadIngredientsOptions();
                                ?>
                            </select>
                            <div class="invalid-input" id="invalid-recipe-ingredients"></div>
                            <div id="ingredients" class="ingredients-list">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="recipe-steps" class="col-form-label">Étapes de préparation</label>
                            <textarea class="form-control" id="recipe-steps"></textarea>
                            <div class="invalid-input" id="invalid-recipe-steps"></div>
                        </div>
                        <div class="form-group">
                            <label for="recipe-product" class="col-form-label">Nom du produit final</label>
                            <input type="text" class="form-control" id="recipe-product">
                            <div class="invalid-input" id="invalid-recipe-product"></div>
                        </div>
                        <div class="form-group">
                            <label for="product-description" class="col-form-label">Description du produit final</label>
                            <textarea type="text" class="form-control" id="product-description"></textarea>
                            <div class="invalid-input" id="invalid-product-description"></div>
                        </div>
                        <div class="form-group">
                            <label for="product-categories" class="col-form-label">Catégories du produit final</label>
                            <select class="form-control selectpicker" multiple data-live-search="true" id="product-categories" data-live-search="true">
                                <?php
                                $ctrlC = new CtrlCategory();
                                $ctrlC->loadCategoriesOptions();
                                ?>
                            </select>
                            <div class="invalid-input" id="invalid-product-categories"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-quintessentiel" onclick="validateForm('#addModal', 'createRecipe')">Sauvegarder</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Estimation modal -->
    <div class="modal fade" id="estimationModal" tabindex="-1" role="dialog" aria-labelledby="estimationPriceModal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="estimationPriceModal">Estimation du prix d'un produit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="recipe-ingredients" class="col-form-label">Ingrédients</label>
                            <select class="form-control selectpicker" data-live-search="true" onchange="estimatePriceAddIngredientModal(this)" id="recipe-ingredients">
                                <?php
                                $ctrlP = new CtrlProduct();
                                $ctrlP->loadIngredientsOptions();
                                ?>
                            </select>
                            <div class="invalid-input" id="invalid-recipe-ingredients"></div>
                            <div id="ingredients" class="ingredients-list">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="cost-price" class="col-form-label">Prix coûtant</label>
                                <input type="text" class="form-control disabled-input" id="cost-price" value="0.00 $" disabled>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="profit-margin" class="col-form-label">Marge de profit (%)</label>
                                <input type="number" step="1" min="0" max="100" class="form-control" id="profit-margin" value="0">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="suggested-price" class="col-form-label">Prix suggéré</label>
                                <input type="text" class="form-control disabled-input" id="suggested-price" value="0.00 $" disabled>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Deletion confirmation modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Êtes-vous certain de vouloir supprimer cette recette?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-quintessentiel" onclick="proceedWithRecipeDeletion('#confirmationModal', 'deleteRecipe')">Oui</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                </div>
            </div>
        </div>
    </div>

</body>

<script src="javascript/manageRecipes.js"></script>

</html>