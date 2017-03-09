<?php

namespace App;

class Destination
{
	protected static $_CACHE_ALL = null;
	protected static $_CACHE_FIND = [];

    public static function find($key)
    {
    	if (isset(static::$_CACHE_FIND[$key]))
    		return static::$_CACHE_FIND[$key];

    	$client = new \GuzzleHttp\Client();
		$res = $client->request('POST', env('RENTAL_CENTRAL_API_URL') . '/api/destinations/' . $key);
		static::$_CACHE_FIND[$key] = json_decode($res->getBody());

		return static::$_CACHE_FIND[$key];
	}

    public static function all()
    {
    	if (static::$_CACHE_ALL)
    		return static::$_CACHE_ALL;

    	$client = new \GuzzleHttp\Client();
		$res = $client->request('POST', env('RENTAL_CENTRAL_API_URL') . '/api/destinations');
		static::$_CACHE_ALL = collect(json_decode($res->getBody()));

		return static::$_CACHE_ALL;
	}
}
