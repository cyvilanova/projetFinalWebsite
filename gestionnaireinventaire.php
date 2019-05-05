<?php
    include_once "phpScripts/Product/CtrlProduct.php";
    include_once "phpScripts/Product/Product.php";
    include_once "phpScripts/Product/MgrProduct.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width = device-width, initial-scale = 1.0">
        <link href="css/style_index.css" rel=stylesheet>
        <title>Gestionnaire d'inventaire </title>
    </head>

    <body id="body">
        <div class="modal-container" id="modals-window">
            <div class="modals panel" id="modal-add">

                <div class="panel-header add">
                    <h3>Ajouter un produit</h3>
                </div>
                <form action="gestionnaireInventaire.php" method="post" enctype="multipart/form-data">

                    <input type="hidden" name="action" value="add"/>
                    <input type="hidden" name="prod" id="selected_prod_id" value=""/>

                    <div class="panel-body col-12">
                        <div class="col-xs-12 col-sm-6">
                            <label for="product_name">Produit</label>
                            <br />
                            <input type="text" class="col-12" name="product_name" id="product_name">
                            <br />
                            <label for="product_desc">Description</label>
                            <br />
                            <textarea rows=4 cols="22" class="col-12" name="product_desc" id="product_desc"></textarea>
                            <br />
                            <label for="product_image">Image</label>
                            <br />
                            <input type="file" accept="image/png,image/jpeg,image/jpg" name="product_image" class="col-4" id="product_image" style="">
                            <input class="col-8" type="text" readonly id="product_image_text" name="path">
                            <a class="file-btn col-4" id="btnUploadImage">Choisir</a>
                        </div>
                         <div class="col-xs-12 col-sm-6">
                            <label for="product_category">Catégorie</label>
                            <br />
                            <select class="col-12" name="product_category" id="product_category">

                            </select>
                            <br />
                            <label for="product_qty">Quantité</label>
                            <br />
                            <input type="number" min="0" step="1" class="col-12" name="product_qty" id="product_qty">
                            <br />
                            <label for="product_price">Prix</label>
                            <br />
                            <input type="number" step="0.01" min="0" class="col-12" name="product_price" id="product_price">
                            <br />
                            <label for="product_visible">Visible</label>
                            <input type="checkbox" value="visible" name="product_visible" id="product_visible">
                        </div>
                        <div class="col-sm-12">
                            <br />
                            <button type=submit class="addProd-btn add">Ajouter</button>
                            <a class="cancel-btn default">Annuler</a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modals panel" id="modal-edit">

                <div class="panel-header edit">
                    <h3>Modifier un produit</h3>
                </div>
                <form action="gestionnaireInventaire.php" method="post" enctype="multipart/form-data">

                    <input type="hidden" name="action" value="edit"/>
                    <input type="hidden" name="prod" id="selected_prod_id" value=""/>
                    <div class="panel-body col-12">
                        <div class="col-xs-12 col-sm-6">
                            <label for="product_name">Produit</label>
                            <br />
                            <input type="text" class="col-12" name="product_name" id="product_name">
                            <br />
                            <label for="product_desc">Description</label>
                            <br />
                            <textarea rows=4 cols="22" class="col-12" name="product_desc" id="product_desc"></textarea>
                            <br />
                            <label for="product_image">Image</label>
                            <br />
                            <input type="file" accept="image/png,image/jpeg,image/jpg" name="product_image" class="col-4" id="product_image" style="">
                            <input class="col-8" type="text" readonly id="product_image_text" name="path">
                            <a class="file-btn col-4" id="btnUploadImage">Choisir</a>
                        </div>
                         <div class="col-xs-12 col-sm-6">
                            <label for="product_category">Catégorie</label>
                            <br />
                            <select class="col-12" name="product_category" id="product_category">

                            </select>
                            <br />
                            <label for="product_qty">Quantité</label>
                            <br />
                            <input type="number" min="0" step="1" class="col-12" name="product_qty" id="product_qty">
                            <br />
                            <label for="product_price">Prix</label>
                            <br />
                            <input type="number" step="0.01" min="0" class="col-12" name="product_price" id="product_price">
                            <br />
                            <label for="product_visible">Visible</label>
                            <input type="checkbox" value="visible" name="product_visible" id="product_visible">
                        </div>
                        <div class="col-sm-12">
                            <br />
                            <button type=submit class="addProd-btn edit">Modifier</button>
                            <a class="cancel-btn default">Annuler</a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modals panel" id="modal-delete">

                <div class="panel-header delete">
                    <h3>Supprimer un produit</h3>
                </div>
                <form action="gestionnaireInventaire.php" method="post" enctype="multipart/form-data">

                    <input type="hidden" name="action" value="delete"/>
                    <input type="hidden" name="prod" id="selected_prod_id" value=""/>
                    <div class="panel-body">

                    <p>Êtes-vous sur de vouloir supprimer "|*|" ?</p>
                        <div class="col-sm-12">
                            <br />
                            <button type=submit class="addProd-btn delete">Supprimer</button>
                            <a class="cancel-btn default">Annuler</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <?php include("nav_admin.html"); ?>

        <div class="center">

            <div class="panel col-12 col-mb-12 col-lg-12 full">

                <div class="panel-header">
                    <h3>Gestionnaire d'inventaire</h3>
                </div>

                <div class="panel-body">

                    <div class="manager-buttons-div">
                        <a class="manager-button add" id="add"><img src="images/add.png"></a>
                        <a class="manager-button edit disabled" id="edit"><img src="images/edit.png"></a>
                        <a class="manager-button delete disabled" id="delete"><img src="images/delete.png"></a>
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
                            <tbody id="products">
                                <?php
                                    $ctrl = new CtrlProduct();
                                    $ctrl->loadAllProductsTable();
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </body>

    <script src="javascript/gestionnaireInventaire.js"></script>

</html>

<?php
    $uploaded = 1;
    if(isset($_POST['action']))
    {
        $action = $_POST['action'];
        $MgrProd = new MgrProduct();
        $id = $_POST['prod'];
        $target_dir = "images/imgProducts/";
        include_once("phpScripts/Product/MgrProduct.php");
        if($_POST['action'] != "delete")
        {
            if(isset($_FILES['product_image']['tmp_name']))
            {
                $target_file = $target_dir . basename($_FILES['product_image']['name']);
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                if (file_exists($target_file))
                {
                    $uploaded = 0;
                }
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg")
                {
                    $uploaded = 0;
                }
                if($uploaded == 1)
                {
                    if(move_uploaded_file($_FILES['product_image']['tmp_name'], $target_file))
                    {
                    }
                    else
                    {
                        echo "Error occured while trying to upload the product's image";
                    }
                }
            }
            $MgrProd->getProductById($_POST['prod']);
            include_once("phpScripts/Product/Product.php");
            $name = $_POST['product_name'];
            //$categories = $_POST['product_category'];
            if(isset($_POST['product_visible']))
            {
                $isSellable = 1;
            }
            else
            {
                $isSellable = 0;
            }
            $price = $_POST['product_price'];
            $description = $_POST['product_desc'];
            $quantity = $_POST['product_qty'];
            $path = basename($_POST['path']);
            $prod = new Product($name, $categories, $isSellable, $price, $description, $quantity, $path);
        }
        if($action == "edit")
        {
            $prod->setId($id);
            $MgrProd->updateProduct($prod);
        }
        else if($action == "add")
        {
            $MgrProd->insertProduct($prod);
        }
        else if($action == "delete")
        {
            $MgrProd->removeProduct($id);
        }
        echo "<meta http-equiv='refresh' content='0'>";
    }
?>
