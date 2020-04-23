<?php
require('connectdb.php');
require('home-db.php');
require('story-db.php');
require('../vendor/autoload.php');
//require('signOut.php');

session_start();

if ( isset( $_SESSION['user']) ) {
    $style1 = "style='display:none;'";
    $style2 = NULL;
} else {
    $style1 = NULL;
     $style2 = "style='display:none;'";
    //  header('Location: signInPage.php');
}

// $action = "list_tasks";        // default action
?>
<!DOCTYPE HTML>
<!--
	Phantom by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Ellipsis</title>
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
						<h2 <?php echo $style1; ?> >Hello!</h2>
						<h2 <?php echo $style2; ?>>Hello, <?php echo $_SESSION['user']; ?>!</h2>
						<ul>
							<li><a href="home.php">Home</a></li>
							<li><a href="signInPage.php" <?php echo $style1;?>>Sign In</a></li>
							<li><a href="mypage.php"<?php echo $style2; ?>>My Page</a></li>
							<li><a href="signOut.php?logout=1"<?php echo $style2; ?>>Log Out</a></li>
							<?php
							if(isset($_GET['logout'])){
								session_unset();
								session_destroy();
							}?>					
						</ul>
					</nav>

				<!-- Main -->
					<div id="main">
						<div class="inner">
							<header>
								<h1>Welcome to Ellipsis...<br />
								a collaborative storywriting platform</h1>
								<p>Browse the genres below to find stories...<br />
								 Head to your profile to start a story of your own! </p>
							</header>
							<section class="tiles">
								<?php
									if($_SERVER['REQUEST_METHOD'] == 'GET') {
										$stories = getAllStories();
										include('home-story-view.php');
									}
								?>
								<!-- <article class="style1">
									<span class="image">
										<img src="images/pic01.jpg" alt="" />
									</span>
									<a href="generic.html">
										<h2>Fiction</h2>
										<div class="content">
											<p>Explore the world of make believe</p>
										</div>
									</a>
								</article>
								<article class="style2">
									<span class="image">
										<img src="images/pic02.jpg" alt="" />
									</span>
									<a href="generic.html">
										<h2>Non-Fiction</h2>
										<div class="content">
											<p>Truth be told</p>
										</div>
									</a>
								</article>
								<article class="style3">
									<span class="image">
										<img src="images/pic03.jpg" alt="" />
									</span>
									<a href="generic.html">
										<h2>Narrative</h2>
										<div class="content">
											<p>Tell a story</p>
										</div>
									</a>
								</article>
								<article class="style4">
									<span class="image">
										<img src="images/pic04.jpg" alt="" />
									</span>
									<a href="generic.html">
										<h2>Mystery</h2>
										<div class="content">
											<p>Who done it?</p>
										</div>
									</a>
								</article>
								<article class="style5">
									<span class="image">
										<img src="images/pic05.jpg" alt="" />
									</span>
									<a href="generic.html">
										<h2>Children's</h2>
										<div class="content">
											<p>No more than 20 words a page</p>
										</div>
									</a>
								</article>
								<article class="style6">
									<span class="image">
										<img src="images/pic06.jpg" alt="" />
									</span>
									<a href="generic.html">
										<h2>Short Stories</h2>
										<div class="content">
											<p>Short and Sweet</p>
										</div>
									
								</article> -->
							</section>
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