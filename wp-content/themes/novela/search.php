<?php
get_header();
?>

<section class="search-section">

	<?php
	if( have_posts() ) : ?>

	<div class="additional-content">
		<h1><?php _e('Search Results for: ', 'novela') ?><span class="colored"><?php the_search_query(); ?></span></h1>
	</div>

	<div class="blog-posts" data-cols="3">

		<?php while( have_posts() ) : the_post() ?>

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

</section><!-- end blog-information -->

<?php get_footer(); ?>