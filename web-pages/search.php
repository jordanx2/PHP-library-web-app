<!DOCTYPE html>
<?php require '../php/bypass-login-check.php' ?>
<html lang="en">
<head>
	<title>Search Books</title>
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
						<li><a href="reserve.php?MIN_LIMIT=0&MAX_LIMIT=5">View Reserved</a></li>		
						<li><a href="../php/logout.php">Log Out</a></li>
					</ul>
				</nav>
			</div>
		</div>
	</header>

	<main style="margin-top: 5px">
		<form class='flex-single-row' method="POST">
			<div class='flex-child search-parent'>
				<div class='flex-container'>
					<label>Search</label>
					<input type="text" name="search-box">
				</div>

				<div style="display: inline-block;">
					<button name='search-submit' type='sumbit'>Search</button>
				</div>
			</div>

			<div class='flex-child search-parent'>
				<div class='flex-container'>
					<label for="search-type">Redefine</label>
					<select name="search-type" id="search-redefine">
						<option value="BookTitle">Book Title</option>
						<option value="Author">Author</option>
					</select>
				</div>
			</div>

			<div class='flex-child search-parent'>
				<div class='flex-container'>
					<label for="catogory-type">Catogory</label>
					<select name="catogory-type" id="search-catogory">
						<option value="health">Health</option>
						<option value="business">Business</option>
						<option value="biography">Biography</option>
						<option value="technology">Technology</option>
						<option value="travel">Travel</option>
						<option value="self-help">Self-Help</option>
						<option value="cookery">Cookery</option>
						<option value="fiction">Fiction</option>
					</select>
				</div>
			</div>

		</form>


	</main>


	<footer>
		
	</footer>

</body>

<?php require '../php/book-search.php' ?>
	
</html>
