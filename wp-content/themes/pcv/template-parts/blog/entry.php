<div class="content-blog mt--60 mb--60">
    <div class="inner">
        <div class="thumbnail">
            <a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'full' ); ?>
            </a>
        </div>
        <div class="content">
            <h4 class="title">
				<?php the_title(); ?>
            </h4>
            <div class="axil-post-meta">

                <div class="post-meta-content">
                    <h6 class="author-title">
                        Par <?php echo get_userdata($post->post_author)->first_name;?>
                    </h6>
                    <ul class="post-meta-list">
                        <li>Publié le:&nbsp;<?php echo get_post_time( 'd/m/Y' ) ?></li>
	                    <?php if ( ( get_post_modified_time() - get_post_time() ) > 60 * 60 * 24 ) { ?>
                            <li>Mis à jour le:&nbsp;<?php echo get_post_modified_time('d/m/Y') ?></li>
	                    <?php } ?>
                    </ul>
                </div>
            </div>
			<?php the_excerpt(); ?>
            <div class="read-more-btn">
                <a class="axil-btn btn-bg-primary" href="<?php the_permalink(); ?>">Lire l'article</a>
            </div>
        </div>
    </div>
</div>