<?php require "registration_login.php" ?>

<!DOCTYPE html>
<html>
	<head>
		<!--Font Awesome-->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">

		<!--Stylesheets-->
		<link rel="stylesheet" type="text/css" href="main.css">
		<link rel="stylesheet" type="text/css" href="hamburger-menu.css">
		<link rel="stylesheet" type="text/css" href="reminder-toggle-switch.css">

		<title>Daily-Do</title>

	</head>
	<style>
		/* override footer position */
		.footer{
			position: absolute;
			bottom:0;
		}
	</style>
	<body>
		<div class="wrapper">
			<!-- Header -->
			<header>
				<div class="header">
					<div class="title">Daily-Do</div>
					<div class="desc">Manage your daily tasks</div>
				</div> 
			</header>
			<!--end of header-->
			
			<!--start of login/register -->
			<article id="form-container">
				<div class="form-header">Log In</div>
				<form class="login" method="post" action="login.php">
					<!-- display form errors -->
					<?php include('errors.php') ?>
					<div class="form-group">
						<label for="username">Username </label>
						<input type="text" name="username">
					</div>
					<div class="form-group">
						<label for="password">Password </label>
						<input type="password" name="password">
					</div>
					<button type="submit" name="login" class="btn-login">Log In</button> 
					<p>Not yet a member? <a class="changeFormLink" href="registration.php">Sign Up</a></p>
				</form>
			</article>

			<!--end of login/register-->
			<?php include "footer.php" ?>
		</div> <!-- end of wrapper -->
	</body>
</html>