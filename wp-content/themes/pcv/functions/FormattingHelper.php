<?php

namespace App;

class FormattingHelper {

	public static function format_price( $price, $currency = '€' ): string {
		return number_format( $price, 2, ',', ' ' ) . ' €';
	}

}