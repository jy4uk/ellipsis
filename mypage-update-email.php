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

					<?php include('mypage-view.php'); ?>
                    <form action="mypage.php" method="post">
                        <div class="form-group">
                            <label for="email">New Email: </label>
                            <input type="text" name="email" class="form-control" name="email" />
                        </div> 
                        <input type="submit" value="Update" name="action"  class="btn btn-dark" title="Update Email" />   
                    </form>

            </div>
