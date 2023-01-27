<?php  
require '../php/system-message.php';
function passwordConfirmation($password){
	if(strlen($password) != 6){
		displayMessage("Password must be 6 characters in length");
		return FALSE;
	}
	return TRUE;
}

function mobileNumberValidation($mobile){
	if(!is_numeric($mobile)){
		displayMessage("Mobile number must be a numeric value");
		return FALSE;
	}

	if(strlen($mobile) != 10){
		displayMessage("Mobile number must be 10 numbers in length");
		return FALSE;
	}

	return TRUE;
}


if(isset($_POST['create-username']) 
	&& isset($_POST['create-password'])
	&& isset($_POST['firstname']) 
	&& isset($_POST['surname']) 
	&& isset($_POST['address1'])
	&& isset($_POST['address2'])
	&& isset($_POST['city'])
	&& isset($_POST['telephone'])
	&& isset($_POST['mobile'])){

	if(passwordConfirmation($_POST['create-password'])){
		if(mobileNumberValidation($_POST['mobile'])){
			require_once '../php/database-connect.php';
			
			$usname = $_POST['create-username'];
			$pwd = $_POST['create-password'];
			$first = $_POST['firstname'];

			$sname = $_POST['surname'];
			$adr1 = $_POST['address1'];
			$adr2 = $_POST['address2'];

			$city = $_POST['city'];
			$tele = $_POST['telephone'];
			$mobile = $_POST['mobile'];

			$insert_statement =  "INSERT INTO Users"  . " (`Username`, `Password`, `FirstName`, `Surname`, `AddressLine1`, `AddressLine2`, `City`, `Telephone`, `Mobile`) " . " VALUES ('" .$usname . "', '" . $pwd . "', '" . $first . "', '" . $sname . "', '" . $adr1 . "', '" . $adr2 . "', '" . $city . "', '" . $tele	. "', '" . $mobile  . "');";

			DML_Query('Library' , $insert_statement);
			echo strlen($password);

			// Redirect the user to the home page when user is successfully registered
			header("Location: http://localhost:8080/project/web-pages/login.php?system-msg=registration successful for username ($usname)");
		}

	}
} 

?>