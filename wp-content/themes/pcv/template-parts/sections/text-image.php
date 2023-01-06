<?php
$image          = get_sub_field( 'image' );
$image_position = get_sub_field( 'image_position' );
$surtitre       = get_sub_field( 'surtitre' );
$title          = get_sub_field( 'title' );
$accroche       = get_sub_field( 'accroche' );
$text           = get_sub_field( 'text' );
$cta            = get_sub_field( 'cta' );
?>

<div class="axil-about-area about-style-2">
    <div class="container">
        <div class="row align-items-center mb--80 mb_sm--60">
            <div class="col-lg-5 <?php echo $image_position === 'left' ? 'order-lg-1' : 'order-lg-2'; ?>">
                <div class="about-thumbnail">
					<?php echo wp_get_attachment_image( $image['id'], 'full' ); ?>
                </div>
            </div>
            <div class="col-lg-7 <?php echo $image_position === 'left' ? 'order-lg-2' : 'order-lg-1'; ?>">
                <div class="about-content content-right">
					<?php if ( ! empty( $surtitre ) ) { ?>
                        <span class="subtitle"><?php echo $surtitre; ?></span>
					<?php } ?>
                    <h4 class="title"><?php echo $title; ?></h4>
					<?php echo $text; ?>
					<?php if ( ! empty( $cta['label'] ) ) { ?>
                        <a href="<?php echo $cta['target']; ?>"
                           class="axil-btn btn-outline"><?php echo $cta['label']; ?></a>
					<?php } ?>

                </div>
            </div>
        </div>
    </div>
</div>