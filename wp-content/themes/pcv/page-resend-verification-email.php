<?php

/**
 * Template name: Resend verification email
 */

$user = new App\User( get_current_user_id() );

if ( ! $user->is_verified() && is_user_logged_in() ) {
	$user->send_verification_email();
}

$referer = $_SERVER['HTTP_REFERER'] ?? "/";
$referer = add_query_arg( [
	'message_sent' => true
], $referer );
wp_redirect($referer);
exit;
