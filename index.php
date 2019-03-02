<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link href="View/css/style.css" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

<title>Login Page</title>
</head>
<body>

<?php

if(!empty($_GET['message'])){
  $message = $_GET['message'];
  echo $message;
}

?>


<form  class="formindexpage" action="Controller/pdoLogin.php" method="post">

<fieldset class="fieldset0">

<h1 id="loginpage"><i id="icon" class="fas fa-book fa-spin fa-1x"></i> Library Admin </h1>

<label class="labelwidth">Username:</label>

<input type="text" name="username" autocomplete="off" required>

<label>Password:</label>

<input type="password" name="password"  autocomplete="off" required>

<input type="submit" value="LOGIN">
</fieldset>

</form>



</body>
</html>
