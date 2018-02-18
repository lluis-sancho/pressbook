<section class="author-information block-section" id="<?php echo esc_attr(sdesigns_get_sub_field('navigation_menu_anchor')); ?>" >

    <div class="author-photo" style="background-image: url('<?php sdesigns_the_sub_field('photo'); ?>');"></div>

    <div class="author-bio">
        <h1 class="author-name"><?php echo wp_kses_post(sdesigns_get_sub_field('name')); ?></h1>
        <div class="author-subtitle"><?php echo wp_kses_post(sdesigns_get_sub_field('tagline')); ?></div>
        <?php sdesigns_the_sub_field('bio'); ?>
    </div><!-- end author-bio -->

</section><!-- end author-information -->