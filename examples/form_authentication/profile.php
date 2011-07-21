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

	// if user is not connected, redirect to login page
	if( ! $hybridauth->hasSession() )
	{
		$hybridauth->redirect( "login.php" );
	}
	
	$provider_adapter = $hybridauth->wakeup(); 
 
	$user_data = $provider_adapter->user()->profile;
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


<h1>Welcome <?php echo $user_data->displayName; ?></h1>
<br />

<table width="100%" border="0" cellpadding="2" cellspacing="2">
  <tr>
    <td valign="top"><fieldset>
        <legend>My Profile information</legend>
        <table>
          <tr>
            <td width="150" valign="top" align="center">
				<?php
					if( $user_data->photoURL ){
				?>
					<a href="<?php echo $user_data->profileURL; ?>"><img src="<?php echo $user_data->photoURL; ?>" title="<?php echo $user_data->displayName; ?>" border="0" width="100" height="120"></a>
				<?php
					}
					else{
				?> 
				<img src="avatar.png" title="<?php echo $user_data->displayName; ?>" border="0" >
				<?php
					} 
				?> 
				&nbsp; <br />
				<a href="logout.php">Logout</a>
			</td>
            <td><table width="100%" cellspacing="0" cellpadding="3" border="0">
                <tbody>
                  <tr>
                    <td width="10%">providerID</td>
                    <td width="83%">&nbsp; <?php echo $provider_adapter->user()->providerId; ?></td>
                  </tr>
                  <tr>
                    <td>timestamp</td>
                    <td>&nbsp; <?php echo $provider_adapter->user()->timestamp; ?></td>
                  </tr>
                  <tr>
                    <td>profileURL</td>
                    <td>&nbsp; <?php echo $user_data->profileURL; ?></td>
                  </tr>
                  <tr>
                    <td>webSiteURL</td>
                    <td>&nbsp; <?php echo $user_data->webSiteURL; ?></td>
                  </tr>
                  <tr>
                    <td>photoURL</td>
                    <td>&nbsp; <?php echo $user_data->photoURL; ?></td>
                  </tr>
                  <tr>
                    <td>displayName</td>
                    <td>&nbsp; <?php echo $user_data->displayName; ?></td>
                  </tr>
                  <tr>
                    <td>description</td>
                    <td>&nbsp; <?php echo $user_data->description; ?></td>
                  </tr>
                  <tr>
                    <td>firstName</td>
                    <td>&nbsp; <?php echo $user_data->firstName; ?></td>
                  </tr>
                  <tr>
                    <td>lastName</td>
                    <td>&nbsp; <?php echo $user_data->lastName; ?></td>
                  </tr>
                  <tr>
                    <td>gender</td>
                    <td>&nbsp; <?php echo $user_data->gender; ?></td>
                  </tr>
                  <tr>
                    <td>language</td>
                    <td>&nbsp; <?php echo $user_data->language; ?></td>
                  </tr>
                  <tr>
                    <td>age</td>
                    <td>&nbsp; <?php echo $user_data->age; ?></td>
                  </tr>
                  <tr>
                    <td>birthDay</td>
                    <td>&nbsp; <?php echo $user_data->birthDay; ?></td>
                  </tr>
                  <tr>
                    <td>birthMonth</td>
                    <td>&nbsp; <?php echo $user_data->birthMonth; ?></td>
                  </tr>
                  <tr>
                    <td>birthYear</td>
                    <td>&nbsp; <?php echo $user_data->birthYear; ?></td>
                  </tr>
                  <tr>
                    <td>email</td>
                    <td>&nbsp; <?php echo $user_data->email; ?></td>
                  </tr>
                  <tr>
                    <td>phone</td>
                    <td>&nbsp; <?php echo $user_data->phone; ?></td>
                  </tr>
                  <tr>
                    <td>address</td>
                    <td>&nbsp; <?php echo $user_data->address; ?></td>
                  </tr>
                  <tr>
                    <td>country</td>
                    <td>&nbsp; <?php echo $user_data->country; ?></td>
                  </tr>
                  <tr>
                    <td>region</td>
                    <td>&nbsp; <?php echo $user_data->region; ?></td>
                  </tr>
                  <tr>
                    <td>city</td>
                    <td>&nbsp; <?php echo $user_data->city; ?></td>
                  </tr>
                  <tr>
                    <td>zip</td>
                    <td>&nbsp; <?php echo $user_data->zip; ?></td>
                  </tr>
                </tbody>
              </table></td>
          </tr>
        </table>
      </fieldset></td>
  </tr>
</table>

<br />  
<hr /> 
<strong>Note:</strong> HybridAuth still in beta! Please let us know if you have any problem using it. Email: hybridauth@gmail.com<br />

</body>
</html>