<!DOCTYPE html>
<?php require '../php/bypass-login-check.php' ?>
<html lang="en">
<head>
	<title>Reserved Books</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<link rel="stylesheet"  href="../css/style.css" >
</head>

<body id='home-body'>	

	<header>
		<div class='main-navigation flex-container'>
			<div id='current-user-information'>
				<span id='user-name'><b>Username:</b> <?php echo $_COOKIE['currentUser'] ?></span>
				<span id='date'><b>Date:</b> <?php echo date("Y-m-d")?></span>
				<span id='time'><b>Time:</b> <?php echo date("h:i:s")?></span>
			</div>

			<div class='flex-child logo'>
				<img src="../imgs/logo.png">
			</div>

			<div style="padding: 0;" class='flex-child'>
				<nav>
					<ul>
						<li><a href="search.php">Search Book</a></li>
						<li><a href="reserve.php">View Reserved</a></li>		
						<li><a href="../php/logout.php">Log Out</a></li>
					</ul>
				</nav>
			</div>
		</div>

	</header>

</body>

<?php require '../php/reserve-book.php' ?>

</html>
