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
  $yearofpublication = !empty($_POST['yearofpublication'])? testUserInput(($_POST['yearofpublication'])): null;
  $genre = !empty($_POST['genre'])? testUserInput(($_POST['genre'])): null;
  $millionsold = !empty($_POST['millionsold'])? testUserInput(($_POST['millionsold'])): null;
  $languagewritten = !empty($_POST['languagewritten'])? testUserInput(($_POST['languagewritten'])): null;
  $coverimagepath = !empty($_POST['coverimagepath'])? testUserInput(($_POST['coverimagepath'])): null;
  $name = !empty($_POST['name'])? testUserInput(($_POST['name'])): null;
  $surname = !empty($_POST['surname'])? testUserInput(($_POST['surname'])): null;
  $nationality = !empty($_POST['nationality'])? testUserInput(($_POST['nationality'])): null;
  $birthyear = !empty($_POST['birthyear'])? testUserInput(($_POST['birthyear'])): null;
  $deathyear = !empty($_POST['deathyear'])? testUserInput(($_POST['deathyear'])): null;
  
  try {
    if($_POST['action_type'] == 'add'){
      
      
      /**/
      
      $query = $conn->prepare( "SELECT Name, AuthorID FROM author WHERE Name = :name");
      $query->bindvalue(":name", $name);
      $query->execute();
      $result = $query->fetch();
      
      
      
      if( $query->rowCount() < 1 ) { # If rows are not found
        
        $myuser = $_SESSION["loginID"];
        
        $query = $conn->prepare("SELECT userID FROM users WHERE loginID = :user ");
        $query->bindvalue(":user", $myuser);
        $query->execute();
        $result2 = $query->fetch();
        
        $userid = $result2['userID'];
        
        addBookandauthor($booktitle, $originaltitle, $yearofpublication, $genre, $millionsold, $languagewritten, $coverimagepath, $name, $surname, $nationality, $birthyear, $deathyear, $userid);
        
        header ('location:../View/Pages/library.php?message=<div id="msgerror">Book Added by '.$_SESSION['username'].' and logged </div>');
        
        
      }  
      
      // else look for author in the database with the specific book id and add just book
      else {
        
        $author = $result['AuthorID'];
        
        $myuser = $_SESSION["loginID"];
        $query = $conn->prepare("SELECT userID FROM users WHERE loginID = :user ");
        $query->bindvalue(":user", $myuser);
        $query->execute();
        $result2 = $query->fetch();
        $userid = $result2['userID'];
        
        addBook2($booktitle, $originaltitle, $yearofpublication, $genre, $millionsold, $languagewritten, $coverimagepath, $author, $userid);    
        header ('location:../View/Pages/library.php?message=<div id="msgerror">Book added to an existent author by '.$_SESSION['username'].' and logged.</div>' ); 
      } 
    }
    
    
    
  }
  
  catch (PDOException $e) {
    
    echo "Add book problems".$e -> getMessage();
    
    die();
    
  }
  
  
}

// $insert = insertlog($datechanged, $datecreated, $bookID, $userid, $changetype);
?>