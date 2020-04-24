<?php
//require('../vendor/autoload.php');
function getUser($user) {
    global $db;
    $query = "SELECT * FROM user WHERE username=:user";
	$statement = $db->prepare($query);
	$statement->bindValue(':user', $user);
	$statement->execute();
	$results = $statement->fetchAll();
	$statement->closecursor();
	
	return $results;
}

function updateDisplayName($username, $displayname) {
    global $db;
	$query = "UPDATE user SET display_name=:displayname WHERE username=:username";
	$statement = $db->prepare($query);
	$statement->bindValue(':displayname', $displayname);
	$statement->bindValue(':username', $username);
	$statement->execute();
    $statement->closecursor();
}

function updateBio($user, $bio) {
    global $db;
	$query = "UPDATE user SET bio=:bio WHERE username=:username";
	$statement = $db->prepare($query);
	$statement->bindValue(':bio', $bio);
	$statement->bindValue(':username', $user);
	$statement->execute();
	$statement->closeCursor();
}

function updateEmail($user, $email) {
    global $db;
	$query = "UPDATE user SET email_address=:email WHERE username=:username";
	$statement = $db->prepare($query);
	$statement->bindValue(':email', $email);
	$statement->bindValue(':username', $user);
	$statement->execute();
	$statement->closeCursor();
}

function deleteAccount($user)
{
	global $db;
	
	$query = "DELETE FROM user WHERE username=:user";
	$statement = $db->prepare($query);
	$statement->bindValue(':user', $user);
	$statement->execute();
	$statement->closeCursor();
}

function getUserStories($user) {
	global $db;
    $query = "SELECT * FROM story NATURAL JOIN `create` NATURAL JOIN `user` WHERE username = :user";
	$statement = $db->prepare($query);
	$statement->bindValue(':user', $user);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closecursor();
    return $results;
}
function getActiveUserStories($user) {
	global $db;
    $query = "SELECT * FROM story NATURAL JOIN `create` NATURAL JOIN `user` where username = :user and storyID not in 
	(SELECT * from publish)  and storyID not in (select * from archive)";
	$statement = $db->prepare($query);
	$statement->bindValue(':user', $user);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closecursor();
    return $results;
}
function getUserLikes($user){
	global $db;
    $query = "SELECT * FROM `like` NATURAL JOIN story NATURAL JOIN `user` WHERE username = :user";
	$statement = $db->prepare($query);
	$statement->bindValue(':user', $user);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closecursor();
    return $results;
}

function getUserDislikes($user){
	global $db;
    $query = "SELECT * FROM `dislike` NATURAL JOIN story NATURAL JOIN `user` WHERE username = :user";
	$statement = $db->prepare($query);
	$statement->bindValue(':user', $user);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closecursor();
    return $results;
}


function getUserComments($user){
	global $db;
    $query = "SELECT * FROM `comment` NATURAL JOIN story NATURAL JOIN `user` WHERE username = :user";
	$statement = $db->prepare($query);
	$statement->bindValue(':user', $user);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closecursor();
    return $results;
}

function getUserFollows($user){
	global $db;
    $query = "SELECT * FROM `follow` NATURAL JOIN story NATURAL JOIN `user` WHERE username = :user";
	$statement = $db->prepare($query);
	$statement->bindValue(':user', $user);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closecursor();
    return $results;
}
function getArchives($user) {
    global $db;
    $query = "SELECT * FROM `archive`NATURAL JOIN story NATURAL JOIN `user` WHERE username = :user";
    $statement = $db->prepare($query);
	$statement->bindValue(':user', $user);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closecursor();
    return $results;
}
function getPublished($user) {
    global $db;
    $query = "SELECT * FROM `publish` NATURAL JOIN story NATURAL JOIN `user` WHERE username = :user";
    $statement = $db->prepare($query);
    $statement->bindValue(':user', $user);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closecursor();
    return $results;
}
function getCreator(int $storyID){
	global $db;
	$query = "SELECT username FROM `create` WHERE storyID = :storyID";
	$statement = $db->prepare($query);
	$statement->bindValue(':storyID', $storyID);
	$statement->execute();
    $results = $statement->fetchAll();
    $statement->closecursor();
    return $results[0]['username'];
}
?>