<?php
	/**
	 * 
	 */
	require_once __DIR__ . '/MgrOrder.php';

	class CtrlOrder
	{
		
		private $mgrOrder;

		function __construct()
		{
			$this->mgrOrder = new MgrOrder();
		}

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

		public function FunctionName($value='')
		{
			# code...
		}
	}
?>