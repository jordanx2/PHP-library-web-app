<?php  
	require_once '../php/database-connect.php';
	require '../php/system-message.php';

	$url = "Location: http://" . $_SERVER['HTTP_HOST'] . "/project/web-pages/reserve.php?MIN_LIMIT=" . $_GET['MIN_LIMIT']  . "&MAX_LIMIT=" . $_GET['MAX_LIMIT'];

	function printReservedTable($column1, $column2, $column3, $column4){
		$delete_url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . "&DELETE=" . $column3;
		$remove = "<a href='" . $delete_url . "'>remove</a>";

		echo '
		<style type="text/css">
		    .search-table {
		background-color: #074B6D;
		opacity: .93; 
		border-collapse: collapse;
		color: #fff;
		width: 100%;
		}

		table, th, td {
			border: 1px solid;
		}

		</style>';

		echo "<tr> 
		<td>".$column1."</td> 
		<td>".$column2."</td> 
		<td>".$column3."</td> 
		<td>".$column4."</td> 
		<td>". $remove ."</td> ";

	}

	function printEachRow($results){
		echo "<table class='search-table'>;
		<tr>
		<th>Username</th>
		<th>ReservedDate</th>
		<th>ISBN</th>
		<th>Book Title</th>
		</tr>";

		while($row = mysqli_fetch_array($results)){
			printReservedTable($row['Username'], $row['ReservedDate'], $row['ISBN'], $row['BookTitle']);
		}

		echo "</table>";
	}

	function handleReserveBook($ISBN, $uname, $current_date){
		$mark_book_reserved = "UPDATE Books SET Books.Reserved = 'Y' WHERE Books.ISBN='" . $ISBN . "';";

		$add_reservation = "INSERT INTO Reservations (ISBN, Username, ReservedDate) VALUES('" . $ISBN . "', '" .$uname . "', '". $current_date . "');"; 

		DML_Query('Library', $mark_book_reserved);
		DML_Query('Library', $add_reservation);
	}

	function removeReservation($ISBN){
		$delete_res = "DELETE FROM Reservations WHERE ISBN='$ISBN'";
		$unreserve_book = "UPDATE Books SET Books.Reserved = 'N' WHERE Books.ISBN='$ISBN'";

		echo $delete_res;
		echo '<br>';
		echo $unreserve_book;


		DML_Query('Library', $delete_res);
		DML_Query('Library', $unreserve_book);
	}


	// Check if a delete request is being made to the page
	if(isset($_GET['DELETE'])){
		$deleted_book = $_GET['DELETE'];
		$msg ="record with ISBN ('$deleted_book') unreserved";
		confirmReservationRemoval($deleted_book);

		if(isset($_POST['confirm-submit'])){
			removeReservation($deleted_book);
			unset($_GET["DELETE"]);
			$_GET['MIN_LIMIT'] = 0;
			$_GET['MAX_LIMIT'] = 5;
			header("Location: http://" . $_SERVER['HTTP_HOST'] . "/project/web-pages/reserve.php?MIN_LIMIT=" . $_GET['MIN_LIMIT']  . "&MAX_LIMIT=" . $_GET['MAX_LIMIT'] . "&system-msg=" . $msg);
			// header($url . "&system-msg=" . $msg);
		}

		if (isset($_POST['refuse-submit'])){
			header($url . "&system-msg=unreserve action aborted");
		}
		
	}

	// Check if the user wants to reserve a book
	if(isset($_GET['ISBN'])){
		$reserved_isbn = $_GET['ISBN'];
		$reserve_success = "reservation of book with ISBN ('$reserved_isbn') successful";
		handleReserveBook($_GET['ISBN'], $_COOKIE['currentUser'], date("Y-m-d"));
		unset($_GET['ISBN']);

		header($url . '&system-msg='.$reserve_success);

	} 	

	// Display all of the reserved books
	$view_reserved = "SELECT Reservations.Username, Reservations.ReservedDate, Reservations.ISBN, Books.BookTitle
	FROM Reservations
	INNER JOIN Books
	ON Reservations.ISBN = Books.ISBN
	WHERE Reservations.Username = '" . $_COOKIE['currentUser'] . "' LIMIT " . $_GET['MIN_LIMIT'] . ", " . $_GET['MAX_LIMIT'];


	$result_set = connectDatabase('Library', $view_reserved);

	if($result_set->num_rows > 0){
		printEachRow($result_set);

		$count_res = "SELECT COUNT(*) FROM Reservations WHERE Username ='" . $_COOKIE['currentUser'] . "';";
		$res_query = connectDatabase('Library', $count_res);
		$reservation_num = mysqli_fetch_array($res_query)[0];
		echo $result_set->num_rows;

		if($reservation_num > 5 and $result_set->num_rows == 5){
			echo "<a id='next-page' style='color:white;float:right; margin:15px; padding: 5px; background-color:black; font-weight: 700' href='http://localhost:8080/project/web-pages/reserve.php?MIN_LIMIT=" . intval($_GET['MIN_LIMIT'] + 5) . "&MAX_LIMIT=" . intval($_GET['MAX_LIMIT'] + 5) . "'>next page &#8594;</a>";
		} 

		else if($_GET['MIN_LIMIT'] >= 5 ){
			echo "<a style='color:white;float:left; margin:15px; padding: 5px; background-color:black; font-weight: 700' href='http://localhost:8080/project/web-pages/reserve.php?MIN_LIMIT=" . intval($_GET['MIN_LIMIT'] - 5) . "&MAX_LIMIT=" . intval($_GET['MAX_LIMIT'] - 5) . "'>&#8592; previous page</a>";
		}
	} else{
		displayMessage("no reservations present on system");
	}

	// Check if the system needs to display any information
	if(isset($_GET['system-msg'])){
		displayMessage($_GET['system-msg']);

		unset($_GET['system-msg']);
	}
?>
