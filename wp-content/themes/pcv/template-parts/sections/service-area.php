<?php

$services = get_sub_field( 'services' );

?>

<div class="service-area axil-section-gapcommon">
    <div class="container">
        <div class="row row-cols-xl-4 row-cols-sm-2 row-cols-1 row--20">
			<?php foreach ( $services as $service ) {?>
                <div class="col">
                    <div class="service-box service-style-2">
                        <div class="icon">
                            <img src="<?php echo $service['image']['url']; ?>" alt="<?php echo $service['image']['alt']; ?>">
                        </div>
                        <div class="content">
                            <h6 class="title"><?php echo $service['title']; ?></h6>
                            <p><?php echo $service['subtitle']; ?></p>
                        </div>
                    </div>
                </div>
			<?php } ?>
        </div>
    </div>
</div>