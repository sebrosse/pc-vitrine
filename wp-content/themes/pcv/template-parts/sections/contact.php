<?php
$sidebar = get_sub_field( 'sidebar' );
?>
<div class="container">
    <div class="axil-contact-page axil-section-gap">
        <div class="row row--30">
            <div class="col-lg-8">
                <div class="contact-form">
                    <h3 class="title mb--10"><?php the_sub_field( 'title' ); ?></h3>
                    <p><?php the_sub_field( 'subtitle' ); ?></p>
					<?php echo do_shortcode( '[contact-form-7 id="' . get_sub_field( 'formulaire' ) . '" title="Contact form 1"]' ); ?>
                </div>
            </div>
            <div class="col-lg-4">
				<?php foreach ( $sidebar as $item ) { ?>
                    <div class="mb--40">
                        <h4 class="title mb--20"><?php echo $item['title'];?></h4>
                        <div><?php echo $item['text'];?></div>
                    </div>
				<?php } ?>
            </div>
        </div>
    </div>
</div>