<?php

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
    $statement->closeCursor();
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

function deleteUser($user) {
	global $db;
	$query = "DELETE FROM user WHERE username=:username";
	$statement = $db->prepare($query);
	$statement->bindValue(':username', $user);
	$statement->execute();
	$statement->closeCursor();
}

?>