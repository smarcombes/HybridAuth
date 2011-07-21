<style type="text/css">
#content {
    background: none repeat scroll 0 0 #FFFFFF; 
    margin: 0 0 0 10px;
    padding: 0;
}
.inputgnrc, select {
    font-size: 15px;
    padding: 6px 3px; 
    border: 1px solid #CCCCCC;
    border-radius: 4px 4px 4px 4px;
    color: #444444;
    font-family: arial;
    font-size: 16px;
    margin: 0;
    padding: 3px;
    width: 300px;
} 
.inputsave {
    font-size: 15px;
    padding: 6px 3px;  
    color: #444444;
    font-family: arial;
    font-size: 18px;
    margin: 0;
    padding: 3px;
    width: 400px;
	height: 40px;
} 
ul {
    list-style: none outside none; 
}
.cgfparams ul {
    padding: 0;
	margin: 0;
}
ul li {
    color: #555555;
    font-size: 12px;
    margin-bottom: 10px;
    padding: 0;
}
ul li label {
    color: #000000;
    display: block;
    font-size: 14px;
    font-weight: bold;
	padding-bottom: 5px;
}
.cfg { 
	background: #f5f5f5;
	float: left;
	border-radius: 2px 2px 2px 2px;
	border: 1px solid #AAAAAA;
	margin: 0 0 0 30px;
}
.cgfparams {
   padding: 20px;
   float: left;
}
.cgftip {
   border-left: 1px solid #aaa;
   margin-left: 340px;
   padding: 20px;
   min-height: 202px; 
   width: 770px;
   width: 600px;
   
   padding-top: 1px;
} 
</style> 
<?php
	$HYBRIDAUTH_VERSION             = "1.1.1 beta";

	$CONFIG_TEMPLATE                = "";

	$GLOBAL_HYBRID_AUTH_URL_BASE    = "http" . ((!empty($_SERVER['HTTPS'])) ? "s" : "") . "://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	$GLOBAL_HYBRID_AUTH_URL_BASE    = str_ireplace( "index.php", "", $GLOBAL_HYBRID_AUTH_URL_BASE);
	$GLOBAL_HYBRID_AUTH_URL_BASE    = str_ireplace( "?", "", $GLOBAL_HYBRID_AUTH_URL_BASE);
	$GLOBAL_HYBRID_AUTH_URL_BASE    = str_ireplace( "/install/", "/hybridauth/", $GLOBAL_HYBRID_AUTH_URL_BASE);

	$GLOBAL_HYBRID_AUTH_PATH_BASE   = realpath( dirname( __FILE__ ) ) . DIRECTORY_SEPARATOR;
	$GLOBAL_HYBRID_AUTH_PATH_BASE   = str_ireplace( DIRECTORY_SEPARATOR . "install" . DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR . "hybridauth" . DIRECTORY_SEPARATOR, $GLOBAL_HYBRID_AUTH_PATH_BASE);
	
	$CONFIG_FILE_NAME               = $GLOBAL_HYBRID_AUTH_PATH_BASE . "hybridauth.php";

	$GLOBAL_HYBRID_AUTH_TEMP_FOLDER = $GLOBAL_HYBRID_AUTH_PATH_BASE . "temp" . DIRECTORY_SEPARATOR;

	$PROVIDERS_CONFIG      = ARRAY( 
								ARRAY( 
									"label"             => "OpenID",
									"new_app_link"      => NULL,
									"userguide_section" => "http://hybridauth.sourceforge.net/userguide/IDProvider_info_OpenID.html",
								) 
								,
								ARRAY( 
									"label"             => "Twitter",
									"callback"          => TRUE,
									"new_app_link"      => "https://dev.twitter.com/apps",
									"userguide_section" => "http://hybridauth.sourceforge.net/userguide/IDProvider_info_Twitter.html",
								)
								,
								ARRAY( 
									"label"             => "Facebook",
									"new_app_link"      => "https://www.facebook.com/developers/apps.php",
									"userguide_section" => "http://hybridauth.sourceforge.net/userguide/IDProvider_info_Facebook.html",
								)
								,
								ARRAY( 
									"label"             => "Google",
									"new_app_link"      => "https://www.google.com/accounts/ManageDomains",
									"userguide_section" => "http://hybridauth.sourceforge.net/userguide/IDProvider_info_Google.html",
								) 
								,
								ARRAY( 
									"label"             => "Yahoo",
									"new_app_link"      => NULL,
									"userguide_section" => "http://hybridauth.sourceforge.net/userguide/IDProvider_info_Yahoo.html",
								) 
								,
								ARRAY( 
									"label"             => "LinkedIn",
									"callback"          => TRUE,
									"new_app_link"      => "https://www.linkedin.com/secure/developer?newapp=",
									"userguide_section" => "http://hybridauth.sourceforge.net/userguide/IDProvider_info_LinkedIn.html",
								)
								,
								ARRAY( 
									"label"             => "Foursquare",
									"callback"          => TRUE,
									"new_app_link"      => "https://www.foursquare.com/oauth/",
									"userguide_section" => "http://hybridauth.sourceforge.net/userguide/IDProvider_info_Foursquare.html",
								)
								,
								ARRAY( 
									"label"             => "Gowalla",
									"callback"          => TRUE,
									"new_app_link"      => "http://gowalla.com/api/keys",
									"userguide_section" => "http://hybridauth.sourceforge.net/userguide/IDProvider_info_Gowalla.html",
								)
								,
								ARRAY( 
									"label"             => "MySpace",
									"new_app_link"      => "http://www.developer.myspace.com/",
									"userguide_section" => "http://hybridauth.sourceforge.net/userguide/IDProvider_info_MySpace.html",
								) 
								,
								ARRAY( 
									"label"             => "Live",
									"new_app_link"      => "https://manage.dev.live.com/ApplicationOverview.aspx",
									"userguide_section" => "http://hybridauth.sourceforge.net/userguide/IDProvider_info_Live.html",
								) 
								,
								ARRAY( 
									"label"             => "Friendster",
									"callback"          => TRUE,
									"new_app_link"      => "http://www.friendster.com/developer",
									"userguide_section" => "http://hybridauth.sourceforge.net/userguide/IDProvider_info_Friendster.html",
								) 
								,
								ARRAY( 
									"label"             => "Vimeo",
									"callback"          => TRUE,
									"new_app_link"      => "http://www.vimeo.com/api/applications",
									"userguide_section" => "http://hybridauth.sourceforge.net/userguide/IDProvider_info_Vimeo.html",
								) 
								,
								ARRAY( 
									"label"             => "Tumblr",
									"callback"          => TRUE,
									"new_app_link"      => "http://www.tumblr.com/oauth/apps",
									"userguide_section" => "http://hybridauth.sourceforge.net/userguide/IDProvider_info_Tumblr.html",
								) 
								,
								ARRAY( 
									"label"             => "PayPal",
									"new_app_link"      => "https://www.x.com/create-appvetting-app!input.jsp",
									"userguide_section" => "http://hybridauth.sourceforge.net/userguide/IDProvider_info_PayPal.html",
								) 
							);

	if( count( $_POST ) ):
		$CONFIG_TEMPLATE = file_get_contents( "hybridauth.php.txt" );

		if( isset( $_POST["GLOBAL_HYBRID_AUTH_PATH_BASE"] ) && DIRECTORY_SEPARATOR == "\\" ):
			$_POST["GLOBAL_HYBRID_AUTH_PATH_BASE"]   = str_replace( "\\", "/", $_POST["GLOBAL_HYBRID_AUTH_PATH_BASE"] ); 
		endif;

		if( isset( $_POST["GLOBAL_HYBRID_AUTH_TEMP_FOLDER"] ) && DIRECTORY_SEPARATOR == "\\" ): 
			$_POST["GLOBAL_HYBRID_AUTH_TEMP_FOLDER"] = str_replace( "\\", "/", $_POST["GLOBAL_HYBRID_AUTH_TEMP_FOLDER"] );
		endif;

		foreach( $_POST AS $k => $v ):
			$v = strip_tags( $v );
			$z = "#$k#";
			
			$CONFIG_TEMPLATE = str_replace( $z, $v, $CONFIG_TEMPLATE );
		endforeach;
 
		$CONFIG_TEMPLATE = str_replace( "<?php", "<?php\n\t#AUTOGENERATED BY HYBRIDAUTH $HYBRIDAUTH_VERSION INSTALLER - " . date("l jS \of F Y h:i:s A") . "\n", $CONFIG_TEMPLATE );
 
		$is_installed = file_put_contents( $GLOBAL_HYBRID_AUTH_PATH_BASE . "hybridauth.php",  $CONFIG_TEMPLATE );

		// echo "<pre>";echo htmlentities( $CONFIG_TEMPLATE );
		
			if( ! $is_installed ):
	?>
		<p style='background-color:#EE3322;color:#FFFFFF;margin:1em 0;padding:0.8em;border:1px #C52F24 solid;'><strong>Installation Error: </strong> HybridAuth configuration file <span style='color:#000000;font-weight:normal;'><?php echo $CONFIG_FILE_NAME; ?></span> must be <b >WRITABLE</b> in order for the installer to work.</p>
		<br />
		Please try again!
	<?php
			else:
	?>
		<center>
		<table width="90%" border="0">
		<tr>
		<td align="left"> 
		<div id="content">
			<p style='background-color:#390;color:#FFFFFF;margin:1em 0;padding:0.8em;border:1px #030 solid;'><strong>Installation completed: </strong> HybridAuth has been successfully installed on your web server.</p>

			<h1 style="margin-bottom: 15px;">HybridAuth <?php echo $HYBRIDAUTH_VERSION; ?> Install</h1> 
			<hr />
			<br /> 
			<ul style="list-style:disc inside;">
				<li style="color: #000000;font-size: 18px;">For security reason, please delete this folder ("install") and all the files inside of it.</li>
				<li style="color: #000000;font-size: 18px;">Set <b><?php echo $GLOBAL_HYBRID_AUTH_URL_BASE; ?>index.php</b> it to +rx mode (read and execute permissions).</li>
				<li style="color: #000000;font-size: 18px;">Set hybridauth temporary forder <b><?php echo $GLOBAL_HYBRID_AUTH_TEMP_FOLDER; ?></b> as <b style="color: green;">WRITABLE</b>.</li>
				<li style="color: #000000;font-size: 18px;">Visit <a href="<?php echo str_replace( "/hybridauth/", "/examples/", $GLOBAL_HYBRID_AUTH_URL_BASE ); ?>"><?php echo str_replace( "/hybridauth/", "/examples/", $GLOBAL_HYBRID_AUTH_URL_BASE ); ?></a> to try some working demos .</li> 
				<li style="color: #000000;font-size: 18px;">Check out the complete HybridAuth documentation at <a href="http://hybridauth.sourceforge.net/">http://hybridauth.sourceforge.net</a>.</li>
			</ul> 
			<br /> 			
			<b style="margin-left: 20px;font-size: 20px;">And that is it!</b>  
			<br /><br /><br /><br /><br /><br /><br /><br /><br />
			<hr /> 
			<strong>Note:</strong> HybridAuth still in beta! Please let us know if you have any problem using it. Email: hybridauth@gmail.com<br />
		<div>
		</td>
		</tr>
		</table> 
		</div>
		
	<?php
			endif;
		die();
	endif;
