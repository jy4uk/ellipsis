<?php

function getAllStories() {
    global $db;
    $query = "SELECT storyID, title FROM story";
    $statement = $db->prepare($query);
    // $statement->bindValue(':user', $user);
    $statement->execute();
    
    // fetchAll() returns an array for all of the rows in the result set
    $results = $statement->fetchAll();
    
    // closes the cursor and frees the connection to the server so other SQL statements may be issued
    $statement->closecursor();
    
    return $results;
}

function getStoryAuthor(int $storyID) {
    global $db;
    $query = "SELECT display_name, username FROM user NATURAL JOIN `create` WHERE storyID = $storyID";
    $statement = $db->prepare($query);
    $statement->execute();

    $results = $statement->fetchAll();

    $statement->closecursor();

    return $results;
}
?>