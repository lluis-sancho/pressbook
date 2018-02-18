<?php
/* Template Name: Blog */
global $novela_data;
get_header();
?>
<section class="blog-page page-section">

   <h1 class="section-heading"><?php the_title(); ?></h1>

   <div class="blog-page-content">
       <?php the_content(); ?>
   </div>

    <?php

    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'paged' => get_query_var( 'paged' )
    );
    $posts_query = new WP_Query($args);

    if( $posts_query->have_posts() ) : ?>

    <div class="blog-posts" data-cols="2">

        <?php while( $posts_query->have_posts() ) : $posts_query->the_post() ?>

        <div <?php post_class('blog-item'); ?>>

            <a href="<?php the_permalink(); ?>">
                <div class="entry-thumbnail">
                    <div class="hover-mask"></div>
                    <?php the_post_thumbnail('blog-thumb'); ?>
                </div><!-- end post-thumb -->
            </a>

            <div class="entry-information">
                <header class="entry-header">
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                </header>
                <div class="entry-meta">
                    <?php
                    $terms = wp_get_post_terms( $post->ID, 'category' );
                    $terms_html_array = array();

                    foreach($terms as $term) {
                        $term_name = $term->name;
                        $term_link = get_term_link( $term->slug, $term->taxonomy );
                        array_push($terms_html_array, "<a href={$term_link} class='italics' >{$term_name}</a>");
                    }

                    $terms_string = implode(', ',$terms_html_array);
                    ?>
                    <i class="fa fa-folder-o"></i><?php echo $terms_string; ?>
                    <?php
                    $archive_year  = get_the_time('Y');
                    $archive_month = get_the_time('m');
                    ?>
                    <i class="fa fa-calendar-o"></i><a href="<?php echo get_month_link( $archive_year, $archive_month); ?>" class="italics"><?php the_time('d M y') ?></a>
                </div>
            </div><!-- end entry-information -->

        </div><!-- end blog-item -->

    <?php endwhile; else : ?>

    <div class="additional-content">
        <h3><?php _e('Sorry, no posts found.', 'novela'); ?></h3>
    </div>

    <?php endif; ?>

    </div><!-- end blog-posts -->

    <div class="blog-nav">
        <span class="nav-prev"><?php next_posts_link(__('Previous', 'novela')); ?></span>
        <span class="nav-next"><?php previous_posts_link(__('Next','novela')); ?></span>
    </div>

</section><!-- end blog-information -->

<?php get_footer(); ?>