<?php
    # start a new PHP session
    session_start();

    # include common file 
	include "common.php";                      
    
	// check if the used is connected
	if( ! isset( $_SESSION["user_connected"] ) ){
		redirect_to( "login.php" );
	}
	
	// print_r( $_SESSION );
	
	$current_user_id    = $_SESSION["user_id"];
	$current_user_email = $_SESSION["user_email"];
 
	// get the user data from database
	// we already stored the user email in the session in login step
	$user_data = find_user_by_email( $current_user_email );
	
	// print_r( $user_data );

	$error_message   = "";
	$success_message = "";

	// create new account
	if( count( $_POST ) ){  
		$email      = $_POST["email"];
		$password   = $_POST["password"];
		$first_name = $_POST["first_name"];
		$last_name  = $_POST["last_name"];

		if( ! $email || ! $password ){
			$error_message = '<br /><b style="color:red">Email and password are required!</b>';
		}
		else{
			// check if the user exist in table users 
				// IN A REAL WORLD APPLICATION, YOU SHOULD CHECK IT IN THE TABLE USER_AUTHENTICATIONS FOR ASSOCIATION
			$user_exists                = find_user_by_email( $email );
			$user_authentication_exists = find_authentication_by_email( $email );

			// if email used on authentications table, we display an error
			if( $user_authentication_exists ){
				$error_message = '<br /><b style="color:red">Email alredy associated  with another account!</b>';
			}
			else{
				if( $user_exists && $user_exists["id"] != $current_user_id ) {
					$error_message = '<br /><b style="color:red">Email alredy in use!</b>';
				}
				else{
					// update user details
					$is_ok = update_user_profile( $current_user_id, $email, $password, $first_name, $last_name);

					// is ok, restore the new email then redirect to his profile page
					if( $is_ok ) {
						$_SESSION["user_email"] = $email;
						
						redirect_to( "profile.php" );
					}
					else{
						$error_message = '<br /><b style="color:red">look like something bad happen!</b>';
					}
				}
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
<h1>Hi there, be cool and complete your registration</h1>
we need an email and a password at least
<br />
<br />
<br />
<form action="" method="post">
<table width="00%" border="0" cellpadding="2" cellspacing="2">
  <tr>
    <td valign="top"><fieldset>
      <legend>My information</legend>
      
      <table width="300" border="0" cellpadding="2" cellspacing="2">
        <tr>
          <td><div align="right"><strong>Email</strong></div></td>
          <td><input name="email" type="text" size="55" value="<?php echo $user_data["email"]; ?>" /></td>
          </tr>
        <tr>
          <td><div align="right"><strong>Password</strong></div></td>
          <td><input type="text" name="password" size="30" value="<?php echo $user_data["password"]; ?>" /></td>
          </tr>
        <tr>
          <td nowrap="nowrap"><div align="right"><strong>First name</strong></div></td>
          <td><input name="first_name" type="text" size="30" value="<?php echo $user_data["first_name"]; ?>" /></td>
          </tr>
        <tr>
          <td><div align="right"><strong>Last name</strong></div></td>
          <td><input type="text" name="last_name" size="30" value="<?php echo $user_data["last_name"]; ?>" /></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td align="right"><input type="submit" value="Complete my registration" /> </td>
          </tr>
        </table> 
    </fieldset></td>
    </tr>
</table>
</form>
<?php echo $error_message ?>
</center>
 
</body>
</html>