<?php
//require('../vendor/autoload.php');

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

function isPublished(int $storyID) {
    global $db;
    $query = "SELECT * FROM publish WHERE storyID = $storyID";
    $statement = $db->prepare($query);
    $statement->execute();
    if(count($statement->fetchAll()) == 0) {
        return false;
    }
    else {
        return true;
    }
}

function isArchived(int $storyID) {
    global $db;
    $query = "SELECT * FROM archive WHERE storyID = $storyID";
    $statement = $db->prepare($query);
    $statement->execute();
    if(count($statement->fetchAll()) == 0) {
        return false;
    }
    else {
        return true;
    }
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

function makeContribution($contribution, $username, $storyID) {
    global $db;

    $contributes_query = "INSERT INTO contributes_to (username, storyID, story_text, piece_key) VALUES (:username, :storyID, :story_text, NULL)";

    $contributes_statement = $db->prepare($contributes_query);
    $contributes_statement->bindValue(':username', $username);
    $contributes_statement->bindValue(':storyID', $storyID);
    $contributes_statement->bindValue(':story_text', $contribution);
    $contributes_statement->execute();
    $contributes_statement->closecursor();

    $id_query = "SELECT LAST_INSERT_ID() FROM contributes_to";
    $id_statement = $db->prepare($id_query);
    $id_statement->execute();
    $pieceID = $id_statement->fetchAll()[0]['LAST_INSERT_ID()'];
    if($pieceID > 0) {
        return true;
    }
    else {
        return false;
    }
}

function getNumLikes(int $storyID) {
    global $db;
    $query = "SELECT COUNT(username) FROM `like` WHERE storyID=:storyID";
    $statement = $db->prepare($query);
    $statement->bindValue(':storyID', $storyID);
    $statement->execute();
    $results = $statement->fetch();
    $statement->closecursor();
    return $results[0];
}

function getNumDislikes(int $storyID) {
    global $db;
    $query = "SELECT COUNT(username) FROM `dislike` WHERE storyID=:storyID";
    $statement = $db->prepare($query);
    $statement->bindValue(':storyID', $storyID);
    $statement->execute();
    $results = $statement->fetch();
    $statement->closecursor();
    return $results[0];
}

function getComments(int $storyID) {
    global $db;
    $query = "SELECT * FROM `comment` WHERE storyID=:storyID";
    $statement = $db->prepare($query);
    $statement->bindValue(':storyID', $storyID);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closecursor();
    return $results;
}


function likeStory(int $storyID, $username) {
    global $db;
    $query = "SELECT username FROM dislike WHERE storyID = :storyID AND username = :username";
    $statement = $db->prepare($query);
    $statement->bindValue(':storyID', $storyID);
    $statement->bindValue(':username', $username);
    $statement->execute();
    $results = $statement->fetch();
    $results1 = $results[0];
    //echo "<h1>" . $results . "</h1>";
    if($username == $results1){
        $query = "DELETE FROM dislike WHERE username = :username AND storyID = :storyID";
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':storyID', $storyID);
        $statement->execute();
    }
    $query = "INSERT INTO `like` (username, storyID) VALUES (:username, :storyID)";
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->bindValue(':storyID', $storyID);
    $statement->execute();
    $statement->closecursor();
}

function dislikeStory(int $storyID, $username){
    global $db;
    $query = "SELECT username FROM `like` WHERE storyID = :storyID AND username = :username";
    $statement = $db->prepare($query);
    $statement->bindValue(':storyID', $storyID);
    $statement->bindValue(':username', $username);
    $statement->execute();
    $results = $statement->fetch();
    $results1 = $results[0];
    if($username == $results1){
        $query = "DELETE FROM `like` WHERE username = :username AND storyID = :storyID";
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':storyID', $storyID);
        $statement->execute();
    }
    $query = "INSERT INTO `dislike` (username, storyID) VALUES (:username, :storyID)";
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->bindValue(':storyID', $storyID);
    $statement->execute();
    $statement->closecursor();
    //return $results1;
}

function archiveStory(int $storyID, $username) {
    global $db;
    $query = "INSERT INTO `archive` (username, storyID) VALUES (:username, :storyID)";
    $statement = $db->prepare($query);
    $statement->bindValue('username', $username);
    $statement->bindValue(':storyID', $storyID);
    $statement->execute();
    $statement->closecursor();
}

function unarchiveStory(int $storyID) {
    global $db;
    $query = "DELETE FROM archive WHERE storyID = :storyID";
    $statement = $db->prepare($query);
    $statement->bindValue(':storyID', $storyID);
    $statement->execute();
    $statement->closecursor();
}

function publishStory(int $storyID, $username) {
    global $db;
    $query = "INSERT INTO `publish` (username, storyID) VALUES (:username, :storyID)";
    $statement = $db->prepare($query);
    $statement->bindValue('username', $username);
    $statement->bindValue(':storyID', $storyID);
    $statement->execute();
    $statement->closecursor();
}

function unpublishStory(int $storyID) {
    global $db;
    $query = "DELETE FROM publish WHERE storyID = :storyID";
    $statement = $db->prepare($query);
    $statement->bindValue(':storyID', $storyID);
    $statement->execute();
    $statement->closecursor();
}

function getCreator($storyID){
	global $db;
	$query = "SELECT username FROM `create` WHERE storyID = :storyid";
	$statement = $db->prepare($query);
	$statement->bindValue(':storyid', $storyID);
	$statement->execute();
    $results = $statement->fetchAll();
    $statement->closecursor();
    return $results[0]['username'];
}
?>