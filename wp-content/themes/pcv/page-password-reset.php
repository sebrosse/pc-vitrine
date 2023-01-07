<?php

/**
 * Template name: Password reset
 */

$password_changed = false;

$token_passed_check = \App\User::check_token( $_GET['email'], $_GET['token'], \App\User::KEY_PASSWORD_RESET_TOKEN );

if ( isset( $_POST['submit-reset'] ) ) {

	$password_validate = \App\User::validate_password( $_POST['user_password'], $_POST['user_repeat_password'] );

	if ( $token_passed_check && $password_validate ) {
		$user = get_user_by( 'email', $_GET['email'] );
		if ( $user ) {
			wp_set_password( $_POST['user_password'], $user->ID );
			delete_user_meta( $user->ID, \App\User::KEY_PASSWORD_RESET_TOKEN );
			$password_changed = true;
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
                        <a href="<?php echo get_permalink( get_field( \App\ACFSetup::OPTION_PAGE_PROFILE, 'option' )->ID ); ?>"
                           class="axil-btn btn-bg-secondary sign-up-btn">Mon profil</a>
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
                        <h3 class="title">Réinitialiser mon passe oublié</h3>
						<?php if ( ! $token_passed_check ) { ?>
                            <div class="alert alert-warning mb--35">
                                Le lien de réinitialisation est invalide. Veuillez faire une <a
                                        href="<?php echo pcv_get_page_link( \App\ACFSetup::OPTION_PAGE_REQUEST_PASSWORD_RESET ); ?>">nouvelle
                                    demande en cliquant ici</a>.
                            </div>
						<?php } else { ?>
                            <p class="b2 ">Saisissez votre nouveau mot de passe (de 8 à 20 caractères)</p>

							<?php if ( isset( $password_validate ) && ! $password_validate['success'] && ! $password_changed ) { ?>
                                <div class="alert alert-warning mb--35">
									<?php echo $password_validate['message']; ?>
                                </div>
							<?php } ?>

							<?php if ( $password_changed ) { ?>
                                <div class="alert alert-success mb--35">
                                    le mot de passe a été modifié avec succès.<br><a
                                            href="<?php echo pcv_get_page_link( \App\ACFSetup::OPTION_PAGE_LOGIN ); ?>"><i
                                                class="fa fa-sign-in"></i>&nbsp;Connexion</a>
                                </div>
							<?php } else { ?>
                                <form name="loginform" id="loginform" class="singin-form" method="post">
                                    <div class="form-group">
                                        <label for="user_password">Nouveau mot de passe</label>
                                        <input type="password" name="user_password" id="user_password"
                                               class="form-control" size="20">
                                    </div>
                                    <div class="form-group">
                                        <label for="user_repeat_password">Confirmez le nouveau mot de passe</label>
                                        <input type="password" name="user_repeat_password" id="user_repeat_password"
                                               class="form-control" size="20">
                                    </div>
                                    <div class="form-group d-flex align-items-center justify-content-between">
                                        <input type="hidden" name="_nonce"
                                               value="<?php echo wp_create_nonce( 'user-login-form' ); ?>">
                                        <button type="submit" name="submit-reset"
                                                class="axil-btn btn-bg-primary submit-btn">
                                            Enregistrer mon nouveau mot de passe
                                        </button>

                                    </div>
                                </form>
							<?php } ?>
						<?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>