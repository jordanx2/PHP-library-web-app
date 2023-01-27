<?php
  
	function displayMessage($message){
		echo "<h3 style='color:white;text-align:center;background-color:black; padding: 15px;'>" . $message . "</h3>";
	}

	function confirmReservationRemoval($isbn){
		echo "
			<div style='color:white;text-align:center;background-color:black; padding: 15px;'>
				<form method='POST'>
					<h3>confirm reservation removal of book with ISBN ($isbn) ?</h3>
					<button name='confirm-submit' type='sumbit'>confirm</button>
					<button name='refuse-submit' type='submit'>reject</button>
				</form>

			</div>

		";
	}
?>
