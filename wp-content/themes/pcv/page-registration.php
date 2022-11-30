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
		if ( $_POST['user_pass'] ) {
			$user = wp_create_user( $_POST['user_email'], $_POST['user_pass'], $_POST['user_email'] );
		}

		if ( is_wp_error( $user ) ) {
			$errors = $user->get_error_messages();
		} else {
			wp_redirect( "/" );
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
                    <a href="index.html" class="site-logo"><img src="./assets/images/logo/logo.png" alt="logo"></a>
                </div>
                <div class="col-sm-8">
                    <div class="singin-header-btn">
                        <p>Not a member?</p>
                        <a href="sign-up.html" class="axil-btn btn-bg-secondary sign-up-btn">Sign Up Now</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header -->

        <div class="row">
            <div class="col-xl-4 col-lg-6">
                <div class="axil-signin-banner bg_image bg_image--9">
                    <h3 class="title">We Offer the Best Products</h3>
                </div>
            </div>
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