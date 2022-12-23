<div class="content-blog mt--60 mb--60">
    <div class="inner">
        <div class="thumbnail">
            <a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'full' ); ?>
            </a>
        </div>
        <div class="content">
            <h4 class="title">
                <a href="blog-details.html">
					<?php the_title(); ?>
                </a>
            </h4>
            <div class="axil-post-meta">

                <div class="post-meta-content">
                    <h6 class="author-title">
                        <a href="#">Theresa Underwood</a>
                    </h6>
                    <ul class="post-meta-list">
                        <li>Publié le <?php echo date_i18n( 'j F Y', $post->post_date ) ?></li>
						<?php if ( $post->post_date !== $post->post_modified ) { ?>
                            <li>Mis à jour le <?php echo date_i18n( 'j F Y', $post->post_modified ) ?></li>
						<?php } ?>
                    </ul>
                </div>
            </div>
            <?php the_excerpt();?>
            <div class="read-more-btn">
                <a class="axil-btn btn-bg-primary" href="<?php the_permalink();?>">Lire l'article</a>
            </div>
        </div>
    </div>
</div>
<?php

the_posts_pagination(
        [
                'prev_text'=>'<i class="fal fa-arrow-left"></i>',
                'next_text'=>'<i class="fal fa-arrow-right"></i>'
        ]
);

?>