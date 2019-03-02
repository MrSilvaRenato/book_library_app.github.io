<?php

require ("../model/db.php");
require ("../model/dbFunctions.php");
require ("../model/testInput.php");


//START SESSION LOGIN TO GET USERNAME WHEN SHOW MESSAGE OF ADDING BOOK.
session_start();
if(!$_SESSION['login']){ //return to login page if there was a problem/
  
  header("location:../../index.php?");
  
  die;
}

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
    
    if($_POST['action_type'] == 'delete'){
      
      $querySuccess = delete($bookID, $booktitle, $originaltitle, $yearofpublication, $genre, $millionsold, $languagewritten, $coverimagepath);
      header ('location:../View/Pages/library.php?message=<div id="msgerror">Book was deleted by '.$_SESSION['username'].'.</div>');
    }  
    
    else{
      header ('location:../View/Pages/library.php?message=<div id="msgerror">Not possible to delete the book</div>'); 
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