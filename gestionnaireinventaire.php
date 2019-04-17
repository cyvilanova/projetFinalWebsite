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

                <div class="panel-body col-12">
                    <div class="col-xs-12 col-sm-6">
                        <label for="product_name">Produit</label>
                        <br />
                        <input type="text" class="col-12" id="product_name">
                        <br />
                        <label for="product_desc">Description</label>
                        <br />
                        <textarea rows=4 cols="22" class="col-12" id="product_desc"></textarea>
                        <br />
                        <label for="product_image">Image</label>
                        <br />
                        <input class="col-8" type="text" disabled id="product_image">
                        <a class="file-btn col-4">Choisir</a>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <label for="product_category">Catégorie</label>
                        <br />
                        <select class="col-12" id="product_category">

                        </select>
                        <br />
                        <label for="product_qty">Quantité</label>
                        <br />
                        <input type="number" min="0" step="1" class="col-12" id="product_qty">
                        <br />
                        <label for="product_price">Prix</label>
                        <br />
                        <input type="number" step="0.01" min="0" class="col-12" id="product_price">
                        <br />
                        <label for="product_visible">Visible</label>
                        <input type="checkbox" id="product_visible">
                    </div>
                    <div class="col-sm-12">
                        <br />
                        <a class="addProd-btn add">Ajouter</a>
                        <a class="cancel-btn default">Annuler</a>
                    </div>
                </div>
            </div>

            <div class="modals panel" id="modal-edit">

                <div class="panel-header edit">
                    <h3>Modifier un produit</h3>
                </div>

                <div class="panel-body col-12">
                    <div class="col-xs-12 col-sm-6">
                        <label for="product_name">Produit</label>
                        <br />
                        <input type="text" class="col-12" id="product_name">
                        <br />
                        <label for="product_desc">Description</label>
                        <br />
                        <textarea rows=4 cols="22" class="col-12" id="product_desc"></textarea>
                        <br />
                        <label for="product_image">Image</label>
                        <br />
                        <input class="col-8" type="text" disabled id="product_image">
                        <a class="file-btn col-4">Choisir</a>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <label for="product_category">Catégorie</label>
                        <br />
                        <select class="col-12" id="product_category">

                        </select>
                        <br />
                        <label for="product_qty">Quantité</label>
                        <br />
                        <input type="number" min="0" step="1" class="col-12" id="product_qty">
                        <br />
                        <label for="product_price">Prix</label>
                        <br />
                        <input type="number" step="0.01" min="0" class="col-12" id="product_price">
                        <br />
                        <label for="product_visible">Visible</label>
                        <input type="checkbox" id="product_visible">
                    </div>
                    <div class="col-sm-12">
                        <br />
                        <a class="addProd-btn edit">Modifier</a>
                        <a class="cancel-btn default">Annuler</a>
                    </div>
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

            <div class="panel col-12 col-mb-12 col-lg-12 full">

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
