<small>
	<?php
	$variation = get_field( 'price_variation', $product->ID )['variation'];
	if ( $variation < 0 ) {
		?>
        <i class="fa fa-arrow-down" style="color:green"></i>&nbsp;<span
                style="color: green"><?php echo $variation; ?>%</span>
	<?php } elseif ( $variation > 0 ) { ?>
        <i class="fa fa-arrow-up" style="color:orangered"></i>&nbsp;<span
                style="color: orangered"><?php echo $variation; ?>%</span>
	<?php } elseif ( $variation == 0 ) { ?>
        <i class="fa fa-equals text-info"></i>&nbsp;<span
                class="text-info">Stable</span>
	<?php } ?>
</small>