<?php

session_start();

require ("../model/db.php");

require ("../model/dbFunctions.php");

require ("../model/testInput.php");

if (!empty([$_POST]))

{
  
  $username = !empty($_POST['username'])?testUserInput(($_POST['username'])): null;
  
  $password = !empty($_POST['password'])?testUserInput(($_POST['password'])): null;
  
  try {
    
    $stmt = $conn->prepare("SELECT loginID, username, password, accessRights FROM login WHERE username=:user");
    
    $stmt->bindParam(':user', $username);
    
    $stmt->execute();
    
    $rows = $stmt -> fetch();
    
    if ( password_verify($password, $rows['password']) ){
      
      // assign session variables
      $_SESSION["loginID"] = $rows['loginID'];
      $_SESSION["username"] = $rows['username'];
      $_SESSION["password"] = $rows['password'];
      $_SESSION["accessRights"] = $rows['accessRights'];
      $_SESSION["login"] = true;
      $_SESSION["message"] = "<h1 style='color:rgb(5, 199, 199);'>Hello&nbsp;". $_SESSION["username"]."</h1>"."<p style='text-align:center; width:100%; color:rgb(5, 199, 199);'>you are logged in as &nbsp;".$_SESSION["username"]. "</p>";
      header('location:../View/Pages/library.php');
      
      
    }else {
      header ('location:../index.php?message=<div id="msgerror">Wrong username or password</div>');
    }
    
  }
  
  catch(PDOException $e)
  
  {
    
    echo "Account creation problems".$e -> getMessage();
    
    die();
    
  }
  
}

?>
