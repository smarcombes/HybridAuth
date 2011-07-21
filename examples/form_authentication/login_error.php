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

    # start a new PHP session
    session_start();
    
    # include HybridAuth main file
    include "../../hybridauth/hybridauth.php";

    # create a new Hybrid_Auth instance
    $hybridauth = new Hybrid_Auth();
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
-->
</style>
</head>
<body>

<h1>Ooops, Login error!</h1>

<br />

<?php
	echo $hybridauth->getErrorMessage();
?>

<br />
<br />

<a href="login.php">Please try again.</a>

<br />
<br />

<hr />

<h3>Extra</h3> 

<?php
	echo "<pre>" . $hybridauth->getErrorTrace() . "</pre>";
?>

</body>
</html>
<?php
	// require, to expire all error after displaying them to the user
	$hybridauth->expireStorage(); 
?>

<br />  
<hr /> 
<strong>Note:</strong> HybridAuth still in beta! Please let us know if you have any problem using it. Email: hybridauth@gmail.com<br />
