<?php

/**
 * Template name: Request password reset
 */

if ( isset( $_POST['submit-reset-request'] ) && wp_verify_nonce( $_POST['_nonce'], 'user-login-form' ) ) {

	$email = $_POST['user_email'];

	$user = get_user_by( 'email', $email );

	if ( $user ) {
		( new \App\User( $user->ID ) )->send_password_reset_email();
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
                        <img src="<?php the_field( 'logo', 'option' ); ?>" alt="logo">
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
                        <h3 class="title">Mot de passe oublié</h3>
                        <p class="b2 ">Saisissez votre email de connexion</p>
						<?php if ( isset( $user ) ) { ?>
                            <div class="alert alert-success mb--25">
                                Un email de réinitialisation a été envoyé à l'adresse indiquée. Veuillez vérifier votre
                                boite mail et cliquer sur le lien fourni.
                            </div>
						<?php } ?>
                        <form name="loginform" id="loginform" class="singin-form" method="post">
                            <div class="form-group">
                                <label for="user_login">Adresse e-mail</label>
                                <input type="text" name="user_email" id="user_email" autocomplete="username"
                                       class="form-control">
                            </div>

                            <div class="form-group d-flex align-items-center justify-content-between">
                                <input type="hidden" name="_nonce"
                                       value="<?php echo wp_create_nonce( 'user-login-form' ); ?>">
                                <button type="submit" name="submit-reset-request"
                                        class="axil-btn btn-bg-primary submit-btn">
                                    Réinitialiser mon mot de passe
                                </button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>