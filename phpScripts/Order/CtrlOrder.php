<?php
/****************************************
Fichier : MgrOrder.php
Auteure : Catherine Bronsard
Fonctionnalité : Commandes clients
Date : 2019-04-20
Vérification :
Date Nom Approuvé
=========================================================
Historique de modifications :

Date Nom Description

05-02 David Gaulin Ajout de la fonction de paiement
=========================================================
 ****************************************/
require_once __DIR__ . '/MgrOrder.php';
require_once __DIR__ . '/Order.php';
class CtrlOrder
{

    private $mgrOrder;

    /**
     * __construct
     */
    public function __construct()
    {
        $this->mgrOrder = new MgrOrder();
    }

    /**
     * Load all the orders on the gestionnaire
     */
    public function loadAllOrders()
    {
        $orders = $this->mgrOrder->getAllOrders();

        foreach ($orders as $row) {

            $element = "<tr>";
            $element .= "<td class=\"cases\"><input type=\"radio\" name=\"id\" value=\"" . $row['id_order'] . "\"> </td>";
            $element .= "<td class=\"cases\">" . $row['id_order'] . "</td>";
            $element .= "<td class=\"cases\">" . $row['client_name'] . "</td>";
            $element .= "<td class=\"cases\">" . $row['address'] . "</td>";
            $element .= "<td class=\"cases\">" . $row['product_name'] . "</td>";
            $element .= "<td class=\"cases\">" . $row['quantity'] . "</td>";
            $element .= "</tr>";

            echo $element;
        }
    }

    /**
     * Add an order to the database
     *
     * @param  double $price
     * @param  ArrayList of Products $products
     * @param  ArrayList of int $quantities
     * @param  int $id_client
     */
    public function addOrder($price, $products, $quantities, $id_client)
    {
        $order = new Order("", $price, "", $products, $quantities);
        $this->mgrOrder->insertOrder($order, $id_client, $id_method);
    }

    /**
     * Update an order in the data base
     *
     * @param  int $id_order
     * @param  int $id_client
     * @param  ArrayList of Products $product
     * @param  ArrayList of int $quantity
     * @param  string $adress
     *
     * @return void
     */
    public function editOrder($id_order, $id_client, $product, $quantity, $adress)
    {
        $order = new Order($id_order, "", "", $product, "");
        $this->mgrOrder->updateOrder($order, $id_client);
    }

    /**
     * Delete an order from the database
     *
     * @param  int $id_order
     */
    public function deleteOrder($id_order)
    {
        $this->mgrOrder->deleteOrder($id_order);
    }

    /**
     * Makes a payment via the stripe API
     *
     * @param $tokenId Id of the user's token
     * @param $order order object
     */
    public function makePayment($tokenId, $orderId)
    {

        try{
            $price = $this->mgrOrder->getTotalById($orderId);
            $response = $this->mgrOrder->makePayment($tokenId, $price);


            switch ($response) {
                case 1: //Worked perfectly
                    echo "<span class='payment-success'>Paiement effectué!</span>";
                    break;
                case 2:
                    echo "<span class='payment-error'>Carte refusée!</span>";
                    break;
                case 3:
                    echo "<span class='payment-error'>Erreur lors de la tentative de paiement.</span>";
                    break;
            }
        }
        catch(Exception $e){ //Cannot load total
            echo $e;
        }
    }
}
