<?php
    # start a new PHP session
    session_start();

    include "common.php";                      # include common file
	include "../../hybridauth/hybridauth.php"; # include HybridAuth main file

	# check if the used is connected redirect him to profile page
	if( isset( $_SESSION["user_connected"] ) && $_SESSION["user_connected"] == 1 ){
		redirect_to( "profile.php" );
	}

	# create a new Hybrid_Auth instance
    $hybridauth = new Hybrid_Auth();

	# then make sure to end any existing Hybrid_Auth session
	$hybridauth->endSession(); 
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
	margin: 10px;
} 
-->
</style>
</head>
<body>
<center>
<br />
<h1>Welcome to the my simple login page</h1>
<br />
<br />
<br />
<table width="00%" border="0" cellpadding="2" cellspacing="2">
  <tr>
    <td valign="top"><fieldset>
        <legend>Sign-in form</legend>
        <form action="login_with_signin_form.php" method="post">
		<table width="300" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td><div align="right"><strong>Email</strong></div></td>
            <td><input type="text" name="email" /></td>
          </tr>
          <tr>
            <td><div align="right"><strong>Password</strong></div></td>
            <td><input type="text" name="password" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td align="right"><input type="submit" value="Sign-in" /> </td>
          </tr>
        </table>
		</form>
      </fieldset></td>
    <td valign="top" align="left"> 
		<fieldset>
			<legend>Don't have an account yet?</legend>
			&nbsp;&nbsp;<a href="new_user_classic_form.php">New Account Signup</a><br />  
		</fieldset> 

		<fieldset>
			<legend>Or use anohter service</legend>
			&nbsp;&nbsp;<a href="login_with_hybridauth.php?provider=Google&google_service=Users">Sign-in with Google</a><br /> 
			&nbsp;&nbsp;<a href="login_with_hybridauth.php?provider=Facebook">Sign-in with Facebook</a><br />
			&nbsp;&nbsp;<a href="login_with_hybridauth.php?provider=MySpace">Sign-in with MySpace</a><br />
			&nbsp;&nbsp;<a href="login_with_hybridauth.php?provider=Twitter">Sign-in with Twitter</a><br /> 
			&nbsp;&nbsp;<a href="login_with_hybridauth.php?provider=Yahoo">Sign-in with Yahoo</a><br /> 
		</fieldset>
	  </td>
  </tr>
</table>
</center>

<br />  <br />  <br />  <br />  <br />  <br />  <br />  <br />  <br />  
<hr /> 
<strong>Note:</strong> HybridAuth still in beta! Please let us know if you have any problem using it. Email: hybridauth@gmail.com<br />

</body>
</html>