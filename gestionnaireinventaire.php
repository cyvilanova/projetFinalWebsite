<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width = device-width, initial-scale = 1.0">
        <link href="css/style_index.css" rel=stylesheet>
        <title>Gestionnaire d'inventaire </title>
    </head>

    <body>
        <div class="modal-container" id="modals-window">
            <div class="modals panel" id="modal-add">

                <div class="panel-header add">
                    <h3>Ajouter un produit</h3>
                </div>

                <div class="panel-body">
                    <label for="product_name">Produit</label>
                    <br />
                    <input type="text" id="product_name">
                    <br />
                    <label for="product_desc">Description</label>
                    <br />
                    <textarea rows=4 cols="21" id="product_desc"></textarea>
                </div>
            </div>

            <div class="modals panel" id="modal-edit">

                <div class="panel-header edit">
                    <h3>Modifier un produit</h3>
                </div>

                <div class="panel-body">

                </div>
            </div>

            <div class="modals panel" id="modal-delete">

                <div class="panel-header delete">
                    <h3>Supprimer un produit</h3>
                </div>

                <div class="panel-body">

                </div>
            </div>
        </div>

        <?php include("navbar.html"); ?>

        <div class="center">

            <div class="panel col-12 col-m-12 col-t-12 col-lt-12 full">

                <div class="panel-header">
                    <h3>Gestionnaire d'inventaire</h3>
                </div>

                <div class="panel-body">

                    <div class="manager-buttons-div">
                        <a class="manager-button add" id="add"><img src="images/add.png"></a>
                        <a class="manager-button edit" id="edit"><img src="images/edit.png"></a>
                        <a class="manager-button delete" id="delete"><img src="images/delete.png"></a>
                    </div>

                    <div class="inventory-manager-table">
                        <table>
                            <thead>
                                <td></td>
                                <td>Produit</td>
                                <td>Description</td>
                                <td>Image</td>
                                <td>Catégorie</td>
                                <td>Qté</td>
                                <td>Prix</td>
                                <td>Visible</td>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="radio" class="select"></td>
                                    <td>Nom Produit</td>
                                    <td>Description Produit</td>
                                    <td>Image Produit</td>
                                    <td>Catégorie Produit</td>
                                    <td>Qté Produit</td>
                                    <td>Prix Produit</td>
                                    <td><input disabled type="checkbox"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </body>

    <script src="javascript/gestionnaireInventaire.js"></script>

</html>
