<?php

?>

<div class="home-hero axil-main-slider-area main-slider-style-7"
     style="background-image: url('<?php echo wp_get_attachment_image_url(get_sub_field('home_hero_bg')['ID'],'hero');?>');">
    <div class="container">
        <div class="row align-items-center text-center">
            <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                <div class="main-slider-content">
                    <span class="subtitle d-inline-block">
                        <i class="fas fa-<?php echo get_sub_field('surtitre_icon');?>"></i>
                        <?php echo get_sub_field('surtitre');?>
                    </span>
                    <h1 class="title w-100 h2"><?php echo get_sub_field('title');?></h1>
                        <div id="autocomplete"></div>
                    <p class="tagline"><?php echo get_sub_field('tagline');?></p>
                </div>
            </div>
        </div>
    </div>
</div>