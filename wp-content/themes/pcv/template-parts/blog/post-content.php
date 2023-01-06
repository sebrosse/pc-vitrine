<div class="axil-blog-area">
    <div class="axil-single-post post-formate post-standard">
        <div class="container">
            <div class="content-block">
                <div class="inner">
                    <div class="post-thumbnail">
						<?php the_post_thumbnail( 'full' ); ?>
                    </div>
                    <!-- End .thumbnail -->
                </div>
            </div>
            <!-- End .content-blog -->
        </div>
    </div>
    <!-- End .single-post -->
    <div class="post-single-wrapper position-relative">
        <div class="container">
            <div class="row">
                <div class="col-lg-1">
                    <div class="d-flex flex-wrap align-content-start h-100">
                        <div class="position-sticky sticky-top">
                            <div class="post-details__social-share">
                                <span class="share-on-text">Partager:</span>
                                <div class="social-share">
                                    <a href="<?php echo 'https://www.facebook.com/sharer.php?u='.get_permalink();?>" target="_blank">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="<?php echo 'https://twitter.com/share?url='.get_permalink().'&text='.esc_attr(get_the_title());?>">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 axil-post-wrapper">
                    <div class="post-heading">
                        <h1 class="title h2"><?php the_title(); ?></h1>
                        <div class="axil-post-meta">
                            <div class="post-author-avatar">
                                <?php get_avatar( get_the_author_meta( 'ID' ), 96 );?>
                            </div>
                            <div class="post-meta-content">
                                <h6 class="author-title">
                                    <a href="#"><?php the_author();?></a>
                                </h6>
                                <ul class="post-meta-list">
                                    <li>Publié le:&nbsp;<?php echo get_post_time( 'd/m/Y à H:i' ) ?></li>
									<?php if ( ( get_post_modified_time() - get_post_time() ) > 60 * 60 * 24 ) { ?>
                                        <li>Mis à jour le:<?php echo get_post_modified_time('d/m/Y à H:i') ?></li>
									<?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>

					<?php the_content(); ?>
                    
                </div>

            </div>
        </div>
    </div>
</div>