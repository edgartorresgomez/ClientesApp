<?php

// Google APIs Client Library for PHP
// https://code.google.com/p/google-api-php-client/

require 'class/google/apiClient.php';

session_start();

$client = new apiClient();
$client->setApplicationName("app");
$client->setScopes(array('https://www.googleapis.com/auth/contacts.readonly'));

if (isset($_REQUEST['logout'])) unset($_SESSION['google_user']);

if (isset($_GET['code'])){
	$client->authenticate();
	$_SESSION['google_user'] = $client->getAccessToken();
}

if (isset($_SESSION['google_user'])) 
{
	$client->setAccessToken($_SESSION['google_user']);

	// get token
	$user_token = json_decode( $_SESSION['google_user'] );
	$user_token = $user_token->access_token;
	
	// get emails
	$url = 'https://www.google.com/m8/feeds/contacts/default/full?max-results=1000&access_token=' . $user_token;
	$xmlresponse = file_get_contents($url);
	$xml=  new SimpleXMLElement($xmlresponse);
	$xml->registerXPathNamespace('gd', 'http://schemas.google.com/g/2005');
	$result = $xml->xpath('//gd:email');
	if( $result ){
		foreach($result as $title)
		{
			$emails[] = $title->attributes()->address;
		}
	}

} else {
	$url = $client->createAuthUrl();
	header('Location:' . $url);
}

?>