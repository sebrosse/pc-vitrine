<?php

namespace App;

class EncryptionHelper {

	const CYPHERING = "AES-128-CTR";
	const OPTIONS = 0;
	private string $encryption_key;
	private string $encryption_iv;

	public function __construct() {
		$this->encryption_key = get_field( 'encryption_key', 'option' );
		$this->encryption_iv  = get_field( 'encryption_iv', 'option' );
	}

	public function encrypt( $string ) {
		return urlencode( base64_encode( openssl_encrypt( $string, self::CYPHERING,
			$this->encryption_key, self::OPTIONS, $this->encryption_iv ) ) );
	}

	public function decrypt( $encrypted_string ) {
		return openssl_decrypt( base64_decode( urldecode( $encrypted_string ) ), self::CYPHERING,
			$this->encryption_key, self::OPTIONS, $this->encryption_iv );
	}
}