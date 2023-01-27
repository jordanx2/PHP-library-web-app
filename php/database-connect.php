<?php  
function connectDatabase($database_name, $query){
		// Create the connection
	$conn = new mysqli('localhost', 'root', '', $database_name);

	if($conn->connection_error){
		die("Connection failed: " . $conn->connection_error);
		return;
	} 

	
	return $conn->query($query);

}

function DML_Query($database_name, $query){
		// Create the connection
	$conn = new mysqli('localhost', 'root', '', $database_name);

	if($conn->connection_error){
		die("Connection failed: " . $conn->connection_error);
	} 

	if ($conn->query($query) !== TRUE) {
		echo "Error: " . $query . "<br>" . $conn->error;
	}

	$conn->close();
}

function printData($result, $col1){
	// For testing purposes only
	while($row = mysqli_fetch_array($result)) {
		echo $col1 . $row[$col1];
	}
}


?>