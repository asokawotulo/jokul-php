<?php

namespace Jokul\ApiOperations;

use Jokul\Common\Utils;
use Jokul\HttpClient;

trait Request
{
	public static function validateParams($params, $requiredParams)
	{
		if (!is_array($params)) {
			$message = 'Parameters must be an array';
			throw new \InvalidArgumentException($message);
		}

		foreach ($requiredParams as $param) {
			$value = Utils::getArrayByPath($params, $param);
			if (is_null($value)) {
				$message = 'You must pass all required params';
				throw new \InvalidArgumentException($message);
			}
		}
	}

	protected static function _request($method, $url, $params = [])
	{
		$httpClient = new HttpClient();

		return $httpClient->request($method, $url, $params);
	}
}