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

	<?php if ( ! pcv_is_login_template() ) { ?>
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
								<?php if ( ! is_front_page() ) { ?>
                                    <li class="axil-search d-xl-block d-none">
                                        <input type="search" class="placeholder product-search-input" name="search2"
                                               id="search2" value="" maxlength="128"
                                               placeholder="Que recherchez-vous ?" autocomplete="off">
                                        <button type="submit" class="icon wooc-btn-search">
                                            <i class="flaticon-magnifying-glass"></i>
                                        </button>
                                    </li>
								<?php } ?>
                                <li class="my-account">
                                    <a href="javascript:void(0)">
                                        <i class="flaticon-person"></i>
                                    </a>
                                    <div class="my-account-dropdown">
                                        <ul>
                                            <li>
                                                <a href="<?php echo pcv_get_page_link( \App\ACFSetup::OPTION_PAGE_PROFILE ); ?>" class="d-flex justify-content-between">
                                                    <span>Profil</span><i class="flaticon-person"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo pcv_get_page_link( \App\ACFSetup::OPTION_PAGE_PROFILE_ALERTS ); ?>" class="d-flex justify-content-between">
                                                    <span>Alertes</span><i class="flaticon-warning-sign"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo pcv_get_page_link( \App\ACFSetup::OPTION_PAGE_PROFILE_FAVORITES ); ?>" class="d-flex justify-content-between">
                                                    <span>Favoris</span><i class="flaticon-heart"></i>
                                                </a>
                                            </li>
                                            <li>
												<?php if ( ! is_user_logged_in() ) { ?>
                                                    <a href="<?php echo pcv_get_page_link( \App\ACFSetup::OPTION_PAGE_LOGIN ); ?>"
                                                       class="axil-btn btn-primary text-center">Connexion</a>
												<?php } else { ?>
                                                    <a href="<?php echo pcv_get_page_link( \App\ACFSetup::OPTION_PAGE_LOGOUT ); ?>"
                                                       class="d-flex justify-content-between">
                                                        <span>Déconnexion</span><i class="fal fa-sign-out"></i>
                                                    </a>
												<?php } ?>
                                            </li>
                                        </ul>
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