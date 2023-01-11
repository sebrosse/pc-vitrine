<?php

/**
 * Template name: Redirect
 */

$encrypted_page_id = get_query_var( 'pid' );
$ip_address  = $_SERVER['REMOTE_ADDR'];
$user_agent  = $_SERVER['HTTP_USER_AGENT'];
$showcase_id = (int) get_field( 'showcase_id', 'option' );

if ( ! empty( $encrypted_page_id ) ) {
	$EncryptionHelper = new \App\EncryptionHelper();
	$page_id          = (int) $EncryptionHelper->decrypt( $encrypted_page_id );

	$ApiCall   = new \App\ApiCall();
	$add_click = $ApiCall->add_click( $page_id, $showcase_id, $ip_address, $user_agent );

	wp_redirect( $add_click['content']['affiliateUrl'] );
	exit;

}

wp_redirect( $_SERVER['HTTP_REFERER'] );
exit;