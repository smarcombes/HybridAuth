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

	// if user is connected 
	if( $hybridauth->hasSession() )
	{
		$provider_adapter = $hybridauth->wakeup(); 

		$provider_adapter->logout();
	}

	// then 
	$hybridauth->expireStorage(); 

	$hybridauth->redirect( "login.php" );
