<div class="favorite-wrapper">
	<?php if ( ! $hide_favorite_label ) { ?>
        <small class="text-muted">Ajouter aux favoris</small>
	<?php } ?>
    <a href="#" title="Ajouter aux favoris"
       class="add-to-favorites add-favorite-js"
       data-pid="<?php echo $pc_id; ?>">
        <i class="fa fa-heart"></i>
        <i class="fal fa-heart"></i>
    </a>
</div>