<?php
session_start();
include_once("../QueryEngine.php");
include_once("User.php");
include_once("MgrUser.php");

  $qe;
  $uname;
  $pwd;
  $mgrUser;

    $_SESSION= array();
    if(isset($_SESSION["username"])){
      echo "<script> location.href='../navbar.html'</script>";
    }
    else{
      $qe = new QueryEngine();
      $mgrUser = new MgrUser();
      $uname = $_POST['uname'];
      $pwd = $_POST['pwd'];
      $user = new User($uname,$pwd);

      if($mgrUser->connection($user)){
        $_SESSION["username"] = $uname;
        $_SESSION["password"] = $pwd;
        echo "<script> location.href='../../nav_inv.html'</script>";

      }
      else{
        echo "<script> location.href='../../login.php'</script>";
      }
    }





?>
