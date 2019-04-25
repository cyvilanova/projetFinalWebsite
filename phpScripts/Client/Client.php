<?php
class Client{

  private $address;
  private $city;
  private $name;
  private $postalCode;
  private $province;
  private $id;



  public function __construct($address,$city,$name,$postalCode,$province,$id){
      $this->address = $address;
      $this->city = $city;
      $this->name = $name;
      $this->postalCode = $postalCode;
      $this->province = $province;
      $this->id = $id;
  }


/**
 * @return mixed
 */
public function getAddress(){
    return $this->address;
}

/**
 * @return mixed
 */
public function setAddress($newAddress){
    $this->address = $newAddress;
}

/**
 * @return mixed
 */
public function getCity(){
    return $this->city;
}

/**
 * @return mixed
 */
public function setCity($newCity){
    $this->city = $newCity;
}

/**
 * @return mixed
 */
public function getName(){
    return $this->name;
}

/**
 * @return mixed
 */
public function setName($newName){
    $this->name = $newName;
}

/**
 * @return mixed
 */
public function getPostalCode(){
    return $this->postalCode;
}

/**
 * @return mixed
 */
public function setPostalCode($newPostalCode){
    $this->postalCode = $newPostalCode;
}

/**
 * @return mixed
 */
public function getProvince(){
    return $this->province;
}

/**
 * @return mixed
 */
public function setProvince($newProvince){
    $this->province = $newProvince;
}

public function getId(){
  return $this->id;
}

public function setId($newId){
  $this->id = $newId;
}

?>
