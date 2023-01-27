<!DOCTYPE html>

<html lang="en">
<head>
	<title>Registration</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<link rel="stylesheet"  href="../css/style.css" >
</head>

<body>
	<div class='clear-back flex-container'>
		<img src="../imgs/logo.png">
	</div>

	<main id='register-user-area'>
		
		<form method='POST' name='register-user'>
			<div class='left bottom right flex-single-row'>
				<div class='flex-container'>
					<div class='flex-child'>
						<label>First Name</label>
						<input type="text" name="firstname" required="">

						<label>Surname</label>
						<input type="text" name="surname" required="">

						<label>Telephone</label>
						<input type="text" name="telephone" required="">

						<label>Mobile</label>
						<input type="text" name="mobile" required="">
					</div>
				</div>

				<div class='flex-container'>
					<div class='flex-child'>
						<label>Address Line 1</label>
						<input type="text" name="address1" required="">

						<label>Address Line 2</label>
						<input type="text" name="address2" required="">

						<label>City</label>
						<input type="text" name="city" required="">				
					</div>
				</div>


			<div class='flex-container'>
				<div class='flex-child'>
					<label>Create Username</label>
					<input type="text" name="create-username" required="">

					<label>Create Password</label>
					<input type="password" name="create-password" required="">
					<button type='submit'>Register</button>

				</div>
			</div>
			</div>
		</form>


	</main>


	<footer>
		<?php require '../php/create-user.php' ?>
	</footer>

</body>

</html>
