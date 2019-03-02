<?php 

function addUser($username, $password, $accessRights, $name, $lastname, $email){
        
        global $conn;
        
        try{
                
                $conn-> beginTransaction();
                
                $sql = "INSERT INTO login(username, password, accessRights)  VALUES (:username, :password, :accessRights)";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':username', $username);
                $stmt->bindValue(':password', $password);
                $stmt->bindValue(':accessRights', $accessRights);
                
                $result = $stmt->execute();
                
                
                $loginID = $conn->lastinsertid();
                
                $sql = "INSERT INTO users(email, firstName, lastName, loginID)  VALUES (:email, :name, :lastname, :loginID)";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':name', $name);
                $stmt->bindValue(':lastname', $lastname);
                $stmt->bindValue(':email', $email);
                $stmt->bindValue(':loginID', $loginID);
                
                $result = $stmt->execute();
                $conn-> commit();
        }
        
        catch(PDOExeception $ex)
        {
                
                $conn->rollBack();
                throw $ex;
                
        }
}


function addBookandauthor($booktitle, $originaltitle, $yearofpublication, $genre, $millionsold, $languagewritten, $coverimagepath, $name, $surname, $nationality, $birthyear, $deathyear, $userid){
        
        global $conn;
        
        try{
                
                $conn-> beginTransaction();
                
                
                $sql = "INSERT INTO author(Name, Surname, Nationality, BirthYear, DeathYear)  VALUES (:name, :surname, :nationality, :birthyear, :deathyear)";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':name', $name);
                $stmt->bindValue(':surname', $surname);
                $stmt->bindValue(':nationality', $nationality);
                $stmt->bindValue(':birthyear', $birthyear);
                $stmt->bindValue(':deathyear', $deathyear);
                
                $result = $stmt->execute();
                
                $authorid = $conn->lastinsertid(); 
                
                $sql = "INSERT INTO book(BookTitle, OriginalTitle, YearofPublication, Genre, MillionsSold, LanguageWritten, AuthorID, CoverImagePath)  VALUES (:booktitle, :originaltitle, :yearofpublication, :genre, :millionsold, :languagewritten, :authorid, :coverimagepath)";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':booktitle', $booktitle);
                $stmt->bindValue(':originaltitle', $originaltitle);
                $stmt->bindValue(':yearofpublication', $yearofpublication);
                $stmt->bindValue(':genre', $genre);
                $stmt->bindValue(':millionsold', $millionsold);
                $stmt->bindValue(':languagewritten', $languagewritten);
                $stmt->bindValue(':authorid', $authorid);         
                $stmt->bindValue(':coverimagepath', $coverimagepath);
                
                
                $result = $stmt->execute();
                $bookID2 = $conn->lastinsertid(); 
                
                $sql = "INSERT INTO changelog (datechanged, datecreated, BookID, userid) VALUES (NOW(), NOW(), :bookID, :user)"; //QUERY which will insert the data into the database.
                $stmt = $conn->prepare($sql); // prepare my query above to bind them with each value
                $stmt->bindValue(':user', $userid);
                $stmt->bindValue(':bookID', $bookID2);
                
                
                $result = $stmt->execute(); 
                
                $conn-> commit();
        }
        
        catch(PDOExeception $ex)
        {
                
                $conn->rollBack();
                throw $ex;
                
        }
}


