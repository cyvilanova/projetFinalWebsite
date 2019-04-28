<?php
/****************************************
 Fichier : User.php
 Auteur : Philippe Audit-Allaire
 Fonctionnalité : W7 - Connexion de l'utilisateur
 Date : 2019-04-15
 Vérification :
 Date Nom Approuvé
 =========================================================
 Historique de modifications :
 Date Nom Description
 =========================================================
****************************************/
class User{

  private $id;
  private $username;
  private $email;
  private $pwd;
  private $secretQuestion;
  private $secretAnswer;

  private $qe;


  public function __construct($username, $password){
    $this->setUsername($username);
    $this->setPassword($password);
    $qe = new QueryEngine();
  }


    /**
     * @return mixed
     */
    public function getUsername(){
        return $this->username;
    }


    public function setUsername($usrName){
        $this->username = $usrName;
    }

    /**
     * @return mixed
     */
    public function getEmail(){
        return $this->email;
    }


    public function setEmail($mail){
        $this->email = $mail;
    }

    /**
     * @return mixed
     */
    public function getPassword(){
        return $this->pwd;
    }


    public function setPassword($password){
        $this->pwd = $password;
    }

    /**
     * @return mixed
     */
    public function getSecretQuestion(){
        return $this->secretQuestion;
    }


    public function setSecretQuestion($idQuestion){
        $this->secretQuestion = $idQuestion;
    }


    public function getSecretAnswer(){
        return $this->secretAnswer;
    }


    public function setSecretAnswer($answer){
        $this->secretAnswer = $answer;
    }

    public function getId(){
      return $this->id;
    }

    public function setId($newId){
      $this->id = $newId;
    }


/*
    public function resetPassword($username,$email){
      $parameters =
      [
        ":username"=>$username,
        ":email"=>$email,
      ];

      $stmt = "SELECT * FROM user WHERE username =':username'AND email =':email'";
      $rs = $qe->executeQuery($stmt, $parameters);
      $row = $rs->fetch();

      $this->setUsername($row["username"]);
      $this->setSecretQuestion($row["id_question"]);


    }

    public function loadQuestion(){
      $parameters =
      [
        ":id_question"=>$this->getSecretQuestion(),
      ];

      $stmt = "SELECT * FROM secret_question WHERE id_question =':id_question'";
      $rs = $qe->executeQuery($stmt, $parameters);
      $row = $rs->fetch();

      $_SESSION["secretQuestion"] = $row["question"];
    }

    public function verifyAnswer($resultSet,$answer){
      if($answer==$resultSet["secret_answer"]){
        return true;
      }
      else{
        return false;
      }
    }
*/

}
 ?>