?>
<center>
<table width="90%" border="0">
<tr>
<td align="left">

<div id="content">

	<?php
		if( ! is_writable( $CONFIG_FILE_NAME ) ):
	?>
		<p style='background-color:#EE3322;color:#FFFFFF;margin:1em 0;padding:0.8em;border:1px #C52F24 solid;'><strong>Error: </strong> HybridAuth configuration file <span style='color:#000000;font-weight:normal;'><?php echo $CONFIG_FILE_NAME; ?></span> must be <b >WRITABLE</b> in order for the installer to work.</p>
	<?php
		endif;
	?> 

	<?php
		if( $_SERVER["SERVER_NAME"] == "localhost" || $_SERVER["SERVER_NAME"] == "127.0.0.1" ):
	?>
		<p style='background-color:#F90;color:#FFFFFF;margin:1em 0;padding:0.8em;border:1px #F00 solid;'><strong>Please note: </strong> HybridAuth will not work properly in localhost, because the majority of social networks and identities providers DO NOT TRUST http://localhost/ requests</p>
	<?php
		endif;
	?> 

<form method="post"> 
	<h1 style="margin-bottom: 15px;">HybridAuth <?php echo $HYBRIDAUTH_VERSION; ?> Install</h1> 
	<hr />
	
	<b style="margin-left: 20px;">Imporant notices:</b>  

	<ul style="list-style:disc inside;">
		<li style="color: #000000;font-size: 14px;">For security reason, please delete this folder ("install") and all the files inside of it as soon as you complete the installation process,</li>
		<li style="color: #000000;font-size: 14px;">Using the HybridAuth installer will erase your the existen configuration file. If you already have an old installation of HybridAuth you might keep a copy of hybridauth/hybridauth.php file for safety,</li>
		<li style="color: #000000;font-size: 14px;">HybridAuth will not work properly in localhost, because the majority of social networks and identities providers DO NOT TRUST localhost requests,</li>
		<li style="color: #000000;font-size: 14px;">HybridAuth still in beta! Please let us know if you have any problem using it. Email: hybridauth@gmail.com,</li>
		<li style="color: #000000;font-size: 14px;">Visit <a href="http://hybridauth.sourceforge.net/">HybridAuth</a> Home page to make sure if there is any newer version.</li>
	</ul> 
	
	<h2>General settings</h2> 

	<ul style="list-style:circle inside;">
		<li style="color: #000000;font-size: 14px;">HybridAuth install will try to auto detect the base path and URL on your server. Unless you want to change thoses settings for something else you should keep them as is generated.</li> 
		<li style="color: #000000;font-size: 14px;">HybridAuth base URL must end with an <b style="color:red">"/"</b> and PATHs must end with an <b style="color:red">"<?php echo DIRECTORY_SEPARATOR; ?>"</b> (depending on your server if you are runnning windows or linux).</li>
		<li style="color: #000000;font-size: 14px;">On production you might keep the Debug mode to <b style="color:red">Disabled</b>.</li>
	</ul>

	<div> 
		<div class="cfg">
		   <div class="cgfparams">
			  <ul>
				<li><label>HybridAuth base URL</label><input type="text" class="inputgnrc" value="<?php echo $GLOBAL_HYBRID_AUTH_URL_BASE; ?>" name="GLOBAL_HYBRID_AUTH_URL_BASE" style="min-width:600px;"></li>
			  </ul> 
		   </div> 
		   <div class="cgftip" style="margin-left: 646px;padding: 20px;min-height: 60px;width: 300px;">
				Set the complete url to hybridauth library on your website.  
				This URL will be used for many providers as the <a href="http://hybridauth.sourceforge.net/userguide/HybridAuth_endpoint_URL.html" target="_blank">Endpoint</a> for your website. 

				<br /><br />
				eg.
				The required callback URL for Twitter will be: <span style="color:green"><?php echo $GLOBAL_HYBRID_AUTH_URL_BASE; ?>?hauth.done=Twitter</span>

		   </div>
		</div>   
	</div> 
	<br style="clear:both;"/> 
	<br />

	<div> 
		<div class="cfg">
		   <div class="cgfparams">
			  <ul>
				<li><label>HybridAuth real path</label><input type="text" class="inputgnrc" value="<?php echo $GLOBAL_HYBRID_AUTH_PATH_BASE; ?>" name="GLOBAL_HYBRID_AUTH_PATH_BASE" style="min-width:600px;" disabled="disabled"></li>
			  </ul> 
		   </div> 
		   <div class="cgftip" style="margin-left: 646px;padding: 20px;min-height: 60px;width: 300px;">
				Set the real path to hybridauth library on your server.
		   </div>
		</div>   
	</div> 
	<br style="clear:both;"/> 
	<br />

	<div> 
		<div class="cfg">
		   <div class="cgfparams">
			  <ul>
				<li><label>HybridAuth temporary forder</label><input type="text" class="inputgnrc" value="<?php echo $GLOBAL_HYBRID_AUTH_TEMP_FOLDER; ?>" name="GLOBAL_HYBRID_AUTH_TEMP_FOLDER" style="min-width:600px;" disabled="disabled"></li>
			  </ul>
		   </div> 
		   <div class="cgftip" style="margin-left: 646px;padding: 20px;min-height: 60px;width: 300px;">
				Set the temporary forder of hybridauth library on your server and make sur it's <b style="color: green;">RECURSIVELY WRITABLE</b>.
		   </div>
		</div>   
	</div> 
	<br style="clear:both;"/> 
	<br />

	<div> 
		<div class="cfg">
		   <div class="cgfparams">
			  <ul>
				<li><label>Debug mode</label>
					<select name="GLOBAL_HYBRID_AUTH_DEBUG_MODE" style="min-width:600px;">
					<option value="TRUE">Enabled</option>
					<option selected="selected" value="FALSE">Disabled</option>
					</select>
				</li>
			  </ul> 
		   </div> 
		   <div class="cgftip" style="margin-left: 646px;padding: 20px;min-height: 60px;width: 300px;">
				Disable or enable logging. If enabled, the log file will be stored on <?php echo DIRECTORY_SEPARATOR; ?>temp<?php echo DIRECTORY_SEPARATOR; ?><b>log.log</b>
		   </div>
		</div>   
	</div> 
	<br style="clear:both;"/> 
	<br />

	<h2>Providers setup</h2> 

	<ul style="list-style:circle inside;">
		<li style="color: #000000;font-size: 14px;">To correctly setup these Identity Providers please carefully follow the help section of each one.</li>
		<li style="color: #000000;font-size: 14px;">If <b>Provider Adapter Satus</b> is set to <b style="color:red">Disabled</b> then users will not be able to login with this provider on you website.</li>
		<li style="color: #000000;font-size: 14px;">For the Identity Providers you don't want to use on you website you might keep set to <b style="color:red">Disabled</b>.</li>
	</ul>

