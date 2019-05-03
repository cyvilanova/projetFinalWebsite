<?php
/****************************************
Fichier : MgrOrder.php
Auteure : Catherine Bronsard
Fonctionnalité : Commandes clients
Date : 2019-04-18
Vérification :
Date Nom Approuvé
=========================================================
Historique de modifications :
Date Nom Description
05-02 David Gaulin Ajout de la fonction de paiement
=========================================================
 ****************************************/

require_once __DIR__ . '/../QueryEngine.php';
require_once __DIR__ . '/../Shipping/MgrShipping.php';
require_once __DIR__ . '/Order.php';
require_once __DIR__ . '/../Product/Product.php';
require_once __DIR__ . '/../Product/CtrlProduct.php';
require_once __DIR__ . '/../Stripe/init.php';

/**
 *
 */
class MgrOrder
{

    private $shipping;
    private $query_engine;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->shipping = new MgrShipping();
        $this->query_engine = new QueryEngine();
    }

    /**
     * Get All Orders in an ArrayList
     *
     * @return void
     */
    public function getAllOrders()
    {
        // TODO -> à refaire, pas pratique /!\
        $query = "SELECT `order`.`id_order`, `client`.`name` AS 'client_name', `client`.`address`, `product`.`name` AS 'product_name', `ta_order_product`.`quantity`
			FROM `order` INNER JOIN `state` ON `order`.id_state = `state`.id_state
			INNER JOIN `client` ON `client`.`id_client` = `order`.`id_client`
			INNER JOIN `ta_order_product` ON `ta_order_product`.`id_order` = `order`.`id_order`
			INNER JOIN `product` ON `product`.`id_product` = `ta_order_product`.`id_product`
			WHERE `state`.name != 'Fermée'";

        $resultSet = $this->query_engine->executeQuery($query);

        return $resultSet;
    }

    /**
     * Add an order to the database
     *
     * @param  Order $order
     * @param  int $id_client
     * @param  int $id_method
     */
    public function insertOrder($order, $id_client, $id_method)
    {
        $insertOrder = "INSERT INTO `order` (`id_order`, `id_client`, `id_user`, `id_state`, `id_method`, `tps`, `tvq`, `total`) VALUES (DEFAULT, :client, 1, 2, :method, :tps, :tvq, :total)";

        $parametersOrders =
            [
            ":client" => $id_client,
            ":method" => $id_method,
            ":tps" => $order->calculateTPS(),
            ":tvq" => $order->calculateTVQ(),
            ":total" => $order->getTotal(),
        ];

        if (!$this->query_engine->executeQuery($insertOrder, $parametersOrders)) {
            echo "Erreur lors de l'ajout de la commande";
        }

        insertProducts($order);
    }

    /**
     * Add products to an order in the database
     *
     * @param Order $order
     */
    private function insertProducts($order)
    {
        $insertProductOrders = "INSERT INTO `ta_order_product` (`id_order`, `id_product`, `quantity`) VALUES (:id_order, id_product, :quantity)";

        $last_id = $this->query_engine->getLastInsertedId();

        foreach ($order->getProducts() as $product) {
            $parametersProductOrder =
                [
                ":id_order" => $last_id,
                ":id_product" => $product->getId(),
                ":quantity" => $product->getQuantity(),
            ];

            if (!$this->query_engine->executeQuery($insertProductOrders, $parametersProductOrder)) {
                echo "Erreur lors de l'ajout des produits de la commande";
            }
        }
    }

    /**
     * Delete an order from the database
     *
     * @param  int $id_order
     */
    public function deleteOrder($id_order)
    {
        deleteProducts();

        $deleteOrder = "DELETE FROM order WHERE `id_order` = :id_order";
        $parametersOrder =
            [
            ":id_order" => $id_order,
        ];
        if (!$this->query_engine->executeQuery($deleteOrder, $parametersOrder)) {
            echo "Erreur lors de la suppression de la commande";
        }
    }

    /**
     * Delete the products related to an order
     *
     * @param  int $id_order
     */
    private function deleteProducts($id_order)
    {
        $deleteProducts = "DELETE FROM ta_order_product WHERE `id_order` = :id_order";
        $parametersProductOrder =
            [
            ":id_order" => $id_order,
        ];
        if (!$this->query_engine->executeQuery($deleteProducts, $parametersProducts)) {
            echo "Erreur lors de la suppression des produits de la commande";
        }

    }

    /**
     * Update an order to the data base
     *
     * @param  Order $order
     * @param  int $id_client
     */
    public function updateOrder($order, $id_client)
    {
        deleteProducts($order->getId());

        $query = "UPDATE `order` SET `id_client` = :id_client, `tps` = :tps, `tvq` = :tvq, `total` = :total WHERE `order`.`id_order` = :id_order";
        $parametersOrders =
            [
            "id_order" => $order->getId(),
            ":id_client" => $id_client,
            ":tps" => $order->calculateTPS(),
            ":tvq" => $order->calculateTVQ(),
            ":total" => $order->getTotal(),
        ];
        if (!$this->query_engine->executeQuery($deleteOrder, $parametersOrder)) {
            echo "Erreur lors de la modification de la commande";
        }
        insertProducts($order);
    }

    /**
     * Calculate the price of an order (via the products' prices)
     *
     * @param  Order $order
     */
    public function calculatePrice($order)
    {
        $order->setPrice(0);
        $total = 0;
        foreach ($order->getProducts() as $p) {
            $total .= $p->getPrice();
        }
        $order->setPrice($total);
        calculateTaxes();
    }

    /**
     * Calculate the taxes of an order with the price
     *
     * @param  Order $order
     */
    public function calculateTaxes($order)
    {
        $taxes = calculateTPS($order);
        $taxes .= calculateTVQ($order);
        $order->setTotal($order->getPrice() + $taxes);
        return $taxes;
    }

    /**
     * Calculate the TPS of an order with the price
     *
     * @param  Order $order
     */
    public function calculateTPS($order)
    {
        return $order->getPrice() * 0.05;
    }

    /**
     * Calculate the TVQ of an order with the price
     *
     * @param  Order $order
     */
    public function calculateTVQ($order)
    {
        return $order->getPrice() * 0.09975;
    }

    /**
     * Makes a payment using the stripe API
     *
     * @param $tokenId the token id created by the user
     * @param $price Price to charge
     */

    public function makePayment($tokenId, $price)
    {

        $price *= 100;

        try {
            \Stripe\Stripe::setApiKey("sk_test_IHvUqWlOZpF6fpSXlX9k119n00Cf1LJM5v");

            $charge = \Stripe\Charge::create([
                'amount' => $price,
                'currency' => 'cad',
                'description' => 'Commande quintessentiel',
                'source' => $tokenId,
            ]);

        } catch (\Stripe\Error\Card $e) {
            //When a card is declined
            return 2;
            echo "carte invalide!";
        }
        catch (Exception $e) {
            // Something else happened, completely unrelated to Stripe
            return 3;
        }

        return 1; //worked perfectly
    }

    public function getTotalById($id_order){ //Gets the total for an order

        $query = "SELECT total FROM `order` WHERE id_order = :id_order";
        $parametersOrder =
            [
            "id_order" => $id_order,
        ];

        $result = $this->query_engine->executeQuery($query, $parametersOrder);

        if (!$result) {
            echo "Erreur lors de la sélection du prix de la commande";
        }
        else{
            $total = $result->fetch();
            
            return $total["total"];
        }

        echo "price calculated";
    }

}
