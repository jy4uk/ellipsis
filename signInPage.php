<?php
require('connectdb.php');
require('signInPage-db.php');

// $action = "list_tasks";        // default action
?>
<!doctype html>
    <html>
    <head>
		<title>Sign In</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">
		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<div class="inner">

							<!-- Logo -->
								<a href="home.php" class="logo">
									<span class="symbol"><img src="images/logo.svg" alt="" /></span><span class="title">Ellipsis</span>
								</a>

							<!-- Nav -->
								<nav>
									<ul>
										<li><a href="#menu">Menu</a></li>
									</ul>
								</nav>

						</div>
					</header>
                    

				<!-- Menu -->
					<nav id="menu"> 
						<h2>Menu</h2>
						<ul>
                            <li><a href="home.php">Home</a></li>
							<li><a href="signInPage.php">Sign In</a></li>
                            <li><a href="mypage.php">My Page</a></li>
							<li><a href="generic.html">FAQ</a></li>
							<li><a href="generic.html">Donate</a></li>
                            
						</ul>
					</nav>

                <!-- Main -->

                <form method="post" action="signInPage.php">
                <input type = "text" placeholder="Username" name="Username" required/>
                <input type = "password" placeholder="Password" name="Password" required/>
                <input type = "submit" value="Submit!" name="SubmitLogin"/>
                </form>


            <!-- PHP CODE FOR CHECKING THE USERNAME AND PASSWORD IN THE DATABASE!!!! -->   
            <?php session_start();

            //broad function that is called when the username or password is incorrect and echoes which one was incorrect to the user
            function reject($entry){
                echo "<ul style='text-align: center; color: black;'>Incorrect " . $entry . ". Please try again or create an account.</ul>";
            }

            //check post request
            if($_SERVER['REQUEST_METHOD'] == "POST" && strlen($_POST['Username']) > 0) {
            //removes whitespace from the username entered
            $user = trim($_POST['Username']);
            //check to make sure username exists in database
            $userExists = getUser_by_username($user);
            if(!ctype_alnum($user) || !$userExists){
                reject('username');
            }
            //at this point the username is correct and the password needs to be checked
            else{
                if(isset($_POST['Password'])){
                    $pass = trim($_POST['Password']);
                    //$hash_pass = password_hash($pass, PASSWORD_DEFAULT);

                    //if the password is not comprised of exclusively alphanumeric characters, reject it
                    if(!ctype_alnum($pass)){
                        reject('password');
                    }
                    //password is all alphanumeric and we now check to make sure it corresponds to the password stored in the db for the given username
                    else{
                        #password correct check
                        $passwordIsCorrect = checkPasswordToUser($user, $pass);

                        if($passwordIsCorrect){
                            $_SESSION['user'] = $user;
                            $_SESSION['pass'] = $pass;
                            header('Location: mypage.php');
                        }
                        else{
                            reject('password');
                        }
                    }

            }
            }
        }
            ?>
            <!-- END OF THE PHP CODE FOR CHECKING USERNAME AND PASSWORD-->

            <div class="container">
                    <div class="row">
                        <div class = "column" >
                            &nbsp;
                        </div>
                        <div class="column">
                            <div class="row">
                                <div class="column" width="11%" style="text-align: center;">
                                    Not a User? Click here to <a href="signUp.php" style="color:black" class="btn">Sign Up</a>
                                </div>
                                <div class = "column" width="11%">
                                    &nbsp;
                                </div>
                                <div class="column" width="11%" style="text-align: center;">
                                    <a href="#" style="color:black" class="btn">Forgot password?</a>
                                </div>
                            <div class="row">
                        </div>

                        <div class = "column" width="25%">
                            &nbsp;
                        </div>
                    </div>
                </div>

            


            <script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
            </body>
            </html>   