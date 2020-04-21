<?php

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

function checkPasswordToUser($username, $password)
{
    return true;
    // echo "entered checkPasswordToUser function";
	global $db;
	
	// echo "in getTaskInfo_by_id " . $id ;
	
	$query = "SELECT password FROM user where username = :username";
	$statement = $db->prepare($query);
	$statement->bindValue(':username', $username);
	$statement->execute();
	
    $results = $statement->fetch();

    // $hash_results = password_hash($results[0], PASSWORD_DEFAULT);
    //echo $hash_results . "<br/>";
    //echo $password;
    $statement->closecursor();
    $hashpwd = $results[0];
    //echo $hashpwd . "<br/>";
    //echo $password;
    if($password == $hashpwd) {
        return true;
    }
    else{
        return false;
    }
	return false;
	// return $results;
}


function newUserSignUp($username, $hashed_pw, $name, $email_address) {
    global $db;

    $query = "SELECT username FROM user where username = :username";
	$statement = $db->prepare($query);
	$statement->bindValue(':username', $username);
	$statement->execute();
	$results = $statement->fetch();
    $statement->closecursor();
    
    //if username doesn't already exist/is not already in use
    if($results == '') {
        //insert into table
        $query = "INSERT INTO user (username, password, display_name, email_address) VALUES (:username, :password, :name, :email_addresss)";
	
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $hashed_pw);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':email_address', $email_address);
        $statement->execute();
        $statement->closeCursor();

        return "new user";
    }
    return "user found";
}
?>