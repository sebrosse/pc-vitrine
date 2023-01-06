<?php get_header(); ?>
    <section class="error-page onepage-screen-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="content sal-animate" data-sal="slide-up" data-sal-duration="800" data-sal-delay="400">
                        <span class="title-highlighter highlighter-secondary"> <i class="fal fa-exclamation-circle"></i> Houston, on a un problème</span>
                        <h1 class="title">Page introuvable</h1>
                        <p>On dirait que la page que vous cherchez n'existe pas ou bien a été déplacée.</p>
                        <a href="index.html" class="axil-btn btn-bg-secondary right-icon">Retour à l'accueil <i class="fal fa-long-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="thumbnail sal-animate" data-sal="zoom-in" data-sal-duration="800" data-sal-delay="400">
                        <img src="<?php echo THEME_ROOT_URI.'/assets/images/404.png';?>" alt="404">
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php get_footer(); ?>