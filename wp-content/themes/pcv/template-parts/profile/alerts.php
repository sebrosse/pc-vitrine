<?php
$apiCall = new \App\ApiCall();
$alerts  = $apiCall->alerts();

?>
<div class="axil-dashboard-order">
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th></th>
                <th scope="col" colspan="2">Produit</th>
                <th scope="col">Prix actuel</th>
                <th scope="col">Alerte</th>
            </tr>
            </thead>
            <tbody>
			<?php foreach ( $alerts['content'] as $alert ) {

				$posts = get_posts( array(
					'numberposts' => 1,
					'post_type'   => 'pc-product',
					'meta_key'    => 'pc_id',
					'meta_value'  => $alert['product']['id']
				) ); ?>

				<?php
				if ( isset( $posts[0] ) ) {
					$permalink   = get_permalink( $posts[0]->ID );
					$title       = get_the_title( $posts[0]->ID );
					$PCV_product = new \App\PCVProduct( $posts[0] );
					?>
                    <tr class="table-list-item">
                        <td>
                            <a href="#" class="mini-action remove-alert-js" data-aid="<?php echo $alert['id']; ?>"
                               title="supprimer l'alerte">
                                <i class="fal fa-times"></i>
                            </a>
                        </td>
                        <td>
                            <a href="<?php echo $permalink; ?>">
								<?php echo $title; ?>
                            </a>
                        </td>
                        <td class="product-list-thumbnail">
                            <a href="<?php echo $permalink; ?>">
			                    <?php echo get_the_post_thumbnail( $posts[0]->ID, 'thumb-list' ); ?>
                            </a>
                        </td>
                        <td><?php echo $PCV_product->get_best_price(); ?></td>
                        <td>
                            <span class="h5">
                                <?php echo \App\FormattingHelper::format_price($alert['threshold']); ?>
                            </span>
                        </td>
                    </tr>
					<?php
				}
			} ?>
            </tbody>
        </table>
    </div>
</div>