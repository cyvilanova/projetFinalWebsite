<?php
/****************************************
Fichier : MgrDbConnection.php
Auteur : David Gaulin
Fonctionnalité : GestionnaireConnexionBD
Date : 2019-04-16
Vérification :
Date Nom Approuvé
=========================================================
Historique de modifications :
Date Nom Description
=========================================================
 ****************************************/

class MgrDbConnection
{

    private $dbConn; //Pdo connection object

    public function __construct($dbname, $username, $password, $err)
    {

        try {
            $this->dbConn = new PDO("mysql:host=localhost;dbname=" . $dbname. ";charset=utf8", $username, $password);

            if ($err) {
                //Used for debuging
                $this->dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }

        } catch (PDOException $e) {
            throw new Exception("Error creating the DB Connection" . $e->getMessage());
        }

    }

    /**
     * @return mixed
     */
    public function getDbConn()
    {
        return $this->dbConn;
    }

    /**
     * @param mixed $dbConn
     *
     * @return self
     */
    public function setDb($dbConn)
    {
        $this->dbConn = $dbConn;
    }
}
