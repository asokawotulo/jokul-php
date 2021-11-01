<?php

namespace Jokul;

use Dotenv\Dotenv;
use Jokul\Checkout;
use Jokul\Jokul;
use PHPUnit\Framework\TestCase;

class CheckoutTest extends TestCase
{
	protected function setUp(): void
	{
		$dotenv = Dotenv::createImmutable(__DIR__ . '/../..');
		$dotenv->load();

		Jokul::setEnv(Jokul::SANDBOX);
		Jokul::setClientId($_ENV['CLIENT_ID']);
		Jokul::setSecretKey($_ENV['SECRET_KEY']);
	}

	protected function tearDown(): void
	{
		Jokul::setEnv(Jokul::PRODUCTION);
	}

	public function testCreateCheckout()
	{
		$checkoutData = [
			'order' => [
				'amount' => 20000,
				'invoice_number' => 'INV-123',
			],
			'payment' => [
				'payment_due_date' => 60
			]
		];

		$checkoutResponse = Checkout::create($checkoutData);

		$this->assertEquals($checkoutData['order']['amount'], $checkoutResponse['response']['order']['amount']);
		$this->assertEquals($checkoutData['order']['invoice_number'], $checkoutResponse['response']['order']['invoice_number']);
		$this->assertEquals($checkoutData['payment']['payment_due_date'], $checkoutResponse['response']['payment']['payment_due_date']);
	}

	public function testThrowsInvalidArgumentException()
	{
		$this->expectException(\InvalidArgumentException::class);

		Checkout::create([]);
	}
}