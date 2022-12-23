<?php

$args = [
	'post_type'      => 'pc-product',
	'posts_per_page' => 3,
	'post_status'    => 'publish',
	'meta_key'       => 'price_variation_variation',
	'orderby'        => 'meta_value',
	'order'          => 'ASC'
];

$products = get_posts( $args ); ?>
<div class="axil-section-gap">
    <div class="container">
        <div class="row">
            <div class="section-title-wrapper">
                <span class="title-highlighter highlighter-secondary">
                    <i class="fal fa-arrow-circle-down"></i>Baisse de prix</span>
                <h2 class="title">Les affaires du moment</h2>
            </div>
			<?php foreach ( $products as $product ) {
				include( THEME_ROOT_PATH . '/template-parts/pc-product/mini.php' );
			} ?>
        </div>
    </div>
</div>