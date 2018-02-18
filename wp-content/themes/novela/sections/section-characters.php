<section class="characters-information block-section" id="<?php echo esc_attr(sdesigns_get_sub_field('navigation_menu_anchor')); ?>" >
	<div class="gradient-mask"></div>

	<h1 class="characters-heading"><?php echo wp_kses_post(sdesigns_get_sub_field('section_heading')); ?></h1>

	<?php if( sdesigns_have_rows('characters') ): ?>

		<div class="characters-information-inner">

			<div class="characters-owl">

				<?php
				while ( sdesigns_have_rows('characters') ) : the_row(); ?>

				<div class="character-slide" data-bg="<?php sdesigns_the_sub_field('background_image'); ?>">

				<?php if( sdesigns_get_sub_field('portrait') ) :?>
					<div class="character-image">
						<?php
						$image =  sdesigns_get_sub_field('portrait');
						echo wp_get_attachment_image( $image['id'], 'character-image' );
						?>
					</div><!-- end character-image -->
				<?php endif; ?>
				<div class="character-infobox">
					<h2 class="character-name"><?php echo wp_kses_post(sdesigns_get_sub_field('name')); ?></h2>
					<div class="character-description">
						<?php echo wp_kses_post(sdesigns_get_sub_field('description')); ?>
					</div><!-- end character-description -->
				</div>
			</div><!-- end character-slide -->

		<?php endwhile; ?>

	</div><!-- end characters-owl -->

</div><!-- end characters-information-inner -->

<?php endif; ?>

</section><!-- end characters-information -->

<script>

	jQuery(document).ready(function($) {

		"use strict";

/**
* Supersized.
*/
var bgArray = [];

$(".character-slide").each( function () {
	bgArray.push({
		image: $(this).data('bg')
	});
});

if ( bgArray.length != 0 ) {

	$.supersized({
		autoplay: false,
		transition: 1,
		transition_speed: 400,
		slide_links: 'blank',
		slides: bgArray
	});

	$('.owl-next').on('click', function(){
		api.nextSlide();
	})

}


})

</script>