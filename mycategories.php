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
include_once "phpScripts/Category/CtrlCategory.php";
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width = device-width, initial-scale = 1.0">
    <link href="css/style_index.css" rel=stylesheet>
    <title>Mes categories</title>
</head>

<body>

    <?php include("nav_admin.html"); ?>
    <div class="page-title-bar">
        <h1>Mes categories</h1>
    </div>

    <div class="recipes-wrapper table-responsive">
        <button type="button" class="btn btn-quintessentiel" data-toggle="modal" data-target="#addModal">Ajouter une catégorie</button>

        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <td>#</td>
                <td>Nom</td>
                <td>Acivité</td>
                <td>Description</td>
            </thead>
            <tbody id="products">
                <?php
                $ctrlC = new CtrlCategory();
                $ctrlC->loadAllCategories();
                ?>
            </tbody>
        </table>
    </div>

    <!-- Edit a recipe modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryModal">Modifier ou supprimer une catégorie</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="category-name" class="col-form-label">Nom de la catégorie</label>
                            <input type="text" class="form-control" id="category-name" disabled>
                        </div>
                        <div class="form-group">
                            <label for="category-activity" class="col-form-label">État d'activité de la catégorie</label>
                            <select class="form-control selectpicker" data-live-search="true" onchange="editCategoryActivityModal(this)" id="category-activity" data-live-search="true" disabled>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="category-description" class="col-form-label">Description de la catégorie</label>
                            <textarea class="form-control" id="category-description" disabled></textarea>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-quintessentiel" onclick="enableEditing()">Modifier</button>
                    <button type="button" class="btn btn-quintessentiel">Sauvegarder</button>
                </div>
            </div>
        </div>
    </div>

    <!-- New recipe modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModal">Ajouter une nouvelle catégorie</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="category-name" class="col-form-label">Nom de la categorie</label>
                            <input type="text" class="form-control" id="category-name">
                        </div>
                        <div class="form-group">
                            <label for="category-description" class="col-form-label">Description de la catégorie</label>
                            <input type="text" class="form-control" id="category-Description">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-quintessentiel">Sauvegarder</button>
                </div>
            </div>
        </div>
    </div>

</body>

<script src="javascript/manageRecipes.js"></script>

</html>
