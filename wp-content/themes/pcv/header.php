<!DOCTYPE html>
<html <?php language_attributes(); ?> <?php pcv_schema_type(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>"/>
    <meta name="viewport" content="width=device-width"/>
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'sticky-header' ); ?>>
<?php wp_body_open(); ?>
<div id="wrapper" class="hfeed">
    <a href="#top" class="back-to-top" id="backto-top"><i class="fal fa-arrow-up"></i></a>

	<?php if ( ! in_array( get_page_template_slug(), [
            "page-login.php",
        "page-registration.php",
		"page-verify-email.php"] ) ) { ?>
        <!-- Start Header -->
        <header class="header axil-header header-style-5">
            <!-- Start Mainmenu Area  -->
            <div id="axil-sticky-placeholder"></div>
            <div class="axil-mainmenu">
                <div class="container">
                    <div class="header-navbar">
                        <div class="header-brand">
                            <a href="<?php echo site_url(); ?>" class="logo logo-dark">
                                <img src="<?php the_field( 'logo', 'option' ); ?>" alt="Site Logo">
                            </a>
                        </div>
                        <div class="header-main-nav">
                            <!-- Start Mainmanu Nav -->
                            <nav class="mainmenu-nav">
                                <button class="mobile-close-btn mobile-nav-toggler"><i class="fas fa-times"></i>
                                </button>
                                <div class="mobile-nav-brand">
                                    <a href="<?php echo site_url(); ?>" class="logo">
                                        <img src="<?php the_field( 'logo', 'option' ); ?>" alt="Site Logo">
                                    </a>
                                </div>
								<?php
								wp_nav_menu( array(
									'theme_location' => 'main-menu',
									'container'      => false,
									'menu_class'     => 'mainmenu',
									'fallback_cb'    => '__return_false',
									//'items_wrap' => '<ul id="%1$s" class="navbar-nav me-auto mb-2 mb-md-0 %2$s">%3$s</ul>',
									'depth'          => 2,
									'walker'         => new \App\Bootstrap5MenuWalker()
								) );
								?>
                            </nav>
                            <!-- End Mainmanu Nav -->
                        </div>
                        <div class="header-action">
                            <ul class="action-list">

                                <li class="my-account">
                                    <a href="javascript:void(0)">
                                        <i class="flaticon-person"></i>
                                    </a>
                                    <div class="my-account-dropdown">
                                        <ul>
                                            <li>
                                                <a href="/profile" class="d-flex justify-content-between">
                                                    <span>Profil</span><i class="flaticon-person"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="/profile/alerts" class="d-flex justify-content-between">
                                                    <span>Alertes</span><i class="flaticon-warning-sign"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="/profile/favorites" class="d-flex justify-content-between">
                                                    <span>Favoris</span><i class="flaticon-heart"></i>
                                                </a>
                                            </li>
                                        </ul>
                                        <?php if(!is_user_logged_in()){?>
                                        <a href="/login" class="axil-btn btn-bg-primary">Connexion</a>
                                        <div class="reg-footer text-center">Pas encore membre ?
                                            <a href="/register" class="btn-link">S'inscrire</a>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </li>
                                <li class="axil-mobile-toggle">
                                    <button class="menu-btn mobile-nav-toggler">
                                        <i class="flaticon-menu-2"></i>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Mainmenu Area -->
        </header>
        <!-- End Header -->
	<?php } ?>

    <main class="main-wrapper">