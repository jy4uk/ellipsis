<?php

function getStoryPieces(int $storyID) {
    global $db;
    $query = "SELECT story_text, piece_key FROM contributes_to WHERE storyID = $storyID ORDER BY piece_key";
    $statement = $db->prepare($query);
    $statement->execute();

    $results = $statement->fetchAll();

    $statement->closecursor();

    return $results;
}

function getStoryDetails(int $storyID) {
    global $db;
    $query = "SELECT display_name, username, title FROM user NATURAL JOIN `create` NATURAL JOIN story WHERE storyID = $storyID";
    $statement = $db->prepare($query);
    $statement->execute();

    $results = $statement->fetchAll();

    $statement->closecursor();

    return $results;
}

function createNewStory($title, $first_piece , $username) {
    global $db;

    $story_query = "INSERT INTO story (storyID, title) VALUES (NULL, :title)";

    $story_statement = $db->prepare($story_query);
    $story_statement->bindValue(':title', $title);
    $story_statement->execute();
    $story_statement->closecursor();

    $id_query = "SELECT LAST_INSERT_ID() FROM story";
    $id_statement = $db->prepare($id_query);
    $id_statement->execute();
    $storyID = $id_statement->fetchAll()[0]['LAST_INSERT_ID()'];

    if ($storyID > 0) {
        $create_query = "INSERT INTO `create` (storyID, username) VALUES (:storyID, :username)";

        $create_statement = $db->prepare($create_query);
        $create_statement->bindValue(':storyID', $storyID);
        $create_statement->bindValue(':username', $username);
        $create_statement->execute();
        $create_statement->closecursor();
    
        $contributes_query = "INSERT INTO contributes_to (username, storyID, story_text, piece_key) VALUES (:username, :storyID, :story_text, NULL)";

        $contributes_statement = $db->prepare($contributes_query);
        $contributes_statement->bindValue(':username', $username);
        $contributes_statement->bindValue('storyID', $storyID);
        $contributes_statement->bindValue(':story_text', $first_piece);
        $contributes_statement->execute();
        $contributes_statement->closecursor();
    
        return $storyID;
    }
    else {
        return -1;
    }
    
}

?>