<?php
global $novela_data;
?>
</div><!--end main-content-->
<div class="footer-section">
<div class="widgets-container">
    <?php get_sidebar(); ?>
</div>
<div class="social-container">
    <?php if( !empty( $novela_data['facebook']) ) : ?>
        <a href="<?php echo esc_url($novela_data['facebook']); ?>"><i class="fa fa-facebook"></i></a>
    <?php endif; ?>
    <?php if( !empty( $novela_data['twitter']) ) : ?>
        <a href="<?php echo esc_url($novela_data['twitter']); ?>"><i class="fa fa-twitter"></i></a>
    <?php endif; ?>
    <?php if( !empty( $novela_data['behance']) ) : ?>
        <a href="<?php echo esc_url($novela_data['behance']); ?>"><i class="fa fa-behance"></i></a>
    <?php endif; ?>
    <?php if( !empty( $novela_data['dribbble']) ) : ?>
        <a href="<?php echo esc_url($novela_data['dribbble']); ?>"><i class="fa fa-dribbble"></i></a>
    <?php endif; ?>
    <?php if( !empty( $novela_data['pinterest']) ) : ?>
        <a href="<?php echo esc_url($novela_data['pinterest']); ?>"><i class="fa fa-pinterest"></i></a>
    <?php endif; ?>
    <?php if( !empty( $novela_data['instagram']) ) : ?>
        <a href="<?php echo esc_url($novela_data['instagram']); ?>"><i class="fa fa-instagram"></i></a>
    <?php endif; ?>
    <?php if( !empty( $novela_data['deviantart']) ) : ?>
        <a href="<?php echo esc_url($novela_data['deviantart']); ?>"><i class="fa fa-deviantart"></i></a>
    <?php endif; ?>
    <?php if( !empty( $novela_data['google']) ) : ?>
        <a href="<?php echo esc_url($novela_data['google']); ?>"><i class="fa fa-google"></i></a>
    <?php endif; ?>
    <?php if( !empty( $novela_data['linkedin']) ) : ?>
        <a href="<?php echo esc_url($novela_data['linkedin']); ?>"><i class="fa fa-linkedin"></i></a>
    <?php endif; ?>
    <?php if( !empty( $novela_data['flickr']) ) : ?>
        <a href="<?php echo esc_url($novela_data['flickr']); ?>"><i class="fa fa-flickr"></i></a>
    <?php endif; ?>
    <?php if( !empty( $novela_data['youtube']) ) : ?>
        <a href="<?php echo esc_url($novela_data['youtube']); ?>"><i class="fa fa-youtube"></i></a>
    <?php endif; ?>
    <?php if( !empty( $novela_data['vimeo-square']) ) : ?>
        <a href="<?php echo esc_url($novela_data['vimeo-square']); ?>"><i class="fa fa-vimeo-square"></i></a>
    <?php endif; ?>
</div>

<?php
if( !empty( $novela_data['footer-text']) ) : ?>
    <div class="copy">
        <?php echo wp_kses_post($novela_data['footer-text']); ?>
    </div>

<?php endif;?>
</div><!-- end footer-section -->
<?php
if( !empty( $novela_data['tracking-code']) ) {
  echo $novela_data['tracking-code'];
}
wp_footer() ;?>
</body>
</html>