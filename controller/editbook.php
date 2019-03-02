<?php

//START SESSION LOGIN TO GET USERNAME WHEN SHOW MESSAGE OF ADDING BOOK.
session_start();
if(!$_SESSION['login']){ //return to login page if there was a problem/
  
  header("location:../../index.php?");
  
  die;
}

require ("../model/db.php");
require ("../model/dbFunctions.php");
require ("../model/testInput.php");

if (!empty([$_POST])) {
  //input sanitation via testUserInput function
  $booktitle = !empty($_POST['booktitle'])? testUserInput(($_POST['booktitle'])): null;
  $originaltitle = !empty($_POST['originaltitle'])? testUserInput(($_POST['originaltitle'])): null;
  $yearofpublication = !empty($_POST['yearofpublication']) ? testUserInput(($_POST['yearofpublication'])): null;
  $genre = !empty($_POST['genre'])? testUserInput(($_POST['genre'])): null;
  $millionsold = !empty($_POST['millionsold']) ? testUserInput(($_POST['millionsold'])): null;
  $languagewritten = !empty($_POST['languagewritten']) ? testUserInput(($_POST['languagewritten'])): null;
  $coverimagepath = !empty($_POST['coverimagepath'])? testUserInput(($_POST['coverimagepath'])): null;
  $bookID = !empty($_POST['bookID'])? testUserInput(($_POST['bookID'])): null;
  
  try {
    
    if($_POST['action_type'] == 'add'){
      
      $myuser = $_SESSION["loginID"];
      $query = $conn->prepare("SELECT userID FROM users WHERE loginID = :user ");
      $query->bindvalue(":user", $myuser);
      $query->execute();
      $result2 = $query->fetch();
      $userid = $result2['userID'];
      
      $querySuccess = updatebook($booktitle, $originaltitle, $yearofpublication, $genre, $millionsold, $languagewritten, $coverimagepath, $bookID, $userid);
      header ('location:../View/Pages/library.php?message=<div id="msgerror">Book updated by '.$_SESSION['username'].' and logged</div>');
    }  
    
    else{
      header ('location:../View/Pages/library.php?message=<div id="msgerror">Message was sent</div>'); 
    }
    
    $result = $stmt->execute();
    $conn-> commit();
  }
  
  catch(PDOExeception $ex)
  {
    
    $conn->rollBack();
    throw $ex;
    
  }
  
  
}
?>