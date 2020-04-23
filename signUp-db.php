<?php 
require('../vendor/autoload.php');
function rejectUsername(){
    echo "<ul style='text-align: center; color: black;'>Username already exists/Username is not valid. </ul>";
} 

function newUserSignUp($username, $hashed_pw, $name, $email) {
    global $db;

    $query = "SELECT username FROM user where username = :username";
	$statement = $db->prepare($query);
	$statement->bindValue(':username', $username);
	$statement->execute();
	$results = $statement->fetch();
    $statement->closecursor();
    
    //if username doesn't already exist/is not already in use
    if($results == NULL) {
        //insert into table
        $query = "INSERT INTO user (username, password, display_name, email_address) VALUES (:username, :password, :display_name, :email_address)";
	
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $hashed_pw);
        $statement->bindValue(':display_name', $name);
        $statement->bindValue(':email_address', $email);
        $statement->execute();
        $statement->closeCursor();

        return true;
    }
    return false;
}

function getUser_by_username($username)
{
	global $db;
	
	// echo "in getTaskInfo_by_id " . $id ;
	
	$query = "SELECT * FROM user where username = :username";
	$statement = $db->prepare($query);
	$statement->bindValue(':username', $username);
	$statement->execute();
	
	// fetchAll() returns an array for all of the rows in the result set
	// fetch() return a row
	$results = $statement->fetch();
	
	// closes the cursor and frees the connection to the server so other SQL statements may be issued
    $statement->closecursor();
    // echo implode($results) . "<br/> "; //view user and password
    //echo implode($results);
    //echo “<h3 style=‘color: black;’>” . implode($results) . “</h3>”;
    if($results == NULL) {
        return false;
    }
	return true;
	// return $results;
}

?>