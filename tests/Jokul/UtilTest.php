<?php

use Jokul\Common\Utils;
use Jokul\TestCase;

class UtilTest extends TestCase
{
	public function testCanGetArrayByPath()
	{
		$array = [
			'order' => [
				'amount' => 20000,
				'invoice_nunmber' => 'INV-' . time(),
			]
		];

		$this->assertEquals(
			$array['order']['amount'],
			Utils::getArrayByPath($array, 'order.amount'),
			'Value retrieved is the same'
		);
	}

	public function testNullIfKeyDoesntExist()
	{
		$array = [
			'order' => [
				'amount' => 20000,
				'invoice_nunmber' => 'INV-' . time(),
			]
		];

		$this->assertNull(
			Utils::getArrayByPath($array, 'payment.payment_due_date'),
			'Value retrieved is the same'
		);
	}
}