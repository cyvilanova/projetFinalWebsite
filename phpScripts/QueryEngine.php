<?php
/****************************************
Fichier : QueryEngine.php
Auteur : David Gaulin
Fonctionnalité : Moteur de requête DB
Date : 2019-04-16
Vérification :
Date Nom Approuvé
=========================================================
Historique de modifications :
Date Nom Description
2019-03-19 Cynthia Vilanova executeQuery method
04-24 CB avoir l'id du dernier inséré
=========================================================
 ****************************************/

require_once 'MgrDbConnection.php';

class QueryEngine
{

    private $db; //MgrDbConnection object

    public function __construct()
    {
        $this->db = new MgrDbConnection("quintessentieldb", "root", "", true);
    }


    public function executeQuery($queryString, $parametersMap=[])
    {

        $conn = $this->db->getDbConn();

        $query = $queryString;

        $loading = $conn->prepare($query);

        foreach ($parametersMap as $key => $value) {
            $loading->bindValue($key, $value);
        }

        try {
            if (!$loading->execute()) {
                throw new Exception("Error");
            } else {
                return $loading;
            }
        } catch (Exception $e) {
            return false;
        }
    }
    
    public function getLastInsertedId()
    {
        $conn = $this->db->getDbConn();
        $last_id = $conn->lastInsertId();
        return $last_id;
    }

}

