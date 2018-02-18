<?php
global $redux_data;
get_header();
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<section class="page-section container">

<?php the_content(); ?>

<?php sdesigns_wp_link_pages(); ?>

<?php if ( comments_open() || get_comments_number() ) : ?>
<div class="comments-container">
	<div class="container">
   		<?php comments_template( '', true ); ?>
	</div>
</div>
<?php endif; ?>

</section>

<?php endwhile; endif; ?>

<?php get_footer(); ?>