<?php

get_header();

include THEME_ROOT_PATH.'/template-parts/common/breadcrumbs.php';

if (have_posts()):
	while (have_posts()) :
		the_post();
		get_template_part( 'template-parts/content/content' );
		get_template_part( 'template-parts/sections' );
	endwhile;
endif;

get_footer();