<?php
	$nb_provider = 0;
	
	foreach( $PROVIDERS_CONFIG AS $item ):
		$provider                   = @ $item["label"];
		$provider_new_app_link      = @ $item["new_app_link"];
		$provider_userguide_section = @ $item["userguide_section"];
		$provider_callback_url      = "" ;

		if( isset( $item["callback"] ) && $item["callback"] ){
			if( $provider != "Gowalla" ){
				$provider_callback_url  = '<span style="color:green">' . $GLOBAL_HYBRID_AUTH_URL_BASE . '?hauth.done=' . $provider . '</span>';
			}
			else{
				$provider_callback_url  = '<span style="color:green">' . $GLOBAL_HYBRID_AUTH_URL_BASE . '?hauth.done=' . $provider . '&</span>';
			}
		}

		$nb_provider                ++;
?>
	<h4 style="margin-left:10px;"><?php echo $nb_provider ?> - <?php echo $provider ?></h4> 
	<div> 
		<div class="cfg">
		   <div class="cgfparams">
			  <ul>
				 <li><label><?php echo $provider ?> Adapter Satus</label>
					<select name="<?php echo strtoupper( $provider ) ?>_ADAPTER_STATUS">
					<option selected="selected" value="TRUE">Enabled</option>
					<option value="FALSE">Disabled</option>
					</select>
				</li>
				<?php if ( $provider_new_app_link && $provider != "PayPal" ) : ?>
					<?php if ( $provider == "Facebook" ) : ?>
						<li><label>Application ID</label><input type="text"    class="inputgnrc" value="" name="<?php echo strtoupper( $provider ) ?>_APPLICATION_APP_ID"    ></li>
					<?php else: ?>	
						<li><label>Application Key</label><input type="text"    class="inputgnrc" value="" name="<?php echo strtoupper( $provider ) ?>_APPLICATION_KEY"    ></li>
					<?php endif; ?>	

					<li><label>Application Secret</label><input type="text" class="inputgnrc" value="" name="<?php echo strtoupper( $provider ) ?>_APPLICATION_SECRET" ></li>
				<?php endif; ?>
			  </ul> 
		   </div>
		   <div class="cgftip">
				<?php if ( $provider == "PayPal" ) : ?>
					<p>In order to set up <?php echo $provider ?>, you must register your website for whitelisting at <a href="<?php echo $provider_new_app_link ?>" target ="_blanck"><?php echo $provider_new_app_link ?></a></p> 
				<?php elseif ( $provider_new_app_link ) : ?>
					<p>In order to set up <?php echo $provider ?>, you must register your website with <?php echo $provider ?> at <a href="<?php echo $provider_new_app_link ?>" target ="_blanck"><?php echo $provider_new_app_link ?></a></p>

					<?php if ( $provider_callback_url ) : ?>
						<p>Provide <?php echo $provider_callback_url ?> as the Callback URL for your application.</p>
					<?php endif; ?> 

					<?php if ( $provider == "Google" ) : ?>
						<p>Make sure to put your correct website adress in the "Target URL path prefix" field. This adresse must match with the current hostname "<em><?php echo $_SERVER["SERVER_NAME"] ?></em>".</p>
					<?php endif; ?> 

					<?php if ( $provider == "MySpace" ) : ?>
						<p>Make sure to put your correct website adress in the "External Url" and "External Callback Validation" fields. This adresse must match with the current hostname "<em><?php echo $_SERVER["SERVER_NAME"] ?></em>".</p>
					<?php endif; ?> 

					<?php if ( $provider == "Live" ) : ?>
						<p>Make sure to put your correct website adress in the "Redirect Domain" field. This adresse must match with the current hostname "<em><?php echo $_SERVER["SERVER_NAME"] ?></em>".</p>
					<?php endif; ?> 
 
					<?php if ( $provider == "Facebook" ) : ?>
						<p>Make sure to put your correct website adress in the "Site Url" field. This adresse must match with the current hostname "<em><?php echo $_SERVER["SERVER_NAME"] ?></em>".</p>
						<p>Once you have registered, you must copy the APP ID and Secret into this setup page or set them manually on the <a href="http://hybridauth.sourceforge.net/userguide/Supported_identity_providers_and_setup_keys.html#SETUP_API_KEYS" target ="_blanck">configuration file</a>.</p> 
					<?php else: ?>	
						<p>Once you have registered, you must copy the Key and Secret into this setup page or set them manually on the <a href="http://hybridauth.sourceforge.net/userguide/Supported_identity_providers_and_setup_keys.html#SETUP_API_KEYS" target ="_blanck">configuration file</a>.</p> 
					<?php endif; ?>
				<?php else: ?>
					<p>There is no registration required for <?php echo $provider ?>.</p> 
				<?php endif; ?>

				For more informations check out <a href="<?php echo $provider_userguide_section ?>" target ="_blanck"><?php echo $provider ?></a> section on the online userguide. 
		   </div>
		</div>   
	</div> 
	<br style="clear:both;"/> 
	<br />
<?php
	endforeach;
?>
	<br /> 
	<div style="text-align:center">
		Thanks for scrolling so far down! now click the big button to complete the installation.
		<br />
		<br />
		<input type="submit" class="inputsave" value="Setup HybridAuth" /> 
	</div> 
</div>
</form>

<br />
<br />
<hr /> 
<strong>Note:</strong> HybridAuth still in beta! Please let us know if you have any problem using it. Email: hybridauth@gmail.com<br />

</td>
</tr>
</table>

</div>