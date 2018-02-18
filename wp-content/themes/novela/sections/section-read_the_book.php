<section class="book-information block-section" id="<?php echo esc_attr(sdesigns_get_sub_field('navigation_menu_anchor')); ?>" >
    <div class="book-information-inner">
        <?php sdesigns_the_sub_field('book_information'); ?>
    </div><!-- end book-information-inner -->

    <div class="book-read" style="background-image: url('<?php sdesigns_the_sub_field('read_the_book_background_image'); ?>');">
        <div class="gradient-mask"></div>
        <div class="book-read-inner">
            <?php sdesigns_the_sub_field('read_the_book_text'); ?>
        </div><!-- end book-read-inner -->
    </div><!-- end book-read -->
</section><!-- end book-information -->