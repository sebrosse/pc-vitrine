<?php

/**
 * Template name: Profile
 */

if ( ! is_user_logged_in() ) {
	wp_redirect( '/login' );
	exit;
}

$user = new App\User( get_current_user_id() );
$user->send_verification_email();
?>

<?php get_header(); ?>
    <!-- Start Breadcrumb Area  -->
    <div class="axil-breadcrumb-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-8">
                    <div class="inner">
                        <ul class="axil-breadcrumb">
                            <li class="axil-breadcrumb-item"><a href="<?php echo home_url(); ?>">Accueil</a></li>
                            <li class="separator"></li>
                            <li class="axil-breadcrumb-item active" aria-current="page">Mon compte</li>
                        </ul>
                        <h1 class="title">Gérer mon compte</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-4">
                    <div class="inner">
                        <div class="bradcrumb-thumb">
                            <!--<img src="assets/images/product/product-45.png" alt="Image">-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb Area  -->

    <!-- Start My Account Area  -->
    <div class="axil-dashboard-area axil-section-gap">
        <div class="container">
            <div class="axil-dashboard-warp">
                <div class="axil-dashboard-author">
                    <div class="media">
                        <div class="thumbnail">
							<?php echo get_avatar( $user->ID ); ?>
                        </div>
                        <div class="media-body">
                            <h5 class="title mb-0">Hello <?php echo ucfirst( $user->user_email ); ?></h5>
                            <span class="joining-date">Membre depuis le <?php echo date_i18n( 'j F Y', strtotime( $user->user_registered ) ); ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">
					<?php $profile_tab = get_field( 'profile_tab' );
					include( THEME_ROOT_PATH . '/template-parts/profile/navigation.php' ); ?>
                    <div class="col-xl-9 col-md-8">
						<?php
                        if($user->is_verified()){
	                        include( THEME_ROOT_PATH . '/template-parts/profile/' . $profile_tab . '.php' );
                        }else{
	                        include( THEME_ROOT_PATH . '/template-parts/profile/verify-user-notice.php' );
                        }
						?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End My Account Area  -->

    <!-- Start Axil Newsletter Area  -->
    <div class="axil-newsletter-area axil-section-gap pt--0">
        <div class="container">
            <div class="etrade-newsletter-wrapper bg_image bg_image--5">
                <div class="newsletter-content">
                    <span class="title-highlighter highlighter-primary2"><i class="fas fa-envelope-open"></i>Newsletter</span>
                    <h2 class="title mb--40 mb_sm--30">Get weekly update</h2>
                    <div class="input-group newsletter-form">
                        <div class="position-relative newsletter-inner mb--15">
                            <input placeholder="example@gmail.com" type="text">
                        </div>
                        <button type="submit" class="axil-btn mb--15">Subscribe</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End .container -->
    </div>
    <!-- End Axil Newsletter Area  -->
<?php get_footer(); ?>