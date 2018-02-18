<?php
global $redux_data;
get_header();
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div <?php post_class('single-post-page'); ?>>

    <?php
    $thumb_id = get_post_thumbnail_id();
    $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'single-blog-header', true);
    $thumb_url = $thumb_url_array[0];
    ?>

    <div class="single-blog-post-header" style="background-image: url(<?php echo esc_url($thumb_url); ?>);">
        <div class="single-blog-mask"></div>

        <div class="headline container col-sm-7">
            <h1><?php the_title(); ?></h1>
            <div class="post-meta">
                <?php
                $archive_year  = get_the_time('Y');
                $archive_month = get_the_time('m');
                if ( has_category() ) :
                ?>
                <i class="fa fa-folder-o"></i><a href="#" rel="tag"><?php the_category(', '); ?></a>
                <?php endif; ?>
                <i class="fa fa-calendar-o"></i><span class="post-meta-date"><a href="<?php echo get_month_link( $archive_year, $archive_month); ?>"><?php the_time('d M y') ?></a></span>
            </div><!-- end post-meta -->
        </div>

    </div><!-- end header -->

    <div class="single-blog-container col-sm-7">

        <div class="post-content">
            <?php the_content(); ?>
        </div><!-- end post-content -->

        <?php sdesigns_wp_link_pages(); ?>

        <?php
        if ( has_tag() ): ?>
        <div class="post-tags">
            <?php the_tags('',''); ?>
        </div><!-- end post-tags -->
        <?php endif; ?>

        <?php if ( comments_open() || get_comments_number() ) : ?>
        <div class="comments-container">
            <?php comments_template( '', true ); ?>
        </div>
        <?php endif; ?>

    </div><!-- end blog-post -->

 </div><!-- end single-post-page -->

<?php endwhile; endif; ?>

<?php get_footer(); ?>