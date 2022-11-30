<div class="axil-blog-area axil-section-gap">
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
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="#"><i class="fab fa-discord"></i></a>
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

                    <div class="axil-comment-area">
                        <h4 class="title">2 comments</h4>
                        <ul class="comment-list">
                            <!-- Start Single Comment  -->
                            <li class="comment">
                                <div class="comment-body">
                                    <div class="single-comment">
                                        <div class="comment-img">
                                            <img src="./assets/images/blog/author-image-4.png" alt="Author Images">
                                        </div>
                                        <div class="comment-inner">
                                            <h6 class="commenter">
                                                <a class="hover-flip-item-wrapper" href="#">
                                                            <span class="hover-flip-item">
                                                                <span data-text="Cameron Williamson">Cameron Williamson</span>
                                                            </span>
                                                </a>
                                            </h6>
                                            <div class="comment-meta">
                                                <div class="time-spent">Nov 23, 2018 at 12:23 pm</div>
                                                <div class="reply-edit">
                                                    <div class="reply">
                                                        <a class="comment-reply-link hover-flip-item-wrapper" href="#">
                                                                    <span class="hover-flip-item">
                                                                        <span data-text="Reply">Reply</span>
                                                                    </span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="comment-text">
                                                <p>Duis hendrerit velit scelerisque felis tempus, id porta libero
                                                    venenatis. Nulla facilisi. Phasellus viverra magna commodo dui
                                                    lacinia tempus. Donec malesuada nunc non dui posuere, fringilla
                                                    vestibulum
                                                    urna mollis. Integer condimentum ac sapien quis maximus. </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <ul class="children">
                                    <!-- Start Single Comment  -->
                                    <li class="comment">
                                        <div class="comment-body">
                                            <div class="single-comment">
                                                <div class="comment-img">
                                                    <img src="./assets/images/blog/author-image-4.png"
                                                         alt="Author Images">
                                                </div>
                                                <div class="comment-inner">
                                                    <h6 class="commenter">
                                                        <a class="hover-flip-item-wrapper" href="#">
                                                                    <span class="hover-flip-item">
                                                                        <span data-text="Rahabi Khan">Annie Mario</span>
                                                                    </span>
                                                        </a>
                                                    </h6>
                                                    <div class="comment-meta">
                                                        <div class="time-spent">Nov 23, 2018 at 12:23 pm
                                                        </div>
                                                        <div class="reply-edit">
                                                            <div class="reply">
                                                                <a class="comment-reply-link hover-flip-item-wrapper"
                                                                   href="#">
                                                                            <span class="hover-flip-item">
                                                                                <span data-text="Reply">Reply</span>
                                                                            </span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="comment-text">
                                                        <p>Pellentesque habitant morbi tristique senectus et netus et
                                                            malesuada fames ac turpis egestas. Suspendisse lobortis
                                                            cursus lacinia. Vestibulum vitae leo id diam pellentesque
                                                            ornare.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- End Single Comment  -->
                                </ul>
                            </li>
                            <!-- End Single Comment  -->

                            <!-- Start Single Comment  -->
                            <li class="comment">
                                <div class="comment-body">
                                    <div class="single-comment">
                                        <div class="comment-img">
                                            <img src="./assets/images/blog/author-image-5.png" alt="Author Images">
                                        </div>
                                        <div class="comment-inner">
                                            <h6 class="commenter">
                                                <a class="hover-flip-item-wrapper" href="#">
                                                            <span class="hover-flip-item">
                                                                <span data-text="Rahabi Khan">Thopmson Arnold</span>
                                                            </span>
                                                </a>
                                            </h6>
                                            <div class="comment-meta">
                                                <div class="time-spent">Nov 23, 2018 at 12:23 pm</div>
                                                <div class="reply-edit">
                                                    <div class="reply">
                                                        <a class="comment-reply-link hover-flip-item-wrapper" href="#">
                                                                    <span class="hover-flip-item">
                                                                        <span data-text="Reply">Reply</span>
                                                                    </span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="comment-text">
                                                <p>Duis hendrerit velit scelerisque felis tempus, id porta libero
                                                    venenatis. Nulla facilisi. Phasellus viverra magna commodo dui
                                                    lacinia tempus. Donec malesuada nunc non dui posuere, fringilla
                                                    vestibulum
                                                    urna mollis. Integer condimentum ac sapien quis maximus. </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <!-- End Single Comment  -->
                        </ul>
                    </div>
                    <!-- End .axil-commnet-area -->

                    <!-- Start Comment Respond  -->
                    <div class="comment-respond">
                        <h4 class="title">Leave a Reply</h4>
                        <form action="#">
                            <p class="comment-notes"><span
                                        id="email-notes">Your email address will not be published.</span></p>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Leave a Reply</label>
                                        <textarea name="message" placeholder="Your Comment"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Name <span>*</span></label>
                                        <input id="name" type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Email <span>*</span> </label>
                                        <input id="email" type="email">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-submit">
                                        <button name="submit" type="submit" id="submit"
                                                class="axil-btn btn-bg-primary w-auto">Send Message
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- End Comment Respond  -->
                </div>

                <div class="col-lg-4">
                    <!-- Start Sidebar Area  -->
                    <aside class="axil-sidebar-area">

                        <!-- Start Single Widget  -->
                        <div class="axil-single-widget mt--40">
                            <h6 class="widget-title">Latest Posts</h6>

                            <!-- Start Single Post List  -->
                            <div class="content-blog post-list-view mb--20">
                                <div class="thumbnail">
                                    <a href="blog-details.html">
                                        <img src="assets/images/blog/blog-04.png" alt="Blog Images">
                                    </a>
                                </div>
                                <div class="content">
                                    <h6 class="title"><a href="blog-details.html">Dubai’s FRAME Offers its Take on
                                            the</a></h6>
                                    <div class="axil-post-meta">
                                        <div class="post-meta-content">
                                            <ul class="post-meta-list">
                                                <li>Mar 27, 2022</li>
                                                <li>300k Views</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Post List  -->

                            <!-- Start Single Post List  -->
                            <div class="content-blog post-list-view mb--20">
                                <div class="thumbnail">
                                    <a href="blog-details.html">
                                        <img src="assets/images/blog/blog-05.png" alt="Blog Images">
                                    </a>
                                </div>
                                <div class="content">
                                    <h6 class="title"><a href="blog-details.html">Apple presents App Best of 2020
                                            winners</a></h6>
                                    <div class="axil-post-meta">
                                        <div class="post-meta-content">
                                            <ul class="post-meta-list">
                                                <li>Mar 20, 2022</li>
                                                <li>300k Views</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Post List  -->

                            <!-- Start Single Post List  -->
                            <div class="content-blog post-list-view">
                                <div class="thumbnail">
                                    <a href="blog-details.html">
                                        <img src="assets/images/blog/blog-06.png" alt="Blog Images">
                                    </a>
                                </div>
                                <div class="content">
                                    <h6 class="title"><a href="blog-details.html">Gallaudet University innovation in
                                            education</a></h6>
                                    <div class="axil-post-meta">
                                        <div class="post-meta-content">
                                            <ul class="post-meta-list">
                                                <li>Mar 15, 2022</li>
                                                <li>300k Views</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Post List  -->

                        </div>
                        <!-- End Single Widget  -->
                        <!-- Start Single Widget  -->
                        <div class="axil-single-widget mt--40">
                            <h6 class="widget-title">Recent Viewed Products</h6>
                            <ul class="product_list_widget recent-viewed-product">
                                <!-- Start Single product_list  -->
                                <li>
                                    <div class="thumbnail">
                                        <a href="blog-details.html">
                                            <img src="assets/images/product/product-12.jpg" alt="Blog Images">
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h6 class="title"><a href="blog-details.html">Men's Fashion Tshirt</a></h6>
                                        <div class="product-meta-content">
                                                    <span class="woocommerce-Price-amount amount">
                            <del>$30</del>
                            $20
                        </span>
                                        </div>
                                    </div>
                                </li>
                                <!-- End Single product_list  -->
                                <!-- Start Single product_list  -->
                                <li>
                                    <div class="thumbnail">
                                        <a href="blog-details.html">
                                            <img src="assets/images/product/product-10.jpg" alt="Blog Images">
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h6 class="title"><a href="blog-details.html">Nike Shoes</a></h6>
                                        <div class="product-meta-content">
                                                    <span class="woocommerce-Price-amount amount">
                            <del>$200</del>
                            $150
                        </span>
                                        </div>
                                    </div>
                                </li>
                                <!-- End Single product_list  -->
                                <!-- Start Single product_list  -->
                                <li>
                                    <div class="thumbnail">
                                        <a href="blog-details.html">
                                            <img src="assets/images/product/product-11.jpg" alt="Blog Images">
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h6 class="title"><a href="blog-details.html">Addidas Shoes</a></h6>
                                        <div class="product-meta-content">
                                                    <span class="woocommerce-Price-amount amount">
                            <del>$300</del>
                            $200
                        </span>
                                        </div>
                                    </div>
                                </li>
                                <!-- End Single product_list  -->
                            </ul>

                        </div>
                        <!-- End Single Widget  -->

                        <!-- Start Single Widget  -->
                        <div class="axil-single-widget mt--40 widget_search">
                            <h6 class="widget-title">Search</h6>
                            <form class="blog-search" action="#">
                                <button class="search-button"><i class="fal fa-search"></i></button>
                                <input type="text" placeholder="Search">
                            </form>
                        </div>
                        <!-- End Single Widget  -->

                        <!-- Start Single Widget  -->
                        <div class="axil-single-widget mt--40 widget_archive">
                            <h6 class="widget-title">Archives List</h6>
                            <ul>
                                <li><a href="#">January 2020</a></li>
                                <li><a href="#">February 2020</a></li>
                                <li><a href="#">March 2020</a></li>
                                <li><a href="#">April 2020</a></li>
                            </ul>
                        </div>
                        <!-- End Single Widget  -->

                        <!-- Start Single Widget  -->
                        <div class="axil-single-widget mt--40 widget_archive_dropdown">
                            <h6 class="widget-title">Archives Dropdown</h6>
                            <select>
                                <option>Select Month</option>
                                <option>April 2020 (4)</option>
                                <option>May 2020 (4)</option>
                                <option>June 2020 (4)</option>
                                <option>July 2020 (4)</option>
                            </select>
                        </div>
                        <!-- End Single Widget  -->

                        <!-- Start Single Widget  -->
                        <div class="axil-single-widget mt--40 widget_tag_cloud">
                            <h6 class="widget-title">Tags</h6>
                            <div class="tagcloud">
                                <a href="#">Design</a>
                                <a href="#">HTML</a>
                                <a href="#">Graphic</a>
                                <a href="#">Development</a>
                                <a href="#">UI/UX Design</a>
                                <a href="#">eCommerce</a>
                                <a href="#">CSS</a>
                                <a href="#">JS</a>
                            </div>
                        </div>
                        <!-- End Single Widget  -->

                    </aside>
                    <!-- End Sidebar Area -->
                </div>
            </div>
        </div>
    </div>
</div>