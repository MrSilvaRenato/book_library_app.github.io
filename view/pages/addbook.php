    <?php
    session_start();
    if(!$_SESSION['login']){//return to login page if there was a problem/
        
        header("location:../../index.php");
        
        die;
    }
    
    ?>
    
    <!doctype html>
    <html>
    
    <head>
    <meta charset="utf-8">
    <title>Home</title>
    <link href="../css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
    integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    
    </head>
    
    <body>
    
    
    
    
    
    
    <header class="nav">
    
    ---<i class="fas fa-book-open "></i>---<i class="fas fa-book-reader"></i>---WEB BOOK APP---<i
    class="fas fa-book-reader"></i>---<i class="fas fa-book-open"></i>---</header>
    
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
    <li class="menuItem"><a href="../../controller/logoutAdmin.php"><i class="fas fa-sign-out-alt"></i> SIGN OUT
    </a></li>
    
    </ul>
    </nav>
    
    <div class="flex-container">
    
    <?php
    
    if(!empty($_GET['message'])){
        
        $message = $_GET['message'];
        
        echo $message;
        
    }
    ?>
    
    <?php
    $message = $_SESSION['message'];
    
    echo $message;
    
    $_SESSION['message'] = ' ';
    
    ?>
    
    <?php
    require ("../../model/db.php");
    
    $sth = $conn->prepare('SELECT author.Name FROM author');
    $option = ' ';
    $sth->execute();
    $result = $sth-> fetchAll();
    
    foreach( $result as $row ) {
        
        $option .= '<option  value = "'.$row['Name'].'">  '.$row['Name'].'</option>';
    }
    
    ?>
    
    
    <form action="../../controller/pdobook.php" method="post">
    
    
    
    <fieldset>
    <h1>ADD BOOK</h1>
    <div class="container" style="">
    
    <label>Book Title:</label>
    <input type="text" name='booktitle' required>
    
    
    <label>Original Title:</label>
    <input type="text" name='originaltitle' required>
    
    
    <label>Year of Publication:</label>
    <input type="text" name='yearofpublication' required>
    
    
    <label>Genre:</label>
    <input type="text" name='genre' required>
    
    
    <label>Million Sold:</label>
    <input type="text" name='millionsold' required>
    
    
    <label>Language Written:</label>
    <input type="text" name='languagewritten' required>
    
    
    <label>Cover Image Path:</label>
    <input type="text" name='coverimagepath' required>
    
    
    
    
    
    </div>
    
    </fieldset>
    
    <fieldset>
    <h1>ADD AUTHOR</h1>
    <div class="container" style="height:100%;">
    <label>Name:</label>
    <input type="text" name='name' autocomplete="off" value="" required>
    
    
    <label>Surname:</label>
    <input type="text" name='surname' autocomplete="off" value="" required>
    
    <label>Nationality:</label>
    <input type="text" name='nationality' autocomplete="off" value="">
    
    <label>Birth Year:</label>
    <input type="text" name='birthyear' autocomplete="off" value="">
    
    
    <label>Death Year:</label>
    <input type="text" name='deathyear' autocomplete="off" value="">
    
    
    
    </fieldset>
    <fieldset>
    <input type="hidden" name="action_type" value="add">
    <input id="btnaddbook" value="ADD BOOK AND AUTHOR" type="submit">
    
    </div>
    </fieldset>
    
    
    </form>
    
    
    <footer>
    <p>footer</p>
    </footer>
    
    </div>
    
    </body>
    
    </html>