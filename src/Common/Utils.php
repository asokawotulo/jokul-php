<?php

namespace Jokul\Common;

class Utils
{
	public static function generateSignature($secretKey, $headers, $requestTarget, $body = null)
	{
		$signatureArray = [
			'Client-Id:' . $headers['Client-Id'],
			'Request-Id:' . $headers['Request-Id'],
			'Request-Timestamp:' . $headers['Request-Timestamp'],
			'Request-Target:' . $requestTarget,
		];

		if (!is_null($body)) {
			$digestSha256 = hash('sha256', $body, true);
			$digestBase64 = base64_encode($digestSha256);
			$signatureArray[] = 'Digest:' . $digestBase64;
		}

		$rawSignature = join("\n", $signatureArray);
		$signature = base64_encode(hash_hmac('sha256', $rawSignature, $secretKey, true));

		return 'HMACSHA256=' . $signature;
	}

	public static function getArrayByPath($array, $path, $seperator = '.')
	{
		$keys = explode($seperator, $path);

		foreach ($keys as $key) {
			$array = $array[$key] ?? null;
		}

		return $array;
	}

	public static function generateRequestId()
	{
		return uniqid();
	}

	public static function generateRequestTimestamp()
	{
		return gmDate("Y-m-d\TH:i:s\Z");
	}
}