function addBook2($booktitle, $originaltitle, $yearofpublication, $genre, $millionsold, $languagewritten, $coverimagepath, $author, $userid){
        
        global $conn;
        
        try{
                $conn-> beginTransaction();
                
                $sql = "INSERT INTO book(BookTitle, OriginalTitle, YearofPublication, Genre, MillionsSold, LanguageWritten, AuthorID, CoverImagePath)  VALUES (:booktitle, :originaltitle, :yearofpublication, :genre, :millionsold, :languagewritten, :authorid,:coverimagepath)";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':booktitle', $booktitle);
                $stmt->bindValue(':originaltitle', $originaltitle);
                $stmt->bindValue(':yearofpublication', $yearofpublication);
                $stmt->bindValue(':genre', $genre);
                $stmt->bindValue(':millionsold', $millionsold);
                $stmt->bindValue(':languagewritten', $languagewritten);
                $stmt->bindValue(':coverimagepath', $coverimagepath);
                $stmt->bindValue(':authorid', $author);
                
                $result = $stmt->execute(); 
                $bookID2 = $conn->lastinsertid(); 
                
                
                $sql = "INSERT INTO changelog (datechanged, datecreated, BookID, userid) VALUES (NOW(), NOW(), :bookID, :user)"; //QUERY which will insert the data into the database.
                $stmt = $conn->prepare($sql); // prepare my query above to bind them with each value
                $stmt->bindValue(':user', $userid);
                $stmt->bindValue(':bookID', $bookID2);
                
                
                $result = $stmt->execute(); 
                
                $conn-> commit();
        }
        
        catch(PDOExeception $ex)
        {
                
                $conn->rollBack();
                throw $ex;
                
        }
}




function updatebook($booktitle, $originaltitle, $yearofpublication, $genre, $millionsold, $languagewritten, $coverimagepath, $bookID, $userid){
        
        global $conn;
        
        try{
                
                $conn-> beginTransaction();
                $stmt = $conn->prepare("UPDATE book SET BookTitle = :booktitle, OriginalTitle = :originaltitle,
                YearofPublication = :yearofpublication, Genre = :genre, MillionsSold = :millionsold, LanguageWritten = :languagewritten, coverImagePath = :coverimagepath WHERE BookID = $bookID");
                
                $stmt->bindValue(':booktitle', $booktitle);
                $stmt->bindValue(':originaltitle', $originaltitle);
                $stmt->bindValue(':yearofpublication', $yearofpublication);
                $stmt->bindValue(':genre', $genre);
                $stmt->bindValue(':millionsold', $millionsold);
                $stmt->bindValue(':languagewritten', $languagewritten);
                $stmt->bindValue(':coverimagepath', $coverimagepath);
                
                $result = $stmt->execute();
                
                $query = $conn->prepare("SELECT dateCreated FROM changelog");
                $stmt = $conn->prepare("UPDATE changelog SET dateChanged = NOW(), datecreated = dateCreated"); //insert datalog on each inserting.
                $stmt->bindValue(':user', $userid);
                $stmt->bindValue(':bookID', $bookID);
                
                $result = $stmt->execute(); 
                
                $conn-> commit();
        }
        
        catch(PDOExeception $ex)
        {
                
                $conn->rollBack();
                throw $ex;
                
        }
}


function delete($bookID, $booktitle, $originaltitle, $yearofpublication, $genre, $millionsold, $languagewritten, $coverimagepath){
        
        global $conn;
        
        try{
                $conn-> beginTransaction();
                
                $sql = "DELETE FROM changelog WHERE changelog.BookID = $bookID";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':booktitle', $booktitle);
                $stmt->bindValue(':originaltitle', $originaltitle);
                $stmt->bindValue(':yearofpublication', $yearofpublication);
                $stmt->bindValue(':genre', $genre);
                $stmt->bindValue(':millionsold', $millionsold);
                $stmt->bindValue(':languagewritten', $languagewritten);
                $stmt->bindValue(':coverimagepath', $coverimagepath);
                $stmt->bindValue(':bookID', $bookID);
                
                $result = $stmt->execute(); 
                
                $sql = "DELETE FROM book WHERE book.BookID = $bookID";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':booktitle', $booktitle);
                $stmt->bindValue(':originaltitle', $originaltitle);
                $stmt->bindValue(':yearofpublication', $yearofpublication);
                $stmt->bindValue(':genre', $genre);
                $stmt->bindValue(':millionsold', $millionsold);
                $stmt->bindValue(':languagewritten', $languagewritten);
                $stmt->bindValue(':coverimagepath', $coverimagepath);
                $stmt->bindValue(':bookID', $bookID);
                
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