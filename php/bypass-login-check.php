<?php  
	if(!isset($_COOKIE['currentUser'])){
		header("Location: http://localhost:8080/project/web-pages/login.php?system-msg=please login before continuing");
	}
?>
