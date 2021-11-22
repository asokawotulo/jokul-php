<?php

namespace Jokul;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Jokul\Common\Utils;
use Jokul\Jokul;

class HttpClient
{
	private $_guzzleClient;

	public function request($method, $url, $params)
	{
		return json_decode($this->_requestRaw($method, $url, $params), true);
	}

	private function _setDefaultHeaders()
	{
		$defaultHeaders = [];
		$defaultHeaders['Client-Id'] = Jokul::getClientId();
		$defaultHeaders['Request-Id'] = Utils::generateRequestId();
		$defaultHeaders['Request-Timestamp'] = Utils::generateRequestTimestamp();

		return $defaultHeaders;
	}

	private function _requestRaw($method, $url, $params)
	{
		$headers = $this->_setDefaultHeaders();
		$headers['Signature'] = Utils::generateSignature(
			Jokul::getSecretKey(),
			$headers['Client-Id'],
			$headers['Request-Id'],
			$headers['Request-Timestamp'],
			$url,
			json_encode($params),
		);

		$response = $this->_guzzleClient()->request(
			$method,
			$url,
			[
				RequestOptions::JSON => $params,
				'headers' => $headers,
			]
		);

		return $response->getBody();
	}

	/**
	 * @return \GuzzleHttp\Client 
	 */
	private function _guzzleClient()
	{
		if (!$this->_guzzleClient) {
			$this->_guzzleClient = new Client([
				'base_uri' => Jokul::getApiUrl()
			]);
		}

		return $this->_guzzleClient;
	}
}