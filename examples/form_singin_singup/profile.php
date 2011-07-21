<?php
    # start a new PHP session
    session_start();

    # include common file 
	include "common.php";                      
 
	// check if the used is connected
	if( ! isset( $_SESSION["user_connected"] ) ){
		redirect_to( "login.php" );
	}

	// get the user data from database
	// we already stored the user email in the session in login step
	$user_data = find_user_by_email( $_SESSION["user_email"] );

	// if the user has not an adresse email  in our database
	// then we beg him to complete his registration
	if( ! $user_data["email"] ){
		redirect_to( "complete_user_registration_form.php" );
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
-->
</style>
</head>
<body>


<h1>Welcome back</h1>
<br />
<table width="100%" border="0" cellpadding="2" cellspacing="2">
  <tr>
    <td valign="top">
		<fieldset>
        <legend>My Profile information</legend>
		<table width="100%" cellspacing="0" cellpadding="3" border="0">
		<tbody>
		  <tr>
			<td width="10%">UID</td>
			<td width="83%">&nbsp; <?php echo $user_data["id"]; ?></td>
		  </tr> 
		  <tr>
			<td width="10%">Email</td>
			<td width="83%">&nbsp; <?php echo $user_data["email"]; ?></td>
		  </tr> 
		  <tr>
			<td width="10%">First name</td>
			<td width="83%">&nbsp; <?php echo $user_data["first_name"]; ?></td>
		  </tr> 
		  <tr>
			<td width="10%">Last name</td>
			<td width="83%">&nbsp; <?php echo $user_data["last_name"]; ?></td>
		  </tr> 
		</tbody>
		</table>
      </fieldset>
	</td>
  </tr>
</table>

&nbsp;<a href="logout.php">Logout</a>

</body>
</html>