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

	<?php if ( ! in_array( get_page_template_slug(), [ "page-login.php", "page-registration.php" ] ) ) { ?>
        <!-- Start Header -->
        <header class="header axil-header header-style-5">
            <!-- Start Mainmenu Area  -->
            <div id="axil-sticky-placeholder"></div>
            <div class="axil-mainmenu">
                <div class="container">
                    <div class="header-navbar">
                        <div class="header-brand">
                            <a href="index.html" class="logo logo-dark">
                                <img src="assets/images/logo/logo.png" alt="Site Logo">
                            </a>
                            <a href="index.html" class="logo logo-light">
                                <img src="assets/images/logo/logo-light.png" alt="Site Logo">
                            </a>
                        </div>
                        <div class="header-main-nav">
                            <!-- Start Mainmanu Nav -->
                            <nav class="mainmenu-nav">
                                <button class="mobile-close-btn mobile-nav-toggler"><i class="fas fa-times"></i>
                                </button>
                                <div class="mobile-nav-brand">
                                    <a href="index.html" class="logo">
                                        <img src="assets/images/logo/logo.png" alt="Site Logo">
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
									'walker'         => new bootstrap_5_wp_nav_menu_walker()
								) );
								?>
                            </nav>
                            <!-- End Mainmanu Nav -->
                        </div>
                        <div class="header-action">
                            <ul class="action-list">
                                <li class="axil-search d-xl-block d-none">
                                    <input type="search" class="placeholder product-search-input" name="search2"
                                           id="search2" value="" maxlength="128" placeholder="What are you looking for?"
                                           autocomplete="off">
                                    <button type="submit" class="icon wooc-btn-search">
                                        <i class="flaticon-magnifying-glass"></i>
                                    </button>
                                </li>
                                <li class="axil-search d-xl-none d-block">
                                    <a href="javascript:void(0)" class="header-search-icon" title="Search">
                                        <i class="flaticon-magnifying-glass"></i>
                                    </a>
                                </li>
                                <li class="wishlist">
                                    <a href="wishlist.html">
                                        <i class="flaticon-heart"></i>
                                    </a>
                                </li>
                                <li class="shopping-cart">
                                    <a href="#" class="cart-dropdown-btn">
                                        <span class="cart-count">3</span>
                                        <i class="flaticon-shopping-cart"></i>
                                    </a>
                                </li>
                                <li class="my-account">
                                    <a href="javascript:void(0)">
                                        <i class="flaticon-person"></i>
                                    </a>
                                    <div class="my-account-dropdown">
                                        <span class="title">QUICKLINKS</span>
                                        <ul>
                                            <li>
                                                <a href="my-account.html">My Account</a>
                                            </li>
                                            <li>
                                                <a href="#">Initiate return</a>
                                            </li>
                                            <li>
                                                <a href="#">Support</a>
                                            </li>
                                            <li>
                                                <a href="#">Language</a>
                                            </li>
                                        </ul>
                                        <a href="sign-in.html" class="axil-btn btn-bg-primary">Login</a>
                                        <div class="reg-footer text-center">No account yet? <a href="sign-up.html"
                                                                                               class="btn-link">REGISTER
                                                HERE.</a></div>
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