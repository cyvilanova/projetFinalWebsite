<?php
/****************************************
	 Fichier : Client.php
	 Auteur : Philippe Audit-Allaire
	 Fonctionnalité : W - Gestion de commande
	 Date : 2019-04-24
	 Vérification :
	 Date Nom Approuvé
	 =========================================================
	 Historique de modifications :
	 Date Nom Description
	 =========================================================
 ****************************************/

class Client{

  private $address; //Client's street address
  private $city;  //Client's city name
  private $name; //Client's name
  private $postalCode; //Client's postal code
  private $province; //Client's province
  private $id;  //Client's identification number


  /**
   * Client constructor with parameters.
   * @param  mixed $address the street address of the client
   * @param  mixed $city the name of the city of the client
   * @param  mixed $name the name of the client
   * @param  mixed $postalCode the postal code of the client
   * @param  mixed $province the province of the client
   * @param  mixed $id the identification number of the client
   */
  public function __construct($address,$city,$name,$postalCode,$province,$id){
      $this->address = $address;
      $this->city = $city;
      $this->name = $name;
      $this->postalCode = $postalCode;
      $this->province = $province;
      $this->id = $id;
  }


  /**
   * Gets the street address of the client
   * @return string $address the address of the client
   */
  public function getAddress(){
      return $this->address;
  }

  /**
   * Sets the street address of the client
   * @param  mixed $newAddress
   */
  public function setAddress($newAddress){
      $this->address = $newAddress;
  }

  /**
   * Gets the city of the client
   * @return string $city the city of the client
   */
  public function getCity(){
      return $this->city;
  }

  /**
   * Sets the city of the client
   * @param  mixed $neCity
   */
  public function setCity($newCity){
      $this->city = $newCity;
  }

  /**
   * Gets the name of the client
   * @return string $name the name of the client
   */
  public function getName(){
      return $this->name;
  }

  /**
   * Sets the name of the client
   * @param  mixed $newName
   */
  public function setName($newName){
      $this->name = $newName;
  }

  /**
   * Gets the postal code of the client
   * @return string $postalCode the postal code of the client
   */
  public function getPostalCode(){
      return $this->postalCode;
  }

  /**
   * Sets the postal code of the client
   * @param  mixed $newPostalCode
   */
  public function setPostalCode($newPostalCode){
      $this->postalCode = $newPostalCode;
  }

  /**
   * Gets the province of the client
   * @return string $province the province of the client
   */
  public function getProvince(){
      return $this->province;
  }

  /**
   * Sets the province of the client
   * @param  mixed $newProvince
   */
  public function setProvince($newProvince){
      $this->province = $newProvince;
  }

  /**
   * Gets the id of the client
   * @return string $id the id of the client
   */
  public function getId(){
    return $this->id;
  }

  /**
   * Sets the id of the client
   * @param  mixed $newId
   */
  public function setId($newId){
    $this->id = $newId;
  }

?>
