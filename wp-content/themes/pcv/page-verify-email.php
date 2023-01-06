<?php

/**
 * Template name: Verify email
 */

$email = $_GET['email'];
$token = $_GET['token'];

$token_passed_check = \App\User::check_token( $email, $token,\App\User::KEY_VERIFICATION_TOKEN );

if ( $token_passed_check ) {
	\App\User::verify_user( $email );
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
                        <a href="<?php echo get_permalink(get_field(\App\ACFSetup::OPTION_PAGE_PROFILE,'option')->ID);?>" class="axil-btn btn-bg-secondary sign-up-btn">Mon profil</a>
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
                        <p class="b2 ">Validation de votre email</p>
						<?php if ( $token_passed_check ) { ?>
                            <div class="alert alert-success">
                                Votre email est désormais validé.
                            </div>
						<?php } else { ?>
                            <div class="alert alert-warning">
                                La vérification de votre email a échoué.
                            </div>
						<?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>