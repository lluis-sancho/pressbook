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
            </div><!-- end post-meta -->
        </div>

    </div><!-- end header -->

    <div class="post-content">

        <div class="container">
            <div class="row">
                <div class="product-content col-sm-7">

                    <?php the_content(); ?>
                    <?php sdesigns_wp_link_pages(); ?>

                    <?php
                    if ( has_tag() ): ?>
                    <div class="post-tags">
                        <?php the_tags('',''); ?>
                    </div><!-- end post-tags -->
                    <?php endif; ?>
                </div>
                <div class="product-info col-sm-4">
                    <div class="book-cover jelly-bounce read-book-button">
                        <div class="read-book-mask">
                            <span class="read-book-head">Read the Book</span>
                        </div>
                        <?php
                        $image = sdesigns_get_field('book_cover');
                        if ( $image ) {
                        	echo  wp_get_attachment_image( $image['id'], 'book-cover' );
                        }
                        ?>
                    </div>

                    <div class="book-details">
                        <?php echo wp_kses_post(sdesigns_get_field('book_details')); ?>
                    </div>
                    <div class="buy-book-wrapper">
                       <?php 
                        $buy_text = wp_kses_post(sdesigns_get_field('button_text'));

                        if ( ! get_post_meta( $post->ID, '_edd_hide_purchase_link', true ) ) {

                             echo edd_get_purchase_link(array(
                                 'download_id' => $post->ID,
                                 'text' => $buy_text,
                                 'class' => 'button dotted-button'
                             ));

                        }
                        ?>
                    </div>

                </div>
            </div><!-- end row -->
        </div><!-- end container -->

    </div><!-- end post-content -->


 </div><!-- end single-post-page -->

<?php endwhile; endif; ?>

<?php get_footer(); ?>
