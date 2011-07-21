<?php
    # start a new PHP session
    session_start();

	# include common file
    include "common.php";                      

	# there is nothing to do in index page => redirect to login
	redirect_to( "login.php" );
