<?php
session_start();
include_once("QueryEngine.php");
include_once("User.php");

  $qe;
  $uname;
  $pwd;

    $_SESSION= array();
    if(isset($_SESSION["username"])){
      echo "<script> location.href='../navbar.html'</script>";
    }
    else{
      $qe = new QueryEngine();
      $uname = $_POST['uname'];
      $pwd = $_POST['pwd'];
      $user = new User($uname,$pwd);

      if($user->connection()){
        $_SESSION["username"] = $uname;
        $_SESSION["password"] = $pwd;
        echo "<script> location.href='../navbar.html'</script>";

      }
      else{
        echo "<script> location.href='../login.php'</script>";
      }
    }





?>
