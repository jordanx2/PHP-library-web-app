<?php  
require_once '../php/database-connect.php';

function printTable($column1, $column2, $column3, $column4, $column5, $column6, $column7){
	$display_reserve = '';

	if(strcmp(strval($column7), "Y")){
		$display_reserve = "<a href='reserve.php?ISBN=" . htmlentities($column1) .  "&MIN_LIMIT=0&MAX_LIMIT=5'>Reserve Now</a>";
	} else{
		$display_reserve = strtoupper('Unavailable');
	}

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
	<td>".date("Y", strtotime($column5)) ."</td> 
	<td>".$column6 . "</td> 
	<td>".$display_reserve. "</td> 
	</tr>";

}

function successfulSearch($exe_query){
	echo "<table class='search-table'>;
	<tr>
	<th>ISBN</th>
	<th>Title</th>
	<th>Author</th>
	<th>Edition</th>
	<th>Year</th>
	<th>Category</th>
	<th>Reserved</th>
	</tr>";

	while($row = mysqli_fetch_array($exe_query)){
		printTable($row['ISBN'],$row['BookTitle'], $row['Author'], $row['Edition'], $row['Year'], $row['CategoryDescription'], $row['Reserved']);
	}

	echo "</table>";
}


function executeSearch($query, $search_box, $search_type, $category){
	$execution_message = '';
	$exe_query = connectDatabase('Library', $query);

	if($exe_query->num_rows > 0){
		// Case for complete successful search
		successfulSearch($exe_query);
		$execution_message = 'Search Successful for: '. $search_box;

	} 
	else if($exe_query->num_rows == 0){
		// Partial Search on just the book title
		$first_word = explode(" ",$search_box)[0];

		$partial_search = "SELECT Books.ISBN,Books.BookTitle,Books.Author,
		Books.Edition,Books.Year,Categories.CategoryDescription, 
		Books.Reserved 
		FROM Books 
		INNER JOIN Categories
		ON Books.Category =Categories.CategoryID
		WHERE Books." . $search_type .  " LIKE '%" . $first_word . "%';";

		$exe_partial = connectDatabase('Library', $partial_search);

		if($exe_partial->num_rows > 0){
			successfulSearch($exe_partial);
			$execution_message = 'Partial success found with: ' . $search_type;
		}  else{
			// Show the books by catogories if partial comes back false
			$display_cato = "SELECT Books.ISBN, Books.BookTitle, Books.Author,
			Books.Edition, Books.Year, Categories.CategoryDescription, 
			Books.Reserved 
			FROM Books 
			INNER JOIN Categories
			ON Books.Category = Categories.CategoryID
			WHERE Categories.CategoryDescription='" . $category . "';";

			$category_search = connectDatabase('Library', $display_cato);
			if($category_search->num_rows > 0){
				successfulSearch($category_search);
				$execution_message = 'Search unsuccessful for: ' . $search_box . '<br>Categories found in: ' . $category;
			} else{
				// If both main search and partial come back false display as following
				$execution_message = 'Search unsuccessful. Please re-check and try again';
			}
		}
	}

	$exe_query->free();
	$mysqli->thread_id;

	return $execution_message;

}


if($_POST && !empty($_POST['search-box']) && intval($_POST['search-box']) <= 500){
	if(isset($_POST['catogory-type']) 
		&& isset($_POST['search-type'])  
		&& isset($_POST['search-box'])){

		$search_input =  $_POST['search-box'];
		$cato_drop = $_POST['catogory-type'];
		$type_box = htmlentities(trim($_POST['search-type']));


		$search_query = "SELECT Books.ISBN, Books.BookTitle, Books.Author,
		Books.Edition, Books.Year, Categories.CategoryDescription, 
		Books.Reserved 
		FROM Books 
		INNER JOIN Categories
		ON Books.Category = Categories.CategoryID
		WHERE Books." . $type_box .  " ='" . $search_input . "'" . " AND Categories.CategoryDescription='" . $cato_drop . "';";

		$search_status = executeSearch($search_query, $search_input, $type_box, $cato_drop);

		require_once '../php/system-message.php';
		displayMessage($search_status);

		}
	}	 

?>

