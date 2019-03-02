<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Web Book App<i class="fas fa-book"></i></title>
<link href="../css/style.css" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>
<body>

<?php

session_start();
if(!$_SESSION['login']){ // return to login page if there was a problem/
  
  header("location:../../index.php?");
  
  die;
}



if(!empty($_GET['message'])){ // display message when adding a book, deleting a book, updating a book
  
  $message = $_GET['message'];
  
  echo $message;
  
}

$message = $_SESSION['message']; // when  switch page and refrese, message goes away

echo $message;

$_SESSION['message'] = ' ';


?>


<header class="nav">
---<i class="fas fa-book-open "></i>---<i class="fas fa-book-reader"></i>---WEB BOOK APP---<i class="fas fa-book-reader"></i>---<i class="fas fa-book-open"></i>---</header>

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
<div class="flex-container">


<?php

require ("../../controller/displaybook.php");
getbook();


?>


</div>


<footer>
<p>Administrative Web Book Application</p>
</footer>

</body>
</html>
