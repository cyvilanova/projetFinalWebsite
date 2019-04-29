<?php
session_start();
include_once("../QueryEngine.php");
include_once("User.php");
include_once("MgrUser.php");

  $qe;  //new query engine
  $uname; //Username of the user
  $pwd; //Password of the user
  $mgrUser; //new user manager

    $_SESSION= array(); //Initializes the array of session variables

    /**If the username is already set in the session variables,
    redirects to the catalog, otherwise, do the verification of the credentials
    and sets the session variables for the username and password*/
    if(isset($_SESSION["username"])){
      echo "<script> location.href='../Catalog.php'</script>";
    }

    else{
      $qe = new QueryEngine();
      $mgrUser = new MgrUser();
      $uname = $_POST['uname']; //Fetches from the form
      $pwd = $_POST['pwd']; //Fetches from the form
      $user = new User($uname,$pwd);  //Creates a new user with the username and password

    /**Verify the credentials provided by the user, if correct, sets the session variables,
    else, redirect to the login page and shows a message*/
      if($mgrUser->connection($user)){
        $_SESSION["username"] = $uname;
        $_SESSION["password"] = $pwd;
        echo "<script> location.href='../../Catalog.php'</script>";

      }
      else{
        $message = "Vous avez entrés de mauvaises informations.";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo "<script> location.href='../../login.php'</script>";

      }
    }





?>
