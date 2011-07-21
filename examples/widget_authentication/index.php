<?php
    # start a new PHP session
    session_start();

    # include HybridAuth main file
    include "../../hybridauth/hybridauth.php";

    # create a new Hybrid_Auth instance
    $hybridauth = new Hybrid_Auth();

	$CURRENT_URL = str_ireplace( "/index.php", "/", $hybridauth->getCurrentUrl() );
	$WIDGET_URL  = $CURRENT_URL . "login_widget/"; 

	if( isset( $_GET["logout"] ) ){
		$hybridauth->endSession(); 

		$hybridauth->redirect( $CURRENT_URL );
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
	<link media="screen" rel="stylesheet" href="<?php echo $WIDGET_URL; ?>css/colorbox.css" />
	<script src="<?php echo $WIDGET_URL; ?>js/jquery.min.js"></script>
	<script src="<?php echo $WIDGET_URL; ?>js/jquery.colorbox.js"></script>
	
	<script>
		$(document).ready(function(){
			$(".widget_link").colorbox({iframe:true, innerWidth:500, innerHeight:300});
		});
	</script>
</head>
<body>
	<center>
		<h1>A simple login Widget integration</h1>
		<br />
		<br /> 
<?php
	// if not connected, display login
	if( ! $hybridauth->hasSession() )
	{
?>
		<table width="380" border="0" cellpadding="2" cellspacing="2">
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
		  </tr>
		  <tr>
			<td valign="top" align="right">
				<img src="arrow.gif" align="texttop" style="margin-top:-5px;" >
				<a href="<?php echo $WIDGET_URL . "?ts=" . time(); ?>" class='widget_link' title="HybridAuth Social Sing-on">Or sign-in with another identity provider</a>
			</td>
		  </tr>
		</table> 
		<br /><br /><br />
		<b>Note:</b> This is a work in progress of a proof of concept! it works good enough to try out on Firefox.
<?php
	} // if not connected, display login
	
	// if connected, display profile
	if( $hybridauth->hasSession() )
	{
		$provider_adapter = $hybridauth->wakeup(); 

		$user_data = $provider_adapter->user()->profile;
?>
		<table width="600" border="0" cellpadding="2" cellspacing="2">
		  <tr>
			<td valign="top"><fieldset>
				<legend>Connected user badge</legend>
				<table width="100%" border="0" cellpadding="2" cellspacing="2">
				  <tr>
					<td rowspan="4" valign="top" align="center" width="40">
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
					</td>
					<td colspan="2" width="60"><div align="right"><strong>Provider</strong></div></td>
					<td align="left" ><?php echo $provider_adapter->user()->providerId; ?></td>
				  </tr> 
				  <tr>
					<td colspan="2"><div align="right"><strong>Dispaly name</strong></div></td>
					<td align="left"><?php echo $user_data->displayName; ?></td>
				  </tr>
				  <tr>
					<td colspan="2"><div align="right"><strong>Email</strong></div></td>
					<td align="left"><?php echo $user_data->email; ?></td>
				  </tr>
				  <tr>
					<td colspan="2" valign="top"><div align="right"><strong>Profile URL</strong></div></td>
					<td align="left" valign="top"><?php echo $user_data->profileURL; ?></td>
				  </tr>
				</table>
			  </fieldset></td>
		  </tr>
		  <tr>
			<td valign="top" align="right">
				<img src="arrow.gif" align="texttop" style="margin-top:-5px;" >
				<a href="?logout=1">Log me out</a>
			</td>
		  </tr>
		</table>   
<?php
	} // if connected, display profile
?>
	</center> 
</body>
</html>