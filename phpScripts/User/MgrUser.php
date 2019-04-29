<?php
/****************************************
Fichier : MgrUser.php
Auteur : Philippe Audit-Allaire
Fonctionnalité : W - Connexion de l'utilisateur
Date : 2019-04-15
Vérification :
Date Nom Approuvé
=========================================================
Historique de modifications :
Date Nom Description

=========================================================
 ****************************************/

 include_once "User.php";
 include_once "../QueryEngine.php";


class MgrUser
{

  private $qe;  //query manager

  /**
	 * Recipe constructor with no parameters.
	 */
  public function __construct(){
  }


	/**
	 * Verifies the credentials provided by the user to see if the user is
   * already signed up in the database
	 * and returns true if found.
   * @param mixed $user user passed to check for credentials
	 * @return boolean if there is a match for the credentials in the database
	 *
	 */
  public function connection($user){
    $qe = new QueryEngine();  //Initialization of the QueryEngine
    $usrname = $user->getUsername();
    $pwd = $user->getPassword();

    //Creation of the array of parameters
    $parameters =
    [
      ":username"=>$usrname,
      ":password"=>$pwd,
    ];

    $stmt = "SELECT * FROM user WHERE username =:username AND password =:password";
    $rs = $qe->executeQuery($stmt, $parameters);

    //Verify if the rowcount of the returned result set it greater than 0
    if($rs->rowCount()>0){
      return true;
    }
    else{
      return false;
    }
  }
}

 ?>
