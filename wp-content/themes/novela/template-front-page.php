<?php
/* Template Name: Front Page */
global $novela_data;
get_header();
?>

<?php
// check if the flexible content field has rows of data
if( sdesigns_have_rows('layout') ):

    while ( sdesigns_have_rows('layout') ) : the_row();
        get_template_part('sections/section', get_row_layout() );
    endwhile;

else :
    // no layouts found
endif;

?>

<?php if ( comments_open() || get_comments_number() ) : ?>
<div class="comments-container">
	<div class="container">
   		<?php comments_template( '', true ); ?>
	</div>
</div>
<?php endif; ?>

<?php get_footer(); ?>