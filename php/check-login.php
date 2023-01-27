<?php  
require_once '../php/database-connect.php';
function displayMessage($message){
	echo "<h3 style='color:white;text-align:center;background-color:black; padding: 15px;'>" . $message . "</h3>";
}

// Display the user with any system messages
if(isset($_GET['system-msg'])){
	displayMessage($_GET['system-msg']);
	unset($_GET['system-msg']);
}

// Unset the current user cookie whenever on this page
if(isset($_COOKIE['currentUser'])){
	setcookie("currentUser", $_POST['login-username'], time()-3600);
}

if(isset($_POST['login-username']) && isset($_POST['login-password'])){

	$query = "SELECT Username, Password FROM Users WHERE Username='" . $_POST['login-username'] . "' AND Password='" . $_POST['login-password'] . "';";

	$result = connectDatabase('Library', $query);

	if($result->num_rows > 0){
		if(!isset($_COOKIE['currentUser'])){
			setcookie("currentUser", $_POST['login-username'], time()+3600);
		}

		// Redirect the user to the home page when logged in successfully
		header('Location: ' . 'search.php');
		die();

	} else{
		header("Location: http://localhost:8080/project/web-pages/login.php?system-msg=login details incorrect");
	}
}


?>