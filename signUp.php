<?php
require('connectdb.php');
require('../vendor/autoload.php');
//require('signInPage-db.php');
require('signUp-db.php');
?>
<!doctype html>
<html>
	<head>
		<title>Sign Up</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	<body class="is-preload">
    <?php session_start(); 
                ?>
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
                            
						</ul>
					</nav>

                    <!-- ALL OF THE INPUTS  -->
                    <div class="container">
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                        <div class="row">
                            <h2 style="text-align: center; color: black;">Create a new account</h2>
                            <div class = "column">
                                &nbsp;
                            </div>
                            <div class = "column" style="text-align: center;">
                                <div class="row" style="width=33.33%;">
                                    <div class="column" style="width:50%; text-align: right;">
                                        <div style="color: black;">Username:</div>
                                    </div>
                                    <div class="column" style="width:50%; text-align: left;">
                                        <div style="color: black;"><input type="text" id="username" name="username" placeholder="Username" required></div>
                                    </div>
                                </div>
                                <div class="row" style="width=33.33%; text-align: center;">
                                    <div class="column" style="width:50%; text-align: right;">
                                        <div style = "color: black;">Password:</div>
                                    </div>
                                    <div class="column" style="width:50%; text-align: left;">
                                        <div style = "color: black;"><input type="password" name="password" id="password" placeholder="Password" required></div>
                                    </div>
                                </div>
                                <div class="row" style="width=33.33%; text-align: center;">
                                    <div class="column" style="width:50%; text-align: right;">
                                        <div style = "color: black;">Re-Type Password:</div>
                                    </div>
                                    <div class="column" style="width:50%; text-align: left;">
                                        <div style = "color: black;"><input type="password" id="retypePass" name="password2" placeholder="Re-type Password" required></div>
                                    </div>
                                </div>
                                <div class="row" style="width=33.33%;">
                                    <div class="column" style="width:50%; text-align: right;">
                                        <div style="color: black;">First Name:</div>
                                    </div>
                                    <div class="column" style="width:50%; text-align: left;">
                                        <div style="color: black;"><input type="text" id="display_name" name="display_name" placeholder="First Name" required></div>
                                    </div>
                                </div>
                                <div class="row" style="width=33.33%;">
                                    <div class="column" style="width:50%; text-align: right;">
                                        <div style="color: black;">Email Address:</div>
                                    </div>
                                    <div class="column" style="width:50%; text-align: left;">
                                        <div style="color: black;"><input type="text" id="email_address" name="email_address" placeholder="Email" required></div>
                                    </div>
                                </div>
                                &nbsp;
                                <input type="submit" id="submit" value="Create Account">
                            </div>
                        </div>
                    </form>
                </div>
                <script>
                    // DOM manipulation, event listener, arrow function
                    // Checking to make sure username and password values are long enough and that passwords match
                    document.getElementById("submit").addEventListener("click", () => {
                        var usernameCheck = document.getElementById("username").value;
                        var usernameLength = usernameCheck.length;
                        var passwordCheck = document.getElementById("password").value;
                        var retypePassword = document.getElementById("retypePass").value;
                        var passwordLength = passwordCheck.length;
                        var emailCheck = document.getElementById("email_address").value;

                        if (usernameLength < 5 && usernameLength != 0) {
                            alert("Username is too short. Must be longer than 5 characters.");
                        }
                        if(passwordLength < 5 && passwordLength != 0){
                            alert("Password is too short. Must be longer than 5 characters");
                        }
                        if(passwordCheck != retypePassword){
                            alert("Passwords do not match");
                        }
                        if(!emailCheck.includes("@")){
                            alert("Please enter a valid email");
                        }
                    });
                </script>
                    </div>
                </div>
                
                <!-- PHP CODE FOR ADDING NEW USERS TO THE DATABASE-->
                <?php
                if($_SERVER['REQUEST_METHOD'] == "POST" && strlen($_POST['username']) >= 5 && strlen($_POST['password']) >= 5){
                    $user = trim($_POST['username']);
                    $pass = trim($_POST['password']);
                    $hash_pwd = password_hash($pass, PASSWORD_DEFAULT);
                    $name = trim($_POST['display_name']);
                    $email = trim($_POST['email_address']);
                    if(newUserSignUp($user, $hash_pwd, $name, $email)){
                        //echo $hash_pwd;
                        echo "   Successfully signed up!";
                        header('Location: mypage.php');
                        }
                        else{
                        echo "hmmmm... it seems the sign up failed";
                            }
                }
                else{
                    echo "Sign up failed. Please try again";
                }
                ?>




            <br> </br>
            <div class="container">
                <div class="row">
                    <div class="column">
                        &nbsp;
                    </div>
                    <div class="column" style="text-align: center; color: black;">
                        Already have an account? <a href="signInPage.php" style="color: black;">Sign in here.</a>
                    </div>
                </div>
            </div>

            <script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
            </body>
            </head>