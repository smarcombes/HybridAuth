<?php
    # start a new PHP session
    session_start();

    include "common.php";                      # include common file 
    
	// check if the used is connected
	if( isset( $_SESSION["user_connected"] ) && $_SESSION["user_connected"] == 1 ){
		redirect_to( "profile.php" );
	}
 
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
					// create new user
					$is_ok = create_new_user( $email, $password, $first_name, $last_name);

					if( $is_ok ) {
						$success_message = '<br /><b style="color:green">Well! seems all correct, go <a href="login.php">Sign-in</a> if you want.</b>';
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
<h1>New Account Signup</h1>
<br />
<?php
	// if user created, notice him and die
	if( $success_message ) {
		die( $success_message );
	}
?>
<br />
<form action="" method="post">
<table width="00%" border="0" cellpadding="2" cellspacing="2">
  <tr>
    <td valign="top"><fieldset>
        <legend>Sign-up form</legend>

        <table width="300" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td><div align="right"><strong>Email</strong></div></td>
            <td><input name="email" type="text" size="55" /></td>
          </tr>
          <tr>
            <td><div align="right"><strong>Password</strong></div></td>
            <td><input type="text" name="password" size="30" /></td>
          </tr>
          <tr>
            <td nowrap="nowrap"><div align="right"><strong>First name</strong></div></td>
            <td><input name="first_name" type="text" size="30" /></td>
          </tr>
          <tr>
            <td><div align="right"><strong>Last name</strong></div></td>
            <td><input type="text" name="last_name" size="30" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td align="right"><input type="submit" value="Create new account" /> </td>
          </tr>
        </table> 
      </fieldset></td>
    <td valign="top"> 
		<fieldset>
			<legend>Already have an account?</legend>
			&nbsp;&nbsp;<a href="login.php">Sign-in</a><br />  
		</fieldset>  
	  </td>
  </tr>
</table>
</form>
<?php echo $error_message ?>
</center>

 

<br />  <br />  <br />   
<hr /> 
<strong>Note:</strong> HybridAuth still in beta! Please let us know if you have any problem using it. Email: hybridauth@gmail.com<br />

</body>
</html>