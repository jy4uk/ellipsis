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
$author_user = $story_details[0]['username'];
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
								<h1><?php echo '<i>' . $title . '</i>' ?></h1>
								<!-- <h2><?php echo 'By: <a href="userPage.php">' . $author_display . '</a>'?> </h2> -->
								<?php echo "<p>By: <strong><a href='userPage.php?username=" . $author_user . "'>" . $author_display . "</a></strong></p>"; ?>
								<br/>
							</div>
							<?php if(isset($_SESSION['user'])) { ?>
								<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
								<input type="hidden" name="storyID" value="<?php echo $_GET['storyID']; ?>" />
								<input type="hidden" name="username" value="<?php echo $_SESSION['user']; ?>" />
								<?php if(!isPublished($_GET['storyID']) && !isArchived($_GET['storyID'])) { ?>
									<input type="submit" value="Add to this story" name="action" class="btn" style="float: right;" />
								<?php }
								else { ?>
									<p style="float: right;"><strong>Further contributions halted by creator</strong></p>
								<?php } ?>
								<?php if(getCreator($_GET["storyID"]) == $_SESSION["user"]) {?>
									<br>
									<br>
									<?php if(isPublished($_GET['storyID'])) { ?>
										<input type="submit" value="UNPUBLISH" name="action" class="btn" style="float: right;"/>
									<?php }
									else if (!isArchived($_GET['storyID'])) { ?>
										<input type="submit" value="PUBLISH" name="action" class="btn" style="float: right;"/>
									<?php } ?>
									<br>
									<br>
									<?php if(isArchived($_GET['storyID'])) { ?>
										<input type="submit" value="UNARCHIVE" name="action" class="btn" style="float: right;"/>
									<?php }
									else { ?>
										<input type="submit" value="ARCHIVE" name="action" class="btn" style="float: right;"/>
									<?php } ?>
								<?php }}; ?>
								</form>

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
								<input type="submit" value="DISLIKE" name="action" class="btn" <?php echo $style2; ?>/>      
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
									if ($_POST['action'] == 'DISLIKE'){
										dislikeStory($_POST['storyID'], $_POST['username']);
										header('Location: storypage.php?storyID=' . $_GET['storyID']);
									}
									if ($_POST['action'] == 'ARCHIVE'){
										archiveStory($_POST['storyID'], $_POST['username']);
										header('Location: storypage.php?storyID=' . $_GET['storyID']);
									}
									if ($_POST['action'] == 'UNARCHIVE') {
									   unarchiveStory($_POST['storyID']);
									   header('Location: storypage.php?storyID=' . $_GET['storyID']);
									}
									if ($_POST['action'] == 'Add to this story') {
										header('Location: contribute-story.php?storyID=' . $_POST['storyID']);
									}
									if ($_POST['action'] == 'PUBLISH'){
										publishStory($_POST['storyID'], $_POST['username']);
										header('Location: storypage.php?storyID=' . $_GET['storyID']);
									}
									if ($_POST['action'] == 'UNPUBLISH') {
										unpublishStory($_POST['storyID']);
										header('Location: storypage.php?storyID=' . $_GET['storyID']);
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

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>