<?php

require ("../model/db.php");
require ("../model/dbFunctions.php");
require ("../model/testInput.php");

session_start();
if(!$_SESSION['login']){ // return to login page if there was a problem/
  
  header("location:../../index.php?");
  
  die;
}


if (!empty([$_POST])) {
  //input sanitation via testUserInput function
  $username = !empty($_POST['username'])? testUserInput(($_POST['username'])): null;
  $mypass = !empty($_POST['password'])? testUserInput(($_POST['password'])): null;
  $accessRights = !empty($_POST['accessRights']) ? testUserInput(($_POST['accessRights'])): null;
  $name = !empty($_POST['name'])? testUserInput(($_POST['name'])): null;
  $lastname = !empty($_POST['lastname']) ? testUserInput(($_POST['lastname'])): null;
  $email = !empty($_POST['email']) ? testUserInput(($_POST['email'])): null;
  $password= password_hash($mypass, PASSWORD_DEFAULT);
  
  try {
    if($_POST['action_type'] == 'add'){
      $query = $conn->prepare( "SELECT username FROM login WHERE username = :user");
      $query->bindvalue(":user", $username);
      $query->execute();
      
      if( $query->rowCount() < 1 ) { # If rows are not found
        
        /*TRY new adminuseradd*/
        $querySuccess = addUser($username, $password, $accessRights, $name, $lastname, $email);
        if ($query == true){
          header ('location:../View/Pages/registration.php?message=<div id="msgerror">User created by '.$_SESSION['username'].'</div>');
        }  
      } else {
        header ('location:../View/Pages/registration.php?message=<div id="msgerror">User name exists</div>'); 
      }
    }
  }
  catch (PDOException $e) {
    
    echo "Account creation problems".$e -> getMessage();
    
    die();
    
  }
  
}

?>
