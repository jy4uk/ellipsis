<?php
require('connectdb.php');
//require('../vendor/autoload.php');
// require('mypage-db.php');
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Welcome </title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">
        <!-- Session Start -->
        <?php session_start(); ?>

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<div class="inner">

							<!-- Logo -->
								<a href="home.php" class="logo">
                                    <span class="symbol"><img src="images/logo.svg" alt="" /></span><span class="title">Ellipsis</span>
                                </a>
                                <a href="create-story.php" class="logo" style="float: right;"><span class="title">Create Story</span></a>

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
							<li><a href="mypage.php">My Page</a></li>
                            <li><a href="signOut.php?logout=1">Log Out</a></li>
						</ul>
					</nav>
            </div>

            <?php
                if ($_SERVER['REQUEST_METHOD'] == 'GET')
                {
                    include('mypage-db.php');
                    echo "<hr/>";
                    $user = getUser($_GET['username']);
                    $username = '';
                    $displayname = '';
                    foreach($user as $u):
                        $username = $u['username'];
                        $displayname = $u['display_name'];
                    endforeach;
                    $likes = getUserLikes($username);
                    $dislikes = getUserDislikes($username);
                    $comments = getUserComments($username);
                    $follows = getUserFollows($username);
                    $stories = getUserStories($username);
                    $published = getPublished($username);
                   include('userpage-view.php');        // default action
                }
            ?>

        <!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
