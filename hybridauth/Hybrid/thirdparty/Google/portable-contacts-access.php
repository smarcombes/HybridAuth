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

//Fetches the data at https://www-opensocial.googleusercontent.com/api/people/$dataEndpoint, using given access authorization
function getPortableContactsData($consumer, $sig_method, $access_token, $dataEndpoint, $parameters = NULL)
{
  $feedUri = "http://www-opensocial.googleusercontent.com/api/people/".$dataEndpoint;
  $req = OAuthRequest::from_consumer_and_token($consumer, $access_token, 'GET',
                                               $feedUri, $parameters);
  $req->sign_request($sig_method, $consumer, $access_token);

  // Portable Contacts isn't GData, but we can use send_signed_request() from
  // common.inc.php to make an authenticated request.
  $data = send_signed_request($req->get_normalized_http_method(),
  $feedUri.(($parameters != NULL)?("?".http_build_query($parameters)):""), $req->to_header(), NULL, false);

  return $data;
}


?>
