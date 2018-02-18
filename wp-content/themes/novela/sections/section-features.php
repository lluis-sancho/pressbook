<section class="features-information block-section" id="<?php echo esc_attr(sdesigns_get_sub_field('navigation_menu_anchor')); ?>" >

	<h1 class="section-heading"><?php echo wp_kses_post(sdesigns_get_sub_field('section_heading')); ?></h1>

	<div class="container">
		<div class="row">

		<?php

		if( sdesigns_have_rows('book_features') ):

		    while ( sdesigns_have_rows('book_features') ) : the_row();

		    ?>

		    <div class="col-sm-4">
				<div class="iconbox">
					<?php sdesigns_the_sub_field('icon'); ?>
					<div class="iconbox-info">
						<h2><?php echo wp_kses_post(sdesigns_get_sub_field('title')); ?></h2>
						<div class="iconbox-description">
							<?php echo wp_kses_post(sdesigns_get_sub_field('description')); ?>
						</div>
					</div><!-- end iconbox-info -->
				</div><!-- end icon-box -->
			</div><!-- end col-sm-4 -->

	        <?php
		    endwhile;

		endif;
		?>

		</div><!-- end rows -->
	</div><!-- end container -->

</section><!-- end features-information -->