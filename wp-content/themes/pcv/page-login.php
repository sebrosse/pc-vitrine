<?php

/**
 * Template name: Login
 */

if ( isset( $_GET['redirect_to'] ) ) {
	$redirect_to = $_GET['redirect_to'];
} elseif ( ! empty( $_POST['redirect_to'] ) ) {
	$redirect_to = $_POST['redirect_to'];
} else {
	$redirect_to = pcv_get_page_link( \App\ACFSetup::OPTION_PAGE_PROFILE );
}

if ( isset( $_POST['submit-login'] ) && wp_verify_nonce( $_POST['_nonce'], 'user-login-form' ) ) {

	$creds                  = [];
	$creds['user_login']    = $_POST['user_email'];
	$creds['user_password'] = $_POST['user_pass'];
	$creds['remember']      = true;
	$user                   = wp_signon( $creds, true );
	if ( is_wp_error( $user ) ) {
		$errors = $user->get_error_messages();
	} else {
		wp_redirect( $redirect_to );
	}

}

?>

<?php get_header(); ?>

    <div class="axil-signin-area">

        <!-- Start Header -->
        <div class="signin-header">
            <div class="row align-items-center">
                <div class="col-sm-4">
                    <a href="/" class="site-logo">
						<?php include THEME_ROOT_PATH . '/template-parts/login/logo.php'; ?>
                    </a>
                </div>
                <div class="col-sm-8">
                    <div class="singin-header-btn">
                        <p>Pas de compte?</p>
                        <a href="/register" class="axil-btn btn-bg-secondary sign-up-btn">Créer un compte</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header -->

        <div class="row">
			<?php get_template_part( 'template-parts/login/login-sidebar' ); ?>
            <div class="col-lg-6 offset-xl-2">
                <div class="axil-signin-form-wrap">
                    <div class="axil-signin-form">
                        <h3 class="title">Connexion</h3>
                        <p class="b2 ">Entrez vos identifiants</p>
						<?php if ( isset( $errors ) ) { ?>
                            <div class="alert alert-danger mb--25" role="alert">
                                <ul class="mb--0">
									<?php foreach ( $errors as $error ) { ?>
                                        <li><?php echo $error; ?></li>
									<?php } ?>
                                </ul>
                            </div>
						<?php } ?>
                        <form name="loginform" id="loginform" class="singin-form" method="post">
                            <div class="form-group">
                                <label for="user_login">Adresse e-mail</label>
                                <input type="text" name="user_email" id="user_email" autocomplete="username"
                                       class="form-control" value="<?php echo $_POST['user_email']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="user_pass">Mot de passe</label>
                                <input type="password" name="user_pass" id="user_pass" autocomplete="current-password"
                                       class="form-control"
                                       value="<?php echo $_POST['user_pass']; ?>" size="20">
                            </div>

                            <div class="form-group d-flex align-items-center justify-content-between">
                                <input type="hidden" name="_nonce"
                                       value="<?php echo wp_create_nonce( 'user-login-form' ); ?>">
                                <input type="hidden" name="redirect_to" value="<?php echo $redirect_to; ?>">
                                <button type="submit" name="submit-login" class="axil-btn btn-bg-primary submit-btn">Se
                                    connecter
                                </button>
                                <a href="<?php echo pcv_get_page_link( \App\ACFSetup::OPTION_PAGE_REQUEST_PASSWORD_RESET ); ?>"
                                   class="forgot-btn">Mot de passe oublié?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>