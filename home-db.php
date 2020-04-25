<?php
//require('../vendor/autoload.php');

function getAllStories() {
    global $db;
    $query = "SELECT storyID, title FROM story order by title";
    $statement = $db->prepare($query);
    // $statement->bindValue(':user', $user);
    $statement->execute();
    
    // fetchAll() returns an array for all of the rows in the result set
    $results = $statement->fetchAll();
    
    // closes the cursor and frees the connection to the server so other SQL statements may be issued
    $statement->closecursor();
    
    return $results;
}


?>