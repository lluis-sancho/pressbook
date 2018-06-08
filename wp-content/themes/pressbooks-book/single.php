
		<?php if ( have_posts() ) { while ( have_posts() ) : the_post(); ?>
		<?php get_header(); ?>
		<?php if ( pb_is_public() ) : ?>
			    		<!-- PASAR A LA TEMPLATE EL POST DEL BUCLE-->
			    		<!-- set_query_var( 'page', $page );
				    echo "hola";
				    get_template_part( 'item_book'); -->
<div class="bb-custom-wrapper" style="width: 1276px; height: 360px;">
	<!--<a id="bb-zoom-plus" onClick="" style="display: block;">A+</span>
	<a id="bb-zoom-minus" style="display: block;">A-</span>-->
	<div id="bb-bookblock" class="bb-bookblock" style="perspective: 2000px; width: 1276px; height: 360px;">
		<nav>
			<span id="bb-nav-prev" style="display: block;">←</span>
			<span id="bb-nav-next" style="display: block;">→</span>
		</nav>
		
		<span id="tblcontents" class="menu-button">Indice</span>

<!--<span class="bb-nav-close"><i class="fa fa-times"></i></span>-->
			<?php
				$book_structure = pb_get_book_structure();

				$pages = 1;
				// echo pb_get_book_information()["pb_book_color"];
				foreach ( $book_structure["front-matter"] as $page )
				{ 
					set_query_var( 'visible_post_name', true );
					set_query_var( 'page', $page );
					set_query_var( 'pages', $pages );

					get_template_part( 'new_item');

					$pages += 1;
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
					set_query_var( 'visible_post_name', true );
					set_query_var( 'page', $part );
					set_query_var( 'pages', $pages );

					get_template_part( 'new_item'); 
					$pages += 1; 
					foreach ( $part["chapters"] as $page )
					{
						set_query_var( 'visible_post_name', false );
						set_query_var( 'page', $page );
						set_query_var( 'pages', $pages );

						get_template_part( 'new_item');  
						$pages += 1; 
					}
				} ?> <!-- foreach -->
				<?php 
				foreach ( $book_structure["back-matter"] as $page )
				{
					set_query_var( 'visible_post_name', true );
					set_query_var( 'page', $page );
					get_template_part( 'new_item');    
				} ?> <!-- foreach -->
						
</div><!-- #bb-bookblock -->
</div><!-- #bb-custom-wrapper -->
<script>
	(function( $ ) {
    // Add Color Picker to all inputs that have 'color-field' class
    $(function() {
			$('.nav-container nav').css('background', "<?php echo pb_get_book_information()["pb_book_color"] ?>");
			$('#tblcontents, #bb-nav-next, #bb-nav-prev').css('color', "<?php echo pb_get_book_information()["pb_book_color"] ?>");
			$('#tblcontents, #bb-nav-next, #bb-nav-prev').css('border', "1px solid <?php echo pb_get_book_information()["pb_book_color"] ?>");
			
			$('#tblcontents:after').css('background', "1px solid <?php echo pb_get_book_information()["pb_book_color"] ?>");
			$('#tblcontents:after').css('box-shadow', "-4px 0 <?php echo pb_get_book_information()["pb_book_color"] ?>, 4px 0 <?php echo pb_get_book_information()["pb_book_color"] ?>");

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
<?php //get_footer(); ?>
<?php endwhile;
};?>

