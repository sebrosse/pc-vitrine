<?php

if ( have_rows( 'sections' ) ):
	while ( have_rows( 'sections' ) ) : the_row(); ?>
		<?php get_template_part( 'template-parts/sections/' . get_row_layout() ); ?>
	<?php endwhile;
endif;
?>
