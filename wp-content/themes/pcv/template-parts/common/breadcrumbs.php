<?php if ( ! is_front_page() ) { ?>
    <div class="axil-breadcrumb-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="inner">
						<?php if ( function_exists( 'yoast_breadcrumb' ) ) {
							$breadcrumbs = yoast_breadcrumb( '<ul class="axil-breadcrumb"><li>', '</li></ul>', false );
							echo str_replace( '»', '<li class="separator"></li></li><li>', $breadcrumbs );
						} ?>
                        <h1 class="title"><?php echo $wp_query->post->post_title; ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>