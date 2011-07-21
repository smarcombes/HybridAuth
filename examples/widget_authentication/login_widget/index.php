<?php
    # start a new PHP session
    session_start();
    
    # include HybridAuth main file
    include "../../../hybridauth/hybridauth.php";

    # create a new Hybrid_Auth instance
    $hybridauth = new Hybrid_Auth();

	$WIDGET_URL = $hybridauth->getCurrentUrl() ;

    # create a new Hybrid_Auth instance
    $hybridauth = new Hybrid_Auth();

	// if user already connected, redirect to profile page
	if( $hybridauth->hasSession() )
	{ 
?>
<script language="javascript"> 
	if(  window.opener ){
		window.opener.parent.location.reload( true );  
	}

	if(  window.parent && window.parent.$ ){ 
		window.parent.$.colorbox.close(); 
	}

	window.self.close();  
</script>
<?php
		die();
	}

	// catch if error
	if( $hybridauth->hasError() )
	{
		echo $hybridauth->getErrorMessage();
		$hybridauth->expireStorage(); 
		die( "login_error.php1" );
	}

	// if a provider has been selected
	if( isset( $_GET["provider"] )  )
	{
		$provider                       = @ $_REQUEST["provider"];       // selected provider name 

		$params                         = array(); 

		// URL of your application which will be called after authentication 
		$params["hauth_return_to"]      = $hybridauth->getCurrentUrl() ; // after authentication, return to this same page
		
		if( $provider == "OpenID" ){
			$params["openid_identifier"]    = @ $_REQUEST["openid_identifier"];
		}

		// setup a new connection// setup a new connection
		$provider_adapter = $hybridauth->setup( $provider, $params );

		// catch if setup error
		if( ! $provider_adapter )
		{
			echo $hybridauth->getErrorMessage();
			$hybridauth->expireStorage(); 
			die( "login_error.php2" );
		}

		// start login
		$login_is_ok = $provider_adapter->login();

		// catch if login error
		if( ! $login_is_ok )
		{
			echo $hybridauth->getErrorMessage();
			$hybridauth->expireStorage(); 
			die( "login_error.php3" );
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
    <title>HybridAuth Social Sing-on</title>
    <link rel="stylesheet" type="text/css" media="screen" href="css/openid.css" /> 
</head>
<body>
 
<form class="openid" method="post" action="">
<div>
<table><tr><td>
<ul class="providers">
			<li class="openid" title="OpenID"><img src="images/openidB.png" alt="icon" /> <span>http://<strong>{your-openid-url}</strong></span></li>
			<li class="direct" title="Google"><img src="images/googleB.png" alt="icon" /></li>
			<li class="direct" title="Yahoo"><img src="images/yahooB.png" alt="icon" /></li>
</ul>
</td>
</tr>
<td>
<ul class="providers">
			<li class="direct" title="Facebook"><img src="images/facebookB.png" alt="icon" /></li>
			<li class="direct" title="MySpace"><img src="images/myspaceB.png" alt="icon" /></li>
			<li class="direct" title="Twitter"><img src="images/twitterB.png" alt="icon" /></li>
</ul>
</td>
</tr>
<td><ul class="providers">
			<li class="direct" title="LinkedIn"><img src="images/linkedinB.png" alt="icon" /></li>
			<li class="direct" title="Foursquare"><img src="images/foursquareB.png" alt="icon" /></li>
			<li class="direct" title="Friendster"><img src="images/friendsterB.png" alt="icon" /></li>
</ul>
</td>
</tr>
<td><ul class="providers">
			<li class="direct" title="Vimeo"><img src="images/vimeoB.png" alt="icon" /></li>
			<li class="username" title="AOL screen name"> <img src="images/aolB.png" alt="icon" /><span>http://openid.aol.com/<strong>username</strong></span></li>
			<li class="username" title="Flickr user name"><img src="images/flickerB.png" alt="icon" /><span>http://flickr.com/<strong>username</strong>/</span></li>
</ul>
</td>
</tr>
<td><ul class="providers">
			<li class="username" title="Technorati user name"> <img src="images/technorati.png" alt="icon" /><span>http://technorati.com/people/technorati/<strong>username</strong>/</span></li>
			<li class="username" title="Wordpress blog name"> <img src="images/wordpress.png" alt="icon" /><span>http://<strong>username</strong>.wordpress.com</span></li>
			<li class="username" title="Blogger blog name"> <img src="images/blogger.png" alt="icon" /><span>http://<strong>username</strong>.blogspot.com/</span></li>
			<li class="username" title="LiveJournal blog name"> <img src="images/livejournal.png" alt="icon" /><span>http://<strong>username</strong>.livejournal.com</span></li>
</ul>

</td>
</tr>
</table></div>
 
  <fieldset> 
  <label for="openid_username">Enter your <span>Provider user name</span></label> 
  <div><span></span><input type="text" name="openid_username" /><span></span> 
  <input type="submit" value="Login" /></div> 
  </fieldset> 
  <fieldset> 
  <label for="openid_identifier">Enter your <a class="openid_logo" href="http://openid.net">OpenID</a></label> 
  <div><input type="text" name="openid_identifier" /> 
  <input type="submit" value="Login" /></div> 
  </fieldset> 
</form>

<script type="text/javascript">
	WIDGET_URL = '<?php echo $WIDGET_URL; ?>'; 
</script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.widget.js"></script> 
<script type="text/javascript"> 
	$(function() { 
		$("form.openid:eq(0)").openid(); 
	});
</script>

</body>
</html>
