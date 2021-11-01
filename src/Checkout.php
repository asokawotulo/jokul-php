<?php

namespace Jokul;

class Checkout
{
	use ApiOperations\Request;
	use ApiOperations\Create;

	public static function classUrl()
	{
		return '/checkout/v1/payment';
	}

	public static function createRequiredParams()
	{
		return [
			'order.amount',
			'order.invoice_number',
			'payment.payment_due_date',
		];
	}
}