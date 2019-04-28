<?php
	/**
	 * 
	 */
	require_once __DIR__ . '/MgrOrder.php';
	require_once __DIR__ . '/Order.php';
	class CtrlOrder
	{
		
		private $mgrOrder;

		/**
		 * __construct
		 *
		 * @return void
		 */
		function __construct()
		{
			$this->mgrOrder = new MgrOrder();
		}

		/**
		 * loadAllOrders
		 *
		 * @return void
		 */
		public function loadAllOrders()
		{
			$orders = $this->mgrOrder->getAllOrders();
			#var_dump($orders);
			foreach ($orders as $row) {
				$element = "<tr>";
				$element .= "<td class=\"cases\"><input type=\"radio\" name=\"id\" value=\"" . $row['id_order'] . "\"> </td>";
				$element .= "<td class=\"cases\">" . $row['id_order'] . "</td>";
				$element .= "<td class=\"cases\">" . $row['client_name'] . "</td>";
				$element .= "<td class=\"cases\">" . $row['address'] . "</td>";
				$element .= "<td class=\"cases\">" . $row['product_name'] . "</td>";
				$element .= "<td class=\"cases\">" . $row['quantity'] . "</td>";
				$element .= "</tr>";
				#var_dump($element);
				echo $element;
			}
		}

		/**
		 * addOrder
		 *
		 * @param  mixed $price
		 * @param  mixed $products
		 * @param  mixed $quantities
		 * @param  mixed $id_client
		 *
		 * @return void
		 */
		public function addOrder($price, $products, $quantities, $id_client)
		{
			$order = new Order("", $price, "", $products, $quantities);
			$this->mgrOrder->insertOrder($order, $id_client, $id_method);
		}

		/**
		 * editOrder
		 *
		 * @param  mixed $id_order
		 * @param  mixed $id_client
		 * @param  mixed $product
		 * @param  mixed $quantity
		 * @param  mixed $adress
		 *
		 * @return void
		 */
		public function editOrder($id_order, $id_client, $product, $quantity, $adress)
		{
			$order = new Order($id_order, "", "", $product,"");
			$this->mgrOrder->updateOrder($order, $id_client);
		}

		/**
		 * deleteOrder
		 *
		 * @param  mixed $id_order
		 *
		 * @return void
		 */
		public function deleteOrder($id_order)
		{
			$this->mgrOrder->deleteOrder($id_order);
		}
	}
?>