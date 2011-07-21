<?php
    # start a new PHP session
    session_start();

    # include common file 
	include "common.php";                     
    
	# check if the used is already connected, we redirect him to his profile page
	if( isset( $_SESSION["user_connected"] ) && $_SESSION["user_connected"] == 1 ){
		redirect_to( "profile.php" );
	}

    # include HybridAuth main file
    include "../../hybridauth/hybridauth.php";

    # create a new Hybrid_Auth instance
    $hybridauth = new Hybrid_Auth();

	// catch if error
	if( $hybridauth->hasError() )
	{
		redirect_to( "hybridauth_login_error.php" );
	}

	// if user has connected to a provider 
	if( $hybridauth->hasSession() )
	{
		$provider_adapter = $hybridauth->wakeup(); 

	# 1 - if authentication exist, then we login
		# check if this email is already in use in authentications table to get the associated user
		$hybridauth_provider     = $provider_adapter->user()->providerId;
		$hybridauth_provider_uid = $provider_adapter->user()->providerUID;
		$user_authentication = find_authentication_by_provider_uid( $hybridauth_provider, $hybridauth_provider_uid );

		# if authentication exist in our database we get the associeted user, we set him as connected
		if( $user_authentication  ) {
			$user_data = find_user_by_id ( $user_authentication["user_id"] );
			
			$_SESSION["user_connected"] = 1;
			$_SESSION["user_id"]        = $user_data["id"];
			$_SESSION["user_email"]     = $user_data["email"];

			# and we are good to go
			redirect_to( "profile.php" );
		}

	# 2 - if authentication does not exist but the returned email by the provider exist in our database, 
	# then we tell him the email is already in use 
		// remember, for our example the email is UNIQUE for each user
		// but, its up to you if you want to associate the authentification with the user having the adresse email in the database

		$hybridauth_email      = $provider_adapter->user()->profile->email;

		if( $hybridauth_email ){
			$user_data = find_user_by_email( $hybridauth_email );

			if( $user_data ) {
				die( '<br /><b style="color:red">Well! the email returned by the provider already exist in our database, so in this case you might use the <a href="login.php">Sign-in</a> to login</b>' );
			}
		}

	# 3 - if authentication does not exist and email not in use, then we create a new user
		$hybridauth_provider      = $provider_adapter->user()->providerId;
		$hybridauth_provider_uid  = $provider_adapter->user()->providerUID;
		$hybridauth_email         = $provider_adapter->user()->profile->email;
		$hybridauth_first_name    = $provider_adapter->user()->profile->firstName;
		$hybridauth_last_name     = $provider_adapter->user()->profile->lastName;
		$hybridauth_display_name  = $provider_adapter->user()->profile->displayName;
		$hybridauth_website_url   = $provider_adapter->user()->profile->webSiteURL;
		$hybridauth_profile_url   = $provider_adapter->user()->profile->profileURL;
		$password                 = rand( ) ; # for the password we generate something random

		$is_ok = create_new_user( $hybridauth_email, $password, $hybridauth_first_name, $hybridauth_last_name );
		$new_user_id = mysql_insert_id();

		# if user created then we create an authentification for him
		if(  ! $is_ok || ! $new_user_id ) {
			die( '<br /><b style="color:red">look like something bad happen with create_new_user( $hybridauth_email, $password, $hybridauth_first_name, $hybridauth_last_name )! Please <a href="login.php">Sign-in</a>try again</b></b>' );
		}

		$is_ok = create_new_user_authentification( $new_user_id, $hybridauth_provider, $hybridauth_provider_uid, $hybridauth_email, $hybridauth_display_name, $hybridauth_first_name, $hybridauth_last_name, $hybridauth_profile_url, $hybridauth_website_url );

		if(  ! $is_ok ) {
			die( '<br /><b style="color:red">look like something bad happen with create_new_user_authentification( $new_user_id, $hybridauth_email, $hybridauth_first_name, $hybridauth_last_name, $hybridauth_display_name, $hybridauth_website_url, $hybridauth_profile_url )! Please <a href="login.php">Sign-in</a>try again</b></b>' );
		}
		else{
			$_SESSION["user_connected"] = 1;
			$_SESSION["user_id"]        = $new_user_id;
			$_SESSION["user_email"]     = $hybridauth_email;

			# and we are good to go
			redirect_to( "profile.php" );
		} 
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
			redirect_to( "hybridauth_login_error.php" );
		}

		// start login
		$login_is_ok = $provider_adapter->login();

		// catch if login error
		if( ! $login_is_ok )
		{
			redirect_to( "hybridauth_login_error.php" );
		}
	}
