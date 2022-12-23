<?php
$PCV_Product = new \App\PCVProduct( $product );
?>

<div class="product-mini axil-product product-style-one mb--30 col-lg-4">
    <div class="thumbnail">
        <a href="<?php echo get_permalink( $product->ID ); ?>">
            <img src="<?php echo pcv_get_product_featured_image_url( $product ); ?>"
                 alt="<?php echo esc_attr( get_the_title( $product->ID ) ); ?>">
        </a>
    </div>
    <div class="product-content bg-vista-white">
        <div class="inner">
            <h5 class="title"><a
                        href="<?php echo get_permalink( $product->ID ); ?>"><?php echo get_the_title( $product->ID ); ?></a>
            </h5>
            <div class="product-price-variant d-flex justify-content-between align-items-center">
                <span>
                    <span class="price current-price">
                        <?php echo $PCV_Product->get_best_price(); ?>
                    </span>
                <?php include( THEME_ROOT_PATH . '/template-parts/pc-product/price-variation.php' ); ?>
                </span>
				<?php
				$hide_favorite_label = 1;
				$pc_id               = $pc_id = get_field( 'pc_id', $product->ID );
				include( THEME_ROOT_PATH . '/template-parts/ajax/favorite.php' ); ?>
            </div>
        </div>
    </div>
</div>