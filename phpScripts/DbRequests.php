<?php
	/****************************************
	 Fichier : DbRequests.php
	 Auteur : David Gaulin
	 Fonctionnalité : Moteur de requête DB
	 Date : 2019-04-16
	 Vérification : 
	 Date Nom Approuvé
	 =========================================================
	 Historique de modifications :
	 Date Nom Description
	 =========================================================
	****************************************/

	include_once("MgrDbConnection.php");

	class DbRequests{

		private $db; //MgrDbConnection object

		public function __construct(){
			$this->db = new MgrDbConnection("quintessentieldb","root","",true);
		}

		//Delete when no longer needed
		public function test(){	//Use this function to test if the connection works
			$add = $this->db->getDbConn()-> query("INSERT INTO category VALUES (DEFAULT,'test',true,'Tessst')");
		}
	}
?>