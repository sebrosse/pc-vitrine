<?php

/**
 * Template name: Register
 */

if ( isset( $_POST['submit-registration'] ) && wp_verify_nonce( $_POST['_nonce'], 'user-registration-form' ) ) {

	$errors = [];

	if ( ! is_email( $_POST['user_email'] ) ) {
		$errors[] = "Veuillez saisir un email valide";
	}

	if ( strlen( $_POST['user_pass'] ) < 8 || strlen( $_POST['user_pass'] ) > 20 ) {
		$errors[] = "Le mot de passe doit contenir entre 8 et 20 caractères";
	} elseif ( str_contains( $_POST['user_pass'], " " ) ) {
		$errors[] = "Le mot de passe ne peut pas contenir d'espace";
	}

	if ( empty( $errors ) ) {

		$user_id = wp_create_user( $_POST['user_email'], $_POST['user_pass'], $_POST['user_email'] );

		if ( is_wp_error( $user_id ) ) {
			$errors = $user_id->get_error_messages();
		} else {
			$user = new \App\User( $user_id );
			$user->send_verification_email();

			$api_call = new \App\ApiCall();
			$response = $api_call->add_user( $user->user_email );

			add_user_meta( $user->ID, 'apiKey', $response['apiKey'] );

			wp_redirect( "/profile" );
		}

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
                        <p>Déja membre?</p>
                        <a href="<?php echo get_permalink(get_field(\App\ACFSetup::OPTION_PAGE_LOGIN,'option')->ID);?>" class="axil-btn btn-bg-secondary sign-up-btn">Se connecter</a>
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
                        <h3 class="title">Créer un compte</h3>

						<?php if ( isset( $errors ) ) { ?>
                            <div class="alert alert-danger mb--25" role="alert">
                                <ul class="mb--0">
									<?php foreach ( $errors as $error ) { ?>
                                        <li><?php echo $error; ?></li>
									<?php } ?>
                                </ul>
                            </div>
						<?php } ?>
                        <form name="registerform" id="registerform" method="post">
                            <div class="form-group">
                                <label for="user_email">Email</label>
                                <input type="email" name="user_email" id="user_email" class="form-control"
                                       value="<?php echo $_POST['user_email']; ?>" autocomplete="email">
                            </div>

                            <div class="form-group">
                                <label for="user_pass">Mot de passe</label>
                                <input type="password" name="user_pass" id="user_pass" class="form-control"
                                       maxlength="20" value="">
                                <div id="emailHelp" class="form-text">Doit contenir de 8 à 20 caractères
                                </div>
                            </div>

                            <div class="form-group d-flex align-items-center justify-content-between">
                                <input type="hidden" name="_nonce"
                                       value="<?php echo wp_create_nonce( 'user-registration-form' ); ?>">
                                <button type="submit" name="submit-registration"
                                        class="axil-btn btn-bg-primary submit-btn">Créer
                                    mon compte
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>