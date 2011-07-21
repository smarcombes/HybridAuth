<?php
/**
 * HybridAuth - internal test
 */

	#start a new session
	@ session_start();

	include "../../hybridauth/hybridauth.php"; 
	
	$provider = "OpenID";
	
	# create a new Hybrid_Auth instance
	$hybridauth = new Hybrid_Auth();

	# if we press login button, we start login
	if( isset( $_POST["provider_login"] ) ){ 
		$params                      = array();
		$params["openid_identifier"] = @ $_REQUEST["openid_identifier"];  
		$params["hauth_return_to"]   = $hybridauth->getCurrentUrl() ; // after authentication, return to this same page

		$provider_adapter = $hybridauth->setup( $provider, $params );

		if( $provider_adapter ){
			$provider_adapter->login();
		} 
	}

	# if we press logout button, we end current user session
	if( isset( $_POST["provider_logout"] ) ){
		$hybridauth->endSession(); 
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Test signin with <?php echo $provider; ?></title>
</head>

<body>

<h2>Test signin with <?php echo $provider; ?></h2>

<table width="100%" border="1">
  <tr>
    <td width="30%">&nbsp; Your SESSION ID </td>
    <td>&nbsp; <?php echo session_id(); ?></td>
  </tr>
  <tr>
    <td width="30%">&nbsp; Your <?php echo $provider; ?> application CONSUMER_KEY </td>
    <td>&nbsp; Not needed</td>
  </tr>
  <tr>
    <td>&nbsp; Your <?php echo $provider; ?> application CONSUMER_SECRET </td>
    <td>&nbsp; Not needed</td>
  </tr>
</table>

<?php
	// catch if error
	if( $hybridauth->hasError() ){
		echo "<h3>Ooops error</h3> " . $hybridauth->getErrorMessage(); 
		echo '<br /><br /><a href="' . strtolower( $provider ) . '.php">Please try again.</a>'; 
		$hybridauth->endSession(); 
		die();
	}

	if( $hybridauth->hasSession() ){
		$provider_adapter = $hybridauth->wakeup();
?> 
	<h3>User connected</h3>
	<form action="" method="post" >
		<input id="provider_logout" name="provider_logout" type="hidden" value="<?php echo strtolower( $provider ); ?>" />
		<div align="center"> 
			<input type="submit" style="width:250px;height:30px;" value="Logout" />
		</div>
	</form>

	<br /> 

	<hr />
	<b>User Data Object:</b><br />
	<pre><?php print_r( $provider_adapter->user() ); ?></pre> 
	
	<hr />
	<b>API Client Object:</b><br />
	<pre><?php print_r( $provider_adapter->api() ); ?></pre> 

	<hr /> 
<?php
	}

	if( ! $hybridauth->hasSession() ){
?> 
	<br /> 
	<form action="" method="post" >
		<input id="provider_login" name="provider_login" type="hidden" value="<?php echo strtolower( $provider ); ?>" />
		<div align="center">
			<input type="text" name="openid_identifier" id="openid_identifier" value="https://www.google.com/accounts/o8/id"  style="width:450px;height:23px;" />
			
			<input type="submit" style="width:250px;height:30px;" value="Sign in with <?php echo $provider; ?>" /> 
		</div>
	</form>
	
	<br /><br />
	<hr />
	<b>OpenID Providers URL samples :</b><br /><br />
- AOL - openid.aol.com/screenname<br />
- Blogger - blogname.blogspot.com<br />
- Flickr - www.flickr.com/photos/username<br />
- LiveDoor profile.livedoor.com/username<br />
- LiveJournal - username.livejournal.com<br />
- Orange (France Telecom) - http://openid.orange.fr<br />
- SmugMug - username.smugmug.com<br />
- Technorati technorati.com/people/technorati/username<br />
- Vox - member.vox.com<br />
- Yahoo - http://openid.yahoo.com (Every Yahoo ID is now an OpenID 2.0 ID)<br />
- Wikitravel provides an identifier to each registered user<br />
- WordPress.com - username.wordpress.com<br />
<?php
	}
?>

</body>
</html>