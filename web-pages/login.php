<!DOCTYPE html>
<html lang="en">
<head>
	<title>Library Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<link rel="stylesheet"  href="../css/style.css" >
</head>

<body>
	<div class='clear-back flex-container'>
		<img src="../imgs/logo.png">
	</div>

	<main style='margin-top: 5%;'>
		<div class='flex-container'>
			<div class='flex-single-row'>
				<div class='flex-child'>
					<form method='POST'>
						<div class='flex-child'>
							<label>Username</label>
							<input type="text" name="login-username" required="">
							<label>Password</label>
							<input type="password" name="login-password" required="">
							<button type='submit'>Login</button>
							<h3><?php echo $login_result; ?></h3>
						</div>
					</form>
				</div>

				<div class='divider flex-child'></div>

				<div class='flex-child'>
					<h2><i>Not registered yet?</i></h2>
					<p><a href="register.php">Register here</a></p>
					
				</div>
			</div>
		</div>

	</main>


	<footer>
		<?php include '../php/check-login.php';?>
	</footer>

</body>

</html>
