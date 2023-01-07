<?php
$PCV_Product = new \App\PCVProduct( $post );
$PCV_Product->get_price_history_data_points();

$pc_id           = get_field( 'pc_id' );
$metas           = get_field( 'metas' );
$price_variation = get_field( 'price_variation' );
?>

<div class="axil-single-product-area">
    <div class="single-product-thumb axil-section-gap pb--20 pb_sm--0 bg-vista-white">
        <div class="container">
            <div class="row row--25">
                <div class="offset-lg-1 col-lg-5 mb--40">
                    <div class="h-100">
                        <div class="position-sticky sticky-top">
                            <div class="row row--10">
                                <div class="col-12 mb--20">
                                    <div class="single-product-thumbnail axil-product thumbnail-grid">
                                        <div class="thumbnail">
											<?php echo pcv_get_product_featured_image( $post, 'full' ); ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- End .col -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 mb--40">
                    <div class="h-100">
                        <div class="position-sticky sticky-top">
                            <div class="single-product-content">
                                <div class="inner">
                                    <h1 class="product-title h2"><?php the_title(); ?></h1>
									<?php if ( ! empty( get_the_content() ) ) { ?>
                                        <p class="description"><?php echo strip_tags( get_the_content() ); ?></p>
									<?php } ?>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <small>Meileur prix</small>
                                            <b class="price-amount"><?php echo $PCV_Product->get_best_price(); ?></b>
                                        </div>
										<?php
										$hide_favorite_label = 0;
										include( THEME_ROOT_PATH . '/template-parts/ajax/favorite.php' ); ?>
                                    </div>
									<?php foreach ( $PCV_Product->get_offers() as $offer ) { ?>
                                        <a href="<?php echo $offer['url']; ?>"
                                           class="btn axil-btn btn-bg-white w-100 mb--15 justify-content-between d-flex">
                                            <span>
                                                <?php
                                                $website = $PCV_Product->get_website( $offer['domain'] );

                                                if ( $website && ! empty( $website['favicon'] ) ) {
	                                                ?>
                                                    <img src="<?php echo $website['favicon']['url']; ?>" width="16"
                                                         height="16"/>
                                                <?php }
                                                ?>
	                                            <?php echo $offer['domain']; ?>
                                            </span>
                                            <span><?php echo $PCV_Product->get_offer_price( $offer ); ?></span>
                                        </a>
									<?php } ?>

                                </div>

                                <hr>

                                <div class="product-action-wrapper w-100 justify-content-between">
                                    <div class="alert-title">
                                        <h5 class="mb--0">Définir une alerte</h5>
                                        <span class="text-muted">Vous serez notifié si le prix baisse</span>
                                    </div>
                                    <div class="alert-wrapper">
                                        <div class="input-group mb-3 alert-form-wrapper">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">€</span>
                                            </div>
                                            <input type="text" pattern="[0-9]*" class="form-control" placeholder="Seuil"
                                                   aria-label="Seuil alerte" id="alert-threshold" name="alert-threshold"
                                                   value="<?php echo $PCV_Product->get_alert_suggested_threshold( null ); ?>">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary add-alert-btn h-100 add-alert-js p--20"
                                                        type="button"
                                                        data-pid="<?php echo $pc_id; ?>">
                                                    Définir
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="axil-product-area bg-color-white axil-section-gap pb--50 pb_sm--30">
    <div class="container">
        <div class="row">
            <div class="offset-lg-2 col-lg-8 offset-md-1 col-md-10">
                <div class="product-additional-info p-0">
                    <div class="single-desc">
                        <h5 class="title">Spécifications pour&nbsp;<span
                                    class="text-decoration-underline"><?php the_title(); ?></span>:</h5>
                    </div>

                    <div class="table-responsive">
                        <table>
                            <tbody>
							<?php foreach ( $metas as $meta ) { ?>
                                <tr>
                                    <th><?php echo $meta['label']; ?></th>
                                    <td><?php echo $meta['value']; ?></td>
                                </tr>
							<?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="axil-product-area bg-vista-white axil-section-gap pb--50 pb_sm--30">
    <div class="container">
        <div class="row">
            <div class="offset-lg-1 col-lg-10">
				<?php $chart_data = get_field( 'chart_data' ); ?>
                <h3 class="mb--0 d-flex justify-content-between">
                    <div>Evolution du prix</div>
                    <div>
                        <div>
							<?php
							$product = $PCV_Product->get_product();
							include( THEME_ROOT_PATH . '/template-parts/pc-product/price-variation.php' ); ?>
                        </div>
                    </div>
                </h3>
                <div class="text-muted mb--30">Prix constatés sur les 60 derniers jours</div>
                <script>
                    var data = <?php echo json_encode( $chart_data );?>;
                </script>
                <div class="d-flex justify-content-end text-dark">
                    <span><?php echo $price_variation['min']; ?>€</span>
					<?php if ( $price_variation['min'] !== $price_variation['max'] ) { ?>
                        &nbsp;-&nbsp;<span><?php echo $price_variation['max']; ?>€</span>
					<?php } ?>
                </div>
                <canvas id="myChart" width="400" height="100"></canvas>
                <div class="chart-x-ticks d-flex justify-content-between">
                    <div class="limit limit-start">
						<?php echo @array_column( $chart_data, 'x' )[0]; ?>
                    </div>
                    <div class="limit limit-end">
						<?php echo @array_reverse( array_column( $chart_data, 'x' ) )[0]; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="axil-product-area bg-color-white axil-section-gap pb--50 pb_sm--30">
    <div class="container">
        <div class="row">
            <div class="offset-lg-1 col-lg-10">
                <div class="section-title-wrapper">
                    <span class="title-highlighter highlighter-primary">
                        <i class="far fa-shopping-basket"></i> <?php the_field( 'similar_products_surtitre', 'option' ); ?>
                    </span>
                    <h2 class="title"><?php the_field( 'similar_products_title', 'option' ); ?></h2>
                </div>
                <div class="row">
					<?php

					$similar_products_criteria = array_column( get_field( 'similar_products_criteria', 'option' ), 'criteria' );

					$meta_query = [ 'relation' => 'AND', ];

					foreach ( $metas as $meta ) {

						if ( in_array( $meta['slug'], $similar_products_criteria ) ) {
							$meta_query[] = [
								'meta_key'   => 'metas_%_value',
								'meta_value' => $meta['value'],
								'compare'    => '='
							];
						}
					}

					$args = [
						'post_type'      => 'pc-product',
						'post_status'    => 'publish',
						'posts_per_page' => 3,
						'orderby'        => 'rand',
						'order'          => 'ASC',
						'exclude'        => [ $product->ID ],
						'meta_query'     => $meta_query
					];

					$products = get_posts( $args );

					foreach ( $products as $product ) {
						include( THEME_ROOT_PATH . '/template-parts/pc-product/mini.php' );
					}
					?>
                </div>
            </div>
        </div>
    </div>
</div>
