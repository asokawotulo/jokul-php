# Jokul PHP Library

This library is an abstraction of Jokul's API for applications written with PHP.

## Table of Contents
- [Links](#links)
- [Installation](#installation)
- [Usage](#usage)
	- [Initialization](#initialization)
	- [Generate Signature](#generate-signature)
	- [Jokul Checkout](#jokul-checkout)

## Links
- [Main documentation](https://jokul.doku.com/docs)
- Dashboard
  - [Sandbox](https://jokul.doku.com/bo)
  - [Production](https://jokul.doku.com/bo)

## Installation
```bash
composer require asokawotulo/jokul-php
```

## Usage
### Initialization
Get the Client ID and Secret Key from [Business Account > Service](https://jokul.doku.com/bo/business-account/service-management)
```php
use Jokul\Jokul;

Jokul::setClientId('MCH-xxxx-xxxxxxxxxxxxx');
Jokul::setSecretKey('SK-xxxxxxxxxxxxxxxxxxxx');
Jokul::setEnv(Jokul::PRODUCTION); // or Jokul::SANDBOX
```

### Generate Signature
```php
use Jokul\Jokul;
use Jokul\Utils;

$requestTarget = '/api/target';
$secretKey = Jokul::getSecretKey();
$clientId = Jokul::getClientId();
$requestId = Utils::generateRequestId();
$requestTimestamp = Utils::generateRequestTimestamp();

$signature = Utils::generateSignature(
	$secretKey,
	$clientId,
	$requestId,
	$requestTimestamp,
	$requestTarget,
);
```

### Jokul Checkout
```php
$checkoutData = [
	'order' => [
		'amount' => 20000,
		'invoice_number' => 'INV-123',
	],
	'payment' => [
		'payment_due_date' => 60
	]
];

$response = \Jokul\Checkout::create($checkoutData);

echo $response['payment']['url'];
```