<?php
/****************************************
Fichier : myCategories.php
Auteur : Philippe Audit-Allaire
Fonctionnalité : W3 - Gestion des recettes
Date : 2019-04-17
Vérification :
Date Nom Approuvé
=========================================================
Historique de modifications :
Date Nom Description
=========================================================
 ****************************************/

session_start();

include_once "phpScripts/Category/CtrlCategory.php";

if($_SESSION["username"]!="admin"){
    echo "<script> location.href='Catalog.php'</script>";
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width = device-width, initial-scale = 1.0">
    <link href="css/style_index.css" rel=stylesheet>
    <script type="text/javascript" src="javascript/manageCategories.js"></script>
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <title>Mes categories</title>
</head>

<body onload="addListeners()">

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
            <tbody id="categories">
                <?php
                $ctrlC = new CtrlCategory();
                $ctrlC->loadAllCategories();
                ?>
            </tbody>
        </table>
    </div>

    <!-- Edit a category modal -->
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
                            <input type="text" class="form-control" id="edit-category-name" disabled>
                        </div>
                        <div class="form-group">
                            <label for="category-activity" class="col-form-label">État d'activité de la catégorie</label>
                            <select class="form-control selectpicker" data-live-search="true" id="edit-category-activity" data-live-search="true" disabled>
                              <option value="inactive">Inactif</option>
                              <option value="active">actif</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="category-description" class="col-form-label">Description de la catégorie</label>
                            <textarea class="form-control" id="edit-category-description" disabled></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-quintessentiel" onclick="enableEditing()">Modifier</button>
                    <button type="button" class="btn btn-quintessentiel" id="editCategorySaveBtn">Sauvegarder</button>
                </div>
            </div>
        </div>
    </div>

    <!-- New Category modal -->
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
                            <input type="text" class="form-control" id="add-category-name">
                        </div>
                        <div class="form-group">
                            <label for="category-description" class="col-form-label">Description de la catégorie</label>
                            <input type="text" class="form-control" id="add-category-description">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-quintessentiel" id= "addCategorySaveBtn">Sauvegarder</button>
                </div>
            </div>
        </div>
    </div>

</body>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
  integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
  integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>
