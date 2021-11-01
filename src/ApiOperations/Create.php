<?php

namespace Jokul\ApiOperations;

trait Create
{
	public static function create($params)
	{
		self::validateParams($params, self::createRequiredParams());

		$url = self::classUrl();

		return self::_request('POST', $url, $params);
	}
}
