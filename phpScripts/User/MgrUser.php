<?php
/****************************************
Fichier : MgrUser.php
Auteur : Philippe Audit-Allaire
Fonctionnalité : W7 - Consultation d'un catalogue de produit
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

  private $users;
  private $qe;

  public function __construct()
  {

    $this->$users = array();
  }

  //Connection de l'utilisateur
      public function connection($user){
        $qe = new QueryEngine();
        $usrname = $user->getUsername();
        $pwd = $user->getPassword();


        $parameters =
        [
          ":username"=>$usrname,
          ":password"=>$pwd,
        ];

        $stmt = "SELECT * FROM user WHERE username =:username AND password =:password";
        $rs = $qe->executeQuery($stmt, $parameters);

        if($rs->rowCount()>0){
          return true;
        }
        else{
          return false;
        }
      }
}

 ?>
