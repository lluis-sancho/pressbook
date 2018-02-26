
		<?php if ( have_posts() ) { while ( have_posts() ) : the_post(); ?>
		<?php get_header(); ?>
		<?php if ( pb_is_public() ) : ?>
			    		<!-- PASAR A LA TEMPLATE EL POST DEL BUCLE-->
			    		<!-- set_query_var( 'page', $page );
				    echo "hola";
				    get_template_part( 'item_book'); -->
<div class="bb-custom-wrapper" style="width: 1276px; height: 360px;">
	<div id="bb-bookblock" class="bb-bookblock" style="perspective: 2000px; width: 1276px; height: 360px;">
		<nav>
		<span id="bb-nav-prev" style="display: block;">←</span>
		<span id="bb-nav-next" style="display: block;">→</span>
	</nav>

	<span id="tblcontents" class="menu-button">Table of Contents</span>

<!-- 	<span class="bb-nav-close"><i class="fa fa-times"></i></span>
 -->
			<?php
				$book_structure = pb_get_book_structure();
				// echo pb_get_book_information()["pb_book_color"];
				foreach ( $book_structure["front-matter"] as $page )
				{ 
					set_query_var( 'page', $page );
					get_template_part( 'new_item');
				} ?> <!-- foreach -->
				<?php 
				#foreach ( $book_structure["chapters"] as $page )
				#{ 
				#  set_query_var( 'page', $page );
				#	get_template_part( 'new_item');  
				#} ?> <!-- foreach -->
				<?php 
				foreach ( $book_structure["part"] as $part )
				{ 
						set_query_var( 'page', $part );
						get_template_part( 'new_item');  
					foreach ( $part["chapters"] as $page )
					{
						set_query_var( 'page', $page );
						get_template_part( 'new_item');  

					}
				} ?> <!-- foreach -->
				<?php 
				foreach ( $book_structure["back-matter"] as $page )
				{
					set_query_var( 'page', $page );
					get_template_part( 'new_item');    
				} ?> <!-- foreach -->
						
</div><!-- #bb-bookblock -->
</div><!-- #bb-custom-wrapper -->
<script>
	(function( $ ) {
    // Add Color Picker to all inputs that have 'color-field' class
    $(function() {
    	console.log("change color");
			$('.nav-container nav').css('background', "<?php echo pb_get_book_information()["pb_book_color"] ?>");

    });
     
})( jQuery );
</script>

		</div><!-- #content -->
				<?php
				if ( pb_social_media_enabled() ) {
					#get_template_part( 'content', 'social-footer' );
				} ?>
				

				<?php comments_template( '', true ); ?>
<?php else : ?>
<?php pb_private(); ?>
<?php endif; ?>
<?php get_footer(); ?>
<?php endwhile;
};?>

