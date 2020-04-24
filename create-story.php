<?php
require('connectdb.php');
require('story-db.php');
//require('../vendor/autoload.php');

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
								<a href="index.php" class="logo">
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
						<h2>Hello, <?php echo $_SESSION['user']; ?>!</h2>
						<ul>
                            <li><a href="index.php">Home</a></li>
							<li><a href="mypage.php">My Page</a></li>
                            <li><a href="signOut.php?logout=1">Log Out</a></li>
						</ul>
                    </nav>
                    
                    <div class="container">
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" id="story-create-form" method="post">
                        <div class="column" style="width=100%; text-align:center;">
                            <h1 style="color: black;">Start a new Story</h1>
                            <div class = "column">
                                &nbsp;
                            </div>
                        </div>
                            <div class = "column" style="text-align: left;">
                                <div class="row" style="width=33.33%;">
                                    <div class="column" style="width:33.33%; text-align: right;">
                                        <div style="color: black;"><i>Title:</i></div>
                                    </div>
                                    <div class="column" style="width:30%; text-align: left;">
                                        <div style="color: black;"><input type="text" id="title" name="title" placeholder="Title" required></div>
                                        <p><i>(40 characters max)</i></p>
                                    </div>
                                </div>
                                <br>
                                <div class="row" style="width=33.33%;">
                                    <div class="column" style="width:33.33%; text-align: right;">
                                        <div style = "color: black;"><i>Story beginning:</i></div>
                                    </div>
                                    <div class="column" style="width:50%; text-align:left;">
                                        <textarea name="first-piece" rows="7" cols="75" placeholder="Run wild..." style="border:solid 2px black;" required></textarea>
                                        <p><i>(1000 characters max)</i></p>
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
                    if(strlen($first_piece) > 1000) {
                        echo "Your beginning was too long (" . strlen($first_piece) . " characters entered)";
                    }
                    else if(strlen($title) > 100) {
                        echo "Your title was too long (" . strlen($title) . "characters entered)";
                    }
                    else {
                        $username = $_SESSION['user'];
                        $new_story_id = createNewStory($title, $first_piece, $username);
                        if($new_story_id > 0) {
                            header('Location: storypage.php?storyID=' . $new_story_id);
                        }
                        else {
                            echo "Something went wrong... storyid was " . $new_story_id;
                        }
                    }
                }

                ?>
        <!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

</html>