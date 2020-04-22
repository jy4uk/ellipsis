<?php
require('connectdb.php');
require('story-db.php');

?>
<!doctype html>
<html>
	<head>
		<title>Create Story</title>
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
							<li><a href="mypage.php">My Page</a></li>
                            <li><a href="signOut.php?logout=1">Log Out</a></li>
						</ul>
                    </nav>
                    
                    <div class="container">
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" id="story-create-form" method="post">
                        <div class="row">
                            <h2 style="text-align: left; color: black;">Start a new Story</h2>
                            <div class = "column">
                                &nbsp;
                            </div>
                        </div>
                            <div class = "column" style="text-align: left;">
                                <div class="row" style="width=33.33%;">
                                    <div class="column" style="width:33.33%; text-align: right;">
                                        <div style="color: black;">Title:</div>
                                    </div>
                                    <div class="column" style="width:30%; text-align: left;">
                                        <div style="color: black;"><input type="text" id="title" name="title" placeholder="Title" required></div>
                                    </div>
                                </div>
                                <br>
                                <div class="row" style="width=33.33%;">
                                    <div class="column" style="width:33.33%; text-align: right;">
                                        <div style = "color: black;">Story beginning:</div>
                                    </div>
                                    <div class="column" style="width:50%; text-align:left;">
                                        <textarea name="first-piece" rows="7" cols="75" placeholder="Run wild..." style="border:solid 2px black;" required></textarea>
                                    </div>
                                </div>
                                </div>
                                &nbsp;
                                <div class="column" style="width:100%; text-align: center;">
                                    <input type="submit" id="submit" value="Create Story">
                                </div>
                            </div>
                    </form>
                </div>

                <?php
                if($_SERVER['REQUEST_METHOD'] == 'POST' && strlen($_POST['title']) > 0 && strlen($_POST['first-piece']) > 0) {
                    $title = trim($_POST['title']);
                    $first_piece = $_POST['first-piece'];
                    $username = $_SESSION['user'];
                    $new_story_id = createNewStory($title, $first_piece, $username);
                    if($new_story_id > 0) {
                        header('Location: storypage.php?storyID=' . $new_story_id);
                    }
                    else {
                        echo "Something went wrong... storyid was " . $new_story_id;
                    }
                }

                ?>