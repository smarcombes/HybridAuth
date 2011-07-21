<?php
/**
 * HybridAuth
 * 
 * An open source Web based Single-Sign-On PHP Library used to authentify users with
 * major Web account providers and accessing social and data apis at Google, Facebook,
 * Yahoo!, MySpace, Twitter, Windows live ID, etc. 
 *
 * Copyright (c) 2009 (http://hybridauth.sourceforge.net)
 *
 * @package		Hybrid_Auth
 * @author		hybridAuth Dev Team
 * @copyright	Copyright (c) 2009, hybridAuth Dev Team.
 * @license		http://hybridauth.sourceforge.net/licenses.html under MIT and GPL
 * @link		http://hybridauth.sourceforge.net
 * @since		Version 1.0
 */

// ------------------------------------------------------------------------
   /**
	* Really Simple Signin test
	*
	* @author     Zachy <hybridauth@gmail.com> 
	*/
// ------------------------------------------------------------------------

    # start a new PHP session
    session_start();
    
    # include HybridAuth main file
    include "../../hybridauth/hybridauth.php";

    # create a new Hybrid_Auth instance
    $hybridauth = new Hybrid_Auth();

	// catch if error
	if( $hybridauth->hasError() )
	{
		$hybridauth->redirect( "login_error.php" );
	}

	// if user already connected, redirect to profile page
	if( $hybridauth->hasSession() )
	{
		$hybridauth->redirect( "profile.php" );
	}

	// if a provider has been selected
	if( isset( $_GET["provider"] )  )
	{
		$params                         = array(); 

		// URL of your application which will be called after authentication 
		$params["hauth_return_to"]      = $hybridauth->getCurrentUrl() ; // after authentication, return to this same page

		$provider                       = @ $_REQUEST["provider"];       // selected provider name 

		// setup a new connection// setup a new connection
		$provider_adapter = $hybridauth->setup( $provider, $params );

		// catch if setup error
		if( ! $provider_adapter )
		{
			$hybridauth->redirect( "login_error.php" );
		}

		// start login
		$login_is_ok = $provider_adapter->login();

		// catch if login error
		if( ! $login_is_ok )
		{
			$hybridauth->redirect( "login_error.php" );
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
	padding: 7px;
	border: 1px solid #999;
	margin: 10px;
}
PRE {
	background:#EFEFEF none repeat scroll 0 0;
	border-left:4px solid #CCCCCC;
	display:block;
	padding:15px;
}
-->
</style>
</head>
<body>
<h1>Welcome to the my simple login page</h1>
<br />

<table width="00%" border="0" cellpadding="2" cellspacing="2">
  <tr>
    <td valign="top"><fieldset>
        <legend>Sign-in form</legend>
        <table width="00%" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td><div align="right"><strong>login</strong></div></td>
            <td><input type="text" name="textfield" id="textfield" /></td>
          </tr>
          <tr>
            <td><div align="right"><strong>password</strong></div></td>
            <td><input type="text" name="textfield2" id="textfield2" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><div align="center">
                <input type="submit" value="Um supposed to be a Submit button, but i do nothing :)" />
              </div></td>
          </tr>
        </table>
      </fieldset></td>
    <td valign="top"><fieldset>
        <legend>Or use one of thoses identity providers</legend>
        &nbsp;&nbsp;<a href="?provider=Google&google_service=Users">Sign-in with Google</a>  (Gmail, Orkut, Youtube, etc.)<br /> 
        &nbsp;&nbsp;<a href="?provider=Facebook">Sign-in with Facebook</a><br />
        &nbsp;&nbsp;<a href="?provider=MySpace">Sign-in with MySpace</a><br />
        &nbsp;&nbsp;<a href="?provider=Twitter">Sign-in with Twitter</a><br />
        &nbsp;&nbsp;<a href="?provider=Live">Sign-in with Windows Live</a><br />
        &nbsp;&nbsp;<a href="?provider=Tumblr">Sign-in with Tumblr</a><br />
        &nbsp;&nbsp;<a href="?provider=Foursquare">Sign-in with Foursquare</a><br />
        &nbsp;&nbsp;<a href="?provider=LinkedIn">Sign-in with LinkedIn</a><br />
        &nbsp;&nbsp;<a href="?provider=Vimeo">Sign-in with Vimeo</a><br />
        &nbsp;&nbsp;<a href="?provider=Gowalla">Sign-in with Gowalla</a><br />
        &nbsp;&nbsp;<a href="?provider=Friendster">Sign-in with Friendster</a><br />
        &nbsp;&nbsp;<a href="?provider=PayPal">Sign-in with PayPal</a><br />
        &nbsp;&nbsp;<a href="?provider=Yahoo">Sign-in with Yahoo</a><br /> 
      </fieldset></td>
  </tr>
</table>

<br />  
<hr /> 
<strong>Note:</strong> HybridAuth still in beta! Please let us know if you have any problem using it. Email: hybridauth@gmail.com<br />
</body>
</html>