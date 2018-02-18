<div class="hero" id="<?php echo esc_attr(sdesigns_get_sub_field('navigation_menu_anchor')); ?>" style="background-image: url('<?php sdesigns_the_sub_field('image'); ?>');">
<?php if( sdesigns_get_sub_field('hero-mask') ) : ?>
    <div class="hero-mask"></div>
<?php endif; ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="hero-content">
                    <?php sdesigns_the_sub_field('text'); ?>
                </div>

            </div>
            <div class="col-sm-6 hero-attachment">
                 <?php
                 $image = sdesigns_get_sub_field('book_image');
                 if ( !empty($image) ) {
                    echo wp_get_attachment_image( $image['id'], 'full' );
                 }
                 ?>
            </div>
        </div><!-- end row -->
    </div><!-- end container -->
</div><!-- end header -->