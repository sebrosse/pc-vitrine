<?php

/**
 * Template name: Profile
 */

if ( ! is_user_logged_in() ) {
	wp_redirect( '/login' );
	exit;
}

$user = new App\User( get_current_user_id() );
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
	                        <?php echo get_avatar( $user->ID ); ?>
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
						if ( $user->is_verified() ) {
							include( THEME_ROOT_PATH . '/template-parts/profile/' . $profile_tab . '.php' );
						} else {
							if ( $_GET['message_sent'] ) {?>
                                <div class="alert alert-success">
                                    Un nouvel email de vérification vous a été envoyé.
                                </div>
							<?php } else {
								include( THEME_ROOT_PATH . '/template-parts/profile/verify-user-notice.php' );
							}
						}
						?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End My Account Area  -->
s
<?php get_footer(); ?>