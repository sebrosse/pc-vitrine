<?php
$apiCall   = new \App\ApiCall();
$favorites = $apiCall->favorites();

?>
<div class="axil-dashboard-order">
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th></th>
                <th scope="col" colspan="2">Produit</th>
                <th scope="col">Ajouté le</th>
            </tr>
            </thead>
            <tbody>
			<?php foreach ( $favorites as $favorite ) {

				$posts     = get_posts( array(
					'numberposts' => 1,
					'post_type'   => 'pc-product',
					'meta_key'    => 'pc_id',
					'meta_value'  => $favorite['product']['id']
				) );
				$permalink = get_permalink( $posts[0]->ID );
				$title     = get_the_title( $posts[0]->ID );
				?>
                <tr class="table-list-item">
                    <td>
                        <a href="#" class="mini-action remove-favorite-js" data-fid="<?php echo $favorite['id']; ?>">
                            <i class="fal fa-times"></i>
                        </a>
                    </td>
                    <td class="product-list-thumbnail">
                        <a href="<?php echo $permalink; ?>">
							<?php echo get_the_post_thumbnail( $posts[0]->ID, 'thumb-list' ); ?>
                        </a>
                    </td>
                    <td>
                        <a href="<?php echo $permalink; ?>">
							<?php echo $title; ?>
                        </a>
                    </td>
                    <td>
						<?php echo date_i18n( 'j F Y', strtotime( $favorite['createdAt'] ) );; ?>
                    </td>
                </tr>
			<?php } ?>
            </tbody>
        </table>
    </div>
</div>