<?php

namespace Jokul;

class Jokul
{
	const SANDBOX = 'SANDBOX';
	const SANDBOX_URL = 'https://api-sandbox.doku.com';

	const PRODUCTION = 'PRODUCTION';
	const PRODUCTION_URL = 'https://api.doku.com';

	public static $clientId;

	public static $secretKey;

	public static $apiUrl = self::PRODUCTION_URL;

	/**
	 * Get API URL
	 * 
	 * @return string 
	 */
	public static function getApiUrl()
	{
		return self::$apiUrl;
	}

	/**
	 * Set API URL
	 * 
	 * @param string $apiUrl 
	 * @return void 
	 */
	public static function setApiUrl(string $apiUrl)
	{
		self::$apiUrl = $apiUrl;
	}

	/**
	 * Get client ID
	 * 
	 * @return string 
	 */
	public static function getClientId()
	{
		return self::$clientId;
	}

	/**
	 * Set client ID
	 * 
	 * @return void 
	 */
	public static function setClientId(string $clientId)
	{
		self::$clientId = $clientId;
	}

	/**
	 * Get secret key
	 * 
	 * @return string 
	 */
	public static function getSecretKey()
	{
		return self::$secretKey;
	}

	/**
	 * Set secret key
	 * 
	 * @return void 
	 */
	public static function setSecretKey(string $secretKey)
	{
		self::$secretKey = $secretKey;
	}

	/**
	 * Set environment
	 * 
	 * @param string $env 
	 * @return void 
	 * @throws \InvalidArgumentException 
	 */
	public static function setEnv(string $env)
	{
		$constant = __CLASS__ . '::' . $env . '_URL';

		if (!defined($constant))
			throw new \InvalidArgumentException('Invalid environment');
		
		self::setApiUrl(constant($constant));
	}
}
