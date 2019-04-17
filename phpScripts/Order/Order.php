<?php
	/****************************************
	 Fichier : Order.php
	 Auteur : Catherine Bronsard
	 Fonctionnalité : Commandes clients
	 Date : 2019-04-17
	 Vérification :
	 Date Nom Approuvé
	 =========================================================
	 Historique de modifications :
	 Date Nom Description
	 =========================================================
	****************************************/

	/**
	 *
	 */
	class Order
	{
		private $id;
		private $client;
		private $user;
		private $state;
		private $shipping;
		private $tps;
		private $tvq;
		private $total;

		function __construct($id, $client, $user, $state, $shipping, $tps, $tvq, $total)
		{
			$this->id = $id;
			$this->client = $client;
			$this->user = $user;
			$this->state = $state;
			$this->shipping = $shipping;
			$this->tps = $tps;
			$this->tvq = $tvq;
			$this->total = $total;
		}

		/**
		* @return the id of the order
		*/
		function getId() {
			return $this->id;
		}

		/**
		* @param new Id
		*/
		function setId($id) {
			$this->id = $id;
		}


		/**
		* @return the client of the order
		*/
		function getClient() {
			return $this->client;
		}

		/**
		* @param new client
		*/
		function setClient($client) {
			$this->client = $client;
		}



		public function getUser()
		{
		    return $this->user;
		}
		 
		public function setUser($user)
		{
		    $this->user = $user;
		    return $this;
		}


		public function getUser()
		{
		    return $this->user;
		}
		 
		public function setUser($user)
		{
		    $this->user = $user;
		    return $this;
		}

		public function getUser()
		{
		    return $this->user;
		}
		 
		public function setUser($user)
		{
		    $this->user = $user;
		    return $this;
		}
	}

?>
