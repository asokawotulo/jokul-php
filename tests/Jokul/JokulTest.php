<?php

namespace Jokul;

use Jokul\Jokul;
use Jokul\TestCase;

class JokulTest extends TestCase
{
	public function testApiUrlIsProductionByDefault()
	{
		$this->assertEquals('https://api.doku.com', Jokul::getApiUrl(), 'Jokul API URL is production by default');
	}

	public function testSwitchEnvironments()
	{
		Jokul::setEnv(Jokul::SANDBOX);

		$this->assertEquals('https://api-sandbox.doku.com', Jokul::getApiUrl(), 'Change environment to sandbox');

		Jokul::setEnv(Jokul::PRODUCTION);

		$this->assertEquals('https://api.doku.com', Jokul::getApiUrl(), 'Change environment to production');
	}

	public function testThrowInvalidArgumentException()
	{
		$this->expectException(\InvalidArgumentException::class);
		
		Jokul::setEnv('');
	}

	public function testClientId()
	{
		$clientId = $_ENV['CLIENT_ID'];

		Jokul::setClientId($clientId);

		$this->assertEquals($clientId, Jokul::getClientId());
	}

	public function testSecretKey()
	{
		$secretKey = $_ENV['SECRET_KEY'];

		Jokul::setSecretKey($secretKey);

		$this->assertEquals($secretKey, Jokul::getSecretKey());
	}
}