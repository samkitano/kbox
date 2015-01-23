<?php namespace Samkitano\Kbox;

use Illuminate\Support\Facades\Config as Config;

class Kbox 
{

	/**
	 * Verify existence of an email address
	 *
	 * @param $email
	 *
	 * @return \Kickbox\HttpClient\Response
	 */
	public static function verify($email)
	{

		$key        = Config::get('kbox::kickbox_api_key');

		$client     = new \Kickbox\Client($key);
		$kickbox    = $client->kickbox();
		$response   = $kickbox->verify($email);

		return $response;

	}

} 