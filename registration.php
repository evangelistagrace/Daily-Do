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
		<!--jQuery-->
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"
			  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
			  crossorigin="anonymous"></script>

		<title>Daily-Do</title>

	</head>
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
				<div class="form-header">Sign Up</div>
				<form class="register" method="post" action="registration.php">
				<!-- display form errors -->
				<?php include('errors.php') ?>
                <div class="form-group">
                    <label for="username">Username </label>
                    <input type="text" name="username" value="<?php echo $username; ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email </label>
                    <input type="text" name="email" value="<?php echo $email; ?>">
				</div>
				<div class="form-group">
					<label for="userType">I am a</label>
					<div class="select-user-type">
						<select name="userType">
							<option>Student</option>
							<option>Parent</option>
						</select>
						<label class="optional" style="display:none;" for="childUsername">Child Name 
                    <input type="text" name="childUsername" value="<?php echo $childUsername; ?>"></label>
					</div>
				</div>
				<div class="form-group">
					<label for="password_1">Password </label>
					<input type="password" name="password_1">
					</div>
                <div class="form-group">
					<label for="password_2">Confirm password </label>
					<input type="password" name="password_2">
                </div>
                <button type="submit" name="register" class="btn-register">Register</button> 
                <p>Already a member? <a class="changeFormLink" href="login.php">Log In</a></p>
                </form>
			</article>
			
			<!--end of login/register-->
			<?php include "footer.php" ?>
		</div> <!-- end of wrapper -->

		<script type="text/javascript">
		$('select').change(function(){
     if($('select option:selected').text() == "Parent"){
        $('label.optional').show();
     }
     else{
        $('label.optional').hide();
     }
 });
		</script>
	</body>
</html>