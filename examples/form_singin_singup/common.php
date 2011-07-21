<?php
	// common function / connexion to database / etc..
	
	$database_host = "localhost";
	
	$database_host = "localhost"; 
	$database_user = "root";
	$database_pass = "";
	$database_name = "hybridauth";
	
	$database_link = mysql_connect( $database_host, $database_user, $database_pass );
	if (!$database_link) {
		// die('Could not connect: ' . mysql_error());
	}

	// make foo the current db
	$db_selected = mysql_select_db( $database_name, $database_link);

	function redirect_to( $url ){
		header( "Location: $url" ) ;
 
		die();
	}

	function find_user_by_id( $id ){
		$sql = "SELECT * FROM users WHERE id = '$id' LIMIT 1";

		$result = mysql_query_excute($sql);
 
		return mysql_fetch_assoc($result);
	}

	function find_user_by_email( $email ){
		$sql = "SELECT * FROM users WHERE email = '$email' LIMIT 1";

		$result = mysql_query_excute($sql);
 
		return mysql_fetch_assoc($result);
	}

	function find_authentication_by_email( $email ){
		$sql = "SELECT * FROM user_authentications WHERE email = '$email' LIMIT 1";

		$result = mysql_query_excute($sql);
 
		return mysql_fetch_assoc($result);
	}

	function find_authentication_by_provider_uid( $provider, $provider_uid ){
		$sql = "SELECT * FROM user_authentications WHERE provider = '$provider' AND provider_uid = '$provider_uid' LIMIT 1";

		$result = mysql_query_excute($sql);
 
		return mysql_fetch_assoc($result);
	}

	function find_user_by_email_and_passord( $email, $password ){
		$sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password' LIMIT 1";

		$result = mysql_query_excute($sql);
 
		return mysql_fetch_assoc($result);
	}
	
	function create_new_user( $email, $password, $first_name, $last_name){ 
		$sql = "INSERT INTO users  ( email, password, first_name, last_name, created_at ) VALUES ( '$email', '$password', '$first_name', '$last_name', NOW() ) ";
		
		return mysql_query_excute($sql);
	}
	
	function create_new_user_authentification( $user_id, $provider, $provider_uid, $email, $display_name, $first_name, $last_name, $profile_url, $website_url ){ 
		$sql = "INSERT INTO user_authentications ( user_id, provider, provider_uid, email, display_name, first_name, last_name, profile_url, website_url, created_at ) VALUES ( '$user_id', '$provider', '$provider_uid', '$email', '$display_name', '$first_name', '$last_name', '$profile_url', '$website_url', NOW() ) ";
		
		return mysql_query_excute($sql);
	}
	
	function update_user_profile( $user_id, $email, $password, $first_name, $last_name){ 
		$sql = "UPDATE users SET email = '$email', password = '$password', first_name = '$first_name', last_name = '$last_name' WHERE id = '$user_id' LIMIT 1";
		
		return mysql_query_excute($sql);
	}
	
	function mysql_query_excute( $sql ){ 
		$result = mysql_query($sql);

		if (!$result) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $sql;
			die($message);
		}

		return $result;
	}
