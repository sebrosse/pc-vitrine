<?php
get_header(); ?>
    <?php include THEME_ROOT_PATH.'/template-parts/common/breadcrumbs.php';?>
    <div class="axil-blog-area axil-section-gap">
        <div class="container">
            <div class="row row--25">
                <div class="col-lg-8 axil-post-wrapper">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'template-parts/blog/entry' ); ?>
					<?php endwhile; endif; ?>
					<?php
					the_posts_pagination(
						[
							'prev_text'=>'<i class="fal fa-arrow-left"></i>',
							'next_text'=>'<i class="fal fa-arrow-right"></i>'
						]
					);
					?>
                </div>
            </div>
        </div>
    </div>


<?php get_footer(); ?>