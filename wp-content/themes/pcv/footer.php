</main>

<?php if ( ! pcv_is_login_template() ) { ?>
    <footer class="axil-footer-area footer-style-2">
        <!-- Start Copyright Area  -->
        <div class="copyright-area copyright-default separator-top">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-4">
                        <div class="social-share">
							<?php foreach ( get_field( 'social_networks', 'option' ) as $item ) { ?>
                                <a href="<?php echo $item['url']; ?>" target="_blank">
                                    <i class="fab fa-<?php echo $item['name']; ?>-f"></i>
                                </a>

							<?php } ?>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-12">
                        <div class="copyright-left d-flex flex-wrap justify-content-center">
			                <?php
			                wp_nav_menu( [
				                'theme_location' => 'footer-menu',
				                'container'      => false
			                ]);
			                ?>

                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-12">
                        <div class="copyright-right d-flex flex-wrap justify-content-xl-end justify-content-center align-items-center">
                            <ul class="payment-icons-bottom quick-link">
                                <li>© <?php echo ( new \DateTime() )->format( 'Y' ); ?>. Tous droits réservés.
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Copyright Area  -->
    </footer>
	<?php include THEME_ROOT_PATH . '/template-parts/common/search.php'; ?>
<?php } ?>
</div>
<?php wp_footer(); ?>
</body>
</html>