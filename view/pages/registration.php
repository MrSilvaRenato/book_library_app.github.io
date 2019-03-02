<?php
session_start();
if(!$_SESSION['login']){//return to login page if there was a problem/
  
  header("location:../../index.php");
  
  die;
}

?>

<?php

if(!empty($_GET['message'])){
  
  $message = $_GET['message'];
  
  echo '<p class="msgerror">'.$message. '</p>';
  
}

$message = $_SESSION['message']; // when  switch page and refrese, message goes away

echo $message;

$_SESSION['message'] = ' ';

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Document</title>
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


<div class="flex-container">
<form action="../../Controller/pdoReg.php"  method="post">

<fieldset>
<h1>CREATE USER</h1>
<div class="container">
<label>Username:</label>
<input type="text" name='username' autocomplete="off" required>

<label>Password:</label>
<input type="text" name='password' autocomplete="off" required>

<label>Role:</label>
<input type="text" name='accessRights' autocomplete="off" required>

<label>Name:</label>
<input type="text" name='name' autocomplete="off" required>

<label>Surname:</label>
<input type="text" name=lastname autocomplete="off"  required>

<label>Email:</label>
<input type="text" name='email' autocomplete="off" required>

<input type="hidden" name="action_type" value="add">
<input id="btnaddbook" value="Register" type="submit">

</div>
</fieldset>
</form>
</div>
</body>
</html>

