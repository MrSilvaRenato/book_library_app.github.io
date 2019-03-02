<?php
function getbook()
{
    require ("../../model/db.php");
    
    $sth = $conn->prepare('SELECT bookID, bookTitle, coverImagePath, author.Name, author.Surname FROM book LEFT OUTER JOIN author ON book.AuthorID = author.AuthorID');
    $sth->execute();
    $result = $sth-> fetchAll();
    
    
    foreach( $result as $row ) {
        
        echo  '<div class="card">';
        echo  '<img src="'.$row['coverImagePath'].'">';
        echo  '<figcaption>';
        echo  '<a class="edit" href="updatepage.php?id='.$row['bookID'].'">EDIT</a>';
        echo  '<a class="delete" href="deletepage.php?id='.$row['bookID'].'">DELETE</a>'; 
        echo  '<p class="ptitle">'.$row['bookTitle'].'</p>';
        echo  '<p class="pauthor">Author: '.$row['Name'].' '.$row['Surname'].'</p>';
        echo  '</figcaption>';
        echo  '</div>';
        
        
        
        
        //echo $row['bookID'];
        //echo $row['bookTitle'];
        //echo "<img src=../../".$row['coverImagePath'];"/>;"
    }
}
//header("location:../View/Pages/library.php");
?>