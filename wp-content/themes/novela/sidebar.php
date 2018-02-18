<?php if ( is_active_sidebar( 'footer' ) ) : ?>

    <div class="footer-widgets container">
        <div class="row">
           <?php dynamic_sidebar( 'footer' ); ?>
        </div>
    </div><!-- end footer-widgets -->

<?php endif; ?>