<?php
require('connectdb.php');
require('story-db.php');
//require('../vendor/autoload.php');

$story_details = getStoryDetails($_GET['storyID']);
$title = $story_details[0]['title'];
$author_display = $story_details[0]['display_name'];

?>
<!doctype html>
<html>
	<head>
		<title>Contribute to a Story</title>
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
                            <h1 style="color: black;">Contributing to: <i><?php echo $title; ?></i></h1>
                            <p>(Originally created by <strong><?php echo $author_display; ?></strong>)</p>
                            <div class = "column">
                                &nbsp;
                            </div>
                        </div>
                            <div class = "column" style="text-align: left;">
                                <div class="row" style="width=33.33%;">
                                    <div class="column" style="width:33.33%; text-align: right;">
                                        <div style="color: black;"><i>Current text:</i></div>
                                    </div>
                                    <div class="column" style="width:30%; text-align: left;">
                                        <div style="color: black;">
                                        <?php
                                            $pieces = getStoryPieces($_GET['storyID']);
                                            $whole_story = '';
                                            foreach ($pieces as $piece):
                                                //echo $piece[0];
                                                $whole_story .= ' ' . $piece[0];
                                            endforeach;
                                            echo '<p>' . $whole_story . '</p>';
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row" style="width=33.33%;">
                                    <div class="column" style="width:33.33%; text-align: right;">
                                        <div style = "color: black;"><i>Your contribution:</i></div>
                                    </div>
                                    <div class="column" style="width:50%; text-align:left;">
                                        <textarea name="contribution" rows="7" cols="75" placeholder="Run wild..." style="border:solid 2px black;" required></textarea>
                                        <p><i>(1000 characters max)</i></p>
                                    </div>
                                </div>
                                </div>
                                &nbsp;
                                <div class="column" style="width:100%; text-align: center;">
                                    <input type="submit" id="submit" value="Submit contribution">
                                </div>
                            </div>
                            <input type="hidden" name="storyID" value="<?php echo $_GET['storyID']; ?>" />
                    </form>
                </div>

                <?php
                if($_SERVER['REQUEST_METHOD'] == 'POST' && strlen($_POST['contribution']) > 0) {
                    $contribution = $_POST['contribution'];
                    if(strlen($contribution) > 1000) {
                        echo "Your contribution was too long (" . strlen($contribution) . " characters entered)";
                    }
                    else {
                        $username = $_SESSION['user'];
                        $result = makeContribution($contribution, $username, $_POST['storyID']);
                        if($result) {
                            header('Location: storypage.php?storyID=' . $_POST['storyID']);
                        }
                        else {
                            echo "Something went wrong...";
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
