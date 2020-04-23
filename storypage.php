<?php
//require('../vendor/autoload.php');
require('connectdb.php');
require('story-db.php');

session_start();

if ( isset( $_SESSION['user']) ) {
    $style1 = "style='display:none;'";
    $style2 = NULL;
} else {
    $style1 = NULL;
     $style2 = "style='display:none;'";
}

$story_details = getStoryDetails($_GET['storyID']);
$title = $story_details[0]['title'];
$author_display = $story_details[0]['display_name'];
$likes = getNumLikes($_GET['storyID']);
$dislikes = getNumDislikes($_GET['storyID']);
$comments = getComments($_GET['storyID']);
?>
<!DOCTYPE HTML>
<!--
	Phantom by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title><?php echo $title ?></title>
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

								<a href="create-story.php" class="logo" style="float: right;"><span class="title" <?php echo $style2; ?>>Create Story</span></a>

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
							<li><a href="signInPage.php" <?php echo $style1;?>>Sign In</a></li>
							<li><a href="mypage.php"<?php echo $style2; ?>>My Page</a></li>
							<li><a href="signOut.php?logout=1"<?php echo $style2; ?>>Log Out</a></li>
						</ul>
					</nav>

				<!-- Main -->
					<div id="main">
						<div class="row">
							<div class="column" style="width:75%; text-align:center">
								<h1><?php echo $title ?></h1>
								<h2><?php echo 'By: ' . $author_display ?> </h2>
								<br/>
							</div>
							<?php if(isset($_SESSION['user'])): ?>
								<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
								<input type="submit" value="Add to this story" name="action" class="btn" style="float: right;" />
								<input type="hidden" name="storyID" value="<?php echo $_GET['storyID']; ?>" />
								<input type="hidden" name="username" value="<?php echo $_SESSION['user']; ?>" />
								<?php if(getCreator($_GET["storyID"]) == $_SESSION["user"]):?>
									<br>
									<br>
									<input type="submit" value="ARCHIVE" name="action" class="btn" style="float: right;"/>             
								<?php endif; ?>
								</form>
						
							<?php endif; ?>
						</div>
						<div class="inner">
							
							<strong>Story Text:</strong>
							<br></br>
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
						<br/>
						
						<div class="inner">
							<h3>Liked by <?php echo $likes; ?> people | Disliked by <?php echo $dislikes; ?> people</h3>
							<div>
							<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
								<input type="submit" value="LIKE" name="action" class="btn" <?php echo $style2; ?>/>             
								<input type="hidden" name="storyID" value="<?php echo $_GET['storyID']; ?>" />
								<input type="hidden" name="username" value="<?php echo $_SESSION['user']; ?>" />

							</form>
							<?php
								if ($_SERVER['REQUEST_METHOD'] == 'POST')
								{
								   if ($_POST['action'] == 'LIKE')
								   {
									  likeStory($_POST['storyID'], $_POST['username']);
									  header('Location: storypage.php?storyID=' . $_GET['storyID']);
								   }
								   if ($_POST['action'] == 'ARCHIVE'){
									   archiveStory($_POST['storyID'], $_POST['username']);
								   }
								   if ($_POST['action'] == 'Add to this story') {
									   header('Location: contribute-story.php?storyID=' . $_POST['storyID']);
								   }
								}
							?>
							</div>
						</div>
						<div class="inner">
							<h3>Comments:</h3>
							<!-- insert comment form -->
							<?php foreach($comments as $comment): ?>
								<li style="font-style: bold;"><?php echo $comment['username'] . ": " . $comment['comment_text']; ?></li>
							<?php endforeach; ?>
						</div>
					</div>

				<!-- Footer -->
					<footer id="footer">
						<div class="inner">
							<section>
								<h2>Get in touch</h2>
								<form method="post" action="#">
									<div class="fields">
										<div class="field half">
											<input type="text" name="name" id="name" placeholder="Name" />
										</div>
										<div class="field half">
											<input type="email" name="email" id="email" placeholder="Email" />
										</div>
										<div class="field">
											<textarea name="message" id="message" placeholder="Message"></textarea>
										</div>
									</div>
									<ul class="actions">
										<li><input type="submit" value="Send" class="primary" /></li>
									</ul>
								</form>
							</section>
							<section>
								<h2>Follow</h2>
								<ul class="icons">
									<li><a href="#" class="icon brands style2 fa-twitter"><span class="label">Twitter</span></a></li>
									<li><a href="#" class="icon brands style2 fa-facebook-f"><span class="label">Facebook</span></a></li>
									<li><a href="#" class="icon brands style2 fa-instagram"><span class="label">Instagram</span></a></li>
									<li><a href="#" class="icon brands style2 fa-dribbble"><span class="label">Dribbble</span></a></li>
									<li><a href="#" class="icon brands style2 fa-github"><span class="label">GitHub</span></a></li>
									<li><a href="#" class="icon brands style2 fa-500px"><span class="label">500px</span></a></li>
									<li><a href="#" class="icon solid style2 fa-phone"><span class="label">Phone</span></a></li>
									<li><a href="#" class="icon solid style2 fa-envelope"><span class="label">Email</span></a></li>
								</ul>
							</section>
							<ul class="copyright">
								<li>&copy; Untitled. All rights reserved</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
							</ul>
						</div>
					</footer>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>