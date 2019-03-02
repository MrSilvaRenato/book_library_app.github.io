<?php
session_start();
if(!$_SESSION['login']){//return to login page if there was a problem/
  
  header("location:../../index.php");
  
  die;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Update Page</title>
<link href="../css/style.css" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>
<body>

<header class="nav">

---<i class="fas fa-book-open "></i>---<i class="fas fa-book-reader"></i>---WEB BOOK APP---<i class="fas fa-book-reader"></i>---<i class="fas fa-book-open"></i>---</header>

</header>

<nav class="nav">

<label for="ham_menu">&#9776;</label>
<input id="ham_menu" type="checkbox">
<ul>
<li class="menuItem"><a href="library.php"><i class="fas fa-home"></i> HOME </i></a></li>
<li class="menuItem"><a href="addbook.php"><i class="fas fa-book"></i> ADD BOOK</a> </li>
<?php 
if(isset($_SESSION['login'])){
  if($_SESSION['accessRights'] == 'admin'){
    echo '<li class="menuItem"><a href="registration.php"><i class="fas fa-users"></i> ADD USER </a></li>';
  }
  else {
    echo '<li class="menuItem"><a href="staff.php"><i class="fas fa-envelope"></i> Enquiries</a></li>';
  }
}
?>
<li class="menuItem"><a href="../../controller/logoutAdmin.php"><i class="fas fa-sign-out-alt"></i> SIGN OUT </a></li>

</ul>  
</nav>

<article>
<?php
require ("../../model/db.php");

$sth = $conn->prepare('SELECT BookTitle, OriginalTitle,YearofPublication, Genre, MillionsSold, LanguageWritten, CoverImagePath, bookID FROM book  WHERE bookID = :bookID');
$sth->bindValue(':bookID', $_GET['id']);
$sth->execute();
$row = $sth-> fetch();


?>
<form action="../../controller/deletebook.php"  method="post">
<h3 style="color:red; text-align:center;">This form is just for reading, are you sure you want to delete it?</h3>
<fieldset>

<h2>DELETE BOOK</h2>
<div class="container" style="">


<input type="number" name='bookID' value="<?php echo $row["bookID"];?>" readonly>


<label>Book Title:</label>
<input type="text" name='booktitle' value="<?php echo $row["BookTitle"];?>" readonly>

<label>Original Title:</label>
<input type="text" name='originaltitle' value="<?php echo $row['OriginalTitle'];?>" readonly>


<label>Year of Publication</label>
<input type="text" name='yearofpublication' value="<?php echo $row['YearofPublication'];?>" readonly>

<label>Genre:</label>
<input type="text" name='genre' value="<?php echo $row['Genre'];?>" readonly>


<label>Million Sold</label>
<input type="text" name='millionsold' value="<?php echo $row['MillionsSold'];?>" readonly>


<label>Language Written </label>
<input type="text" name='languagewritten' value="<?php echo $row['LanguageWritten'];?>" readonly>


<label>Cover Image Path</label>
<input type="text" name='coverimagepath' value="<?php echo $row['CoverImagePath'];?>" readonly>  


<input type="hidden" name="action_type" value="delete">
<input id="btnaddbook" value="Delete Book" type="submit">

</div>
</fieldset>


</body>
</html>