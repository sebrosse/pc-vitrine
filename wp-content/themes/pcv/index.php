<?php
get_header(); ?>
    <!-- Start Breadcrumb Area  -->
    <div class="axil-breadcrumb-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-8">
                    <div class="inner">
                        <ul class="axil-breadcrumb">
                            <li class="axil-breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="separator"></li>
                            <li class="axil-breadcrumb-item active" aria-current="page">Blogs</li>
                        </ul>
                        <h1 class="title">Blog List</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-4">
                    <div class="inner">
                        <div class="bradcrumb-thumb">
                            <img src="assets/images/product/product-45.png" alt="Image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb Area  -->
    <div class="axil-blog-area axil-section-gap">
        <div class="container">
            <div class="row row--25">
                <div class="col-lg-8 axil-post-wrapper">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'template-parts/blog/entry' ); ?>
					<?php endwhile; endif; ?>
                </div>
            </div>
        </div>
    </div>


<?php get_footer(); ?>