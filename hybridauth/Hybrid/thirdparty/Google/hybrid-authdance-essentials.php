<?php
/* Copyright (c) 2009 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * Author: Eric Bidelman <e.bidelman>
 * Repackaged by: Séverin MARCOMBES <severin.marcombes>
*/

/**
 * Upgrades an OAuth request token to an access token.
 *
 * @param string $request_token_str An authorized OAuth request token
 * @return string The access token
 */

// OAuth/OpenID libraries and utility functions.
require_once 'common.inc.php';

/***********************************************************
 *     How to get $consumer and $sig_method variables      *
 ***********************************************************
 $CONSUMER_KEY = 'YOUR_CONSUMER_KEY';
 $CONSUMER_SECRET = 'YOUR_CONSUMER_SECRET';
 $consumer = new OAuthConsumer($CONSUMER_KEY, $CONSUMER_SECRET);

 $sig_method = $SIG_METHODS['HMAC-SHA1'];
 ***********************************************************/
 
function getAccessToken($consumer, $sig_method, $request_token_str)
{
  $access_token = "";
  
  $token = new OAuthToken($request_token_str, NULL);

  $token_endpoint = 'https://www.google.com/accounts/OAuthGetAccessToken';
  $request = OAuthRequest::from_consumer_and_token($consumer, $token, 'GET',
                                                   $token_endpoint);
  $request->sign_request($sig_method, $consumer, $token);

  $response = send_signed_request($request->get_normalized_http_method(),
                                  $token_endpoint, $request->to_header(), NULL,
                                  false);

  // Parse out oauth_token (access token) and oauth_token_secret
  preg_match('/oauth_token=(.*)&oauth_token_secret=(.*)/', $response, $matches);
  
  if(count($matches) >= 2)
  {
    $access_token = new OAuthToken(urldecode($matches[1]),
                                 urldecode($matches[2]));
  }

  return $access_token;
}

?>
