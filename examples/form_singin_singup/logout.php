<?php
    # start a new PHP session
    session_start();

    include "common.php";                      # include common file
	include "../../hybridauth/hybridauth.php"; # include HybridAuth main file
 
    # create a new Hybrid_Auth instance
    $hybridauth = new Hybrid_Auth();

	# 1 - first, we end the user session on Hybrid_Auth
	$hybridauth->endSession(); 

	# 2 - then, destroy the session.
	$_SESSION = array();
	session_destroy();

	# 3 - Finally, redirect the user to login page
	redirect_to( "login.php" );
