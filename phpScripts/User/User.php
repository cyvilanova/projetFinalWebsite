<?php
/****************************************
 Fichier : User.php
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
class User{

  private $id; //Identification number of user
  private $username; //User's username
  private $email; //User's email address
  private $pwd; //User's password
  private $secretQuestion; //User's secret question identification number
  private $secretAnswer;  //User's secret answer
  private $qe; //Query engine

  /**
	 * User constructor with parameters.
	 * @param  mixed $username the name of the user
	 * @param  mixed $password the password of the user
	 */
  public function __construct($username, $password){
    $this->setUsername($username);
    $this->setPassword($password);
  }

    /**
     *Gets the username of the user
     * @return string $username of the user
     */
    public function getUsername(){
        return $this->username;
    }

    /**
     *Sets the username of the user
     * @param mixed $usrname
     */
    public function setUsername($usrName){
        $this->username = $usrName;
    }

    /**
     *Gets the email of the user
     * @return string $email of the user
     */
    public function getEmail(){
        return $this->email;
    }

    /**
     *Sets the email of the user
     * @param mixed $mail
     */
    public function setEmail($mail){
        $this->email = $mail;
    }

    /**
     *Gets the password of the user
     * @return string $password of the user
     */
    public function getPassword(){
        return $this->pwd;
    }

    /**
     *Sets the password of the user
     * @param mixed $password
     */
    public function setPassword($password){
        $this->pwd = $password;
    }

    /**
     *Gets the secret question ID of the user
     * @return int $secretQuestion of the user
     */
    public function getSecretQuestion(){
        return $this->secretQuestion;
    }

    /**
     *Sets the secret question of the user
     * @param mixed $idQuestion
     */
    public function setSecretQuestion($idQuestion){
        $this->secretQuestion = $idQuestion;
    }

    /**
     *Gets the secret question's answer of the user
     * @return string $secretAnswer of the user
     */
    public function getSecretAnswer(){
        return $this->secretAnswer;
    }

    /**
     *Sets the secret question's answer of the user
     * @param mixed $answer
     */
    public function setSecretAnswer($answer){
        $this->secretAnswer = $answer;
    }

    /**
     *Gets the id of the user
     * @return int $id of the user
     */
    public function getId(){
      return $this->id;
    }

    /**
     *Sets the id of the user
     * @param mixed $newId
     */
    public function setId($newId){
      $this->id = $newId;
    }

}
?>
