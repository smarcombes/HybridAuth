<?php
    # start a new PHP session
    session_start();

    # include common file 
	include "common.php";                      
    
	// check if the used is connected
	if( isset( $_SESSION["user_connected"] ) && $_SESSION["user_connected"] == 1 ){
		redirect_to( "profile.php" );
	}
 
	$error_message   = "";
	$success_message = "";

	// start login process
	if( count( $_POST ) ){  
		$email      = $_POST["email"];
		$password   = $_POST["password"]; 

		if( ! $email || ! $password ){
			$error_message = '<br /><b style="color:red">Email and password are required! Go back to <a href="login.php">Sign-in</a> page.</b>';
		}
		else{
			# check if the user exist in table users  
			$user_data = find_user_by_email_and_passord( $email, $password );

			# if yes, we create a session for him 
				# or you can you cookies / database to be more persistent
			if( $user_data ) {
				$_SESSION["user_connected"] = 1;
				$_SESSION["user_id"]        = $user_data["id"];
				$_SESSION["user_email"]     = $user_data["email"];
				
				redirect_to( "profile.php" );
			}
			else{
				// error
				$error_message = '<br /><b style="color:red">Bad Email or password! Go back to <a href="login.php">Sign-in</a> page and try again.</b>';
			}
		}
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en">
<head>
<style type="text/css" media="screen">
<!--
BODY {
	margin: 10px;
	padding: 0;
}
H1 {
	margin-bottom: 2px;
	font-family: Garamond, "Times New Roman", Times, Serif;
}
FIELDSET {
	border: 1px solid #ccc;
	padding: 1em;
	margin: 0;
}
LEGEND {
	color: #666666;
}
INPUT {
	display: block;
	font-family: Arial, verdana;
	padding: 5px; 
	margin: 5px;
} 
-->
</style>
</head>
<body>
<center>
<br /> 
<br />
<?php
	// if error, notice him and die
	if( $error_message ) {
		die( $error_message );
	}
?>