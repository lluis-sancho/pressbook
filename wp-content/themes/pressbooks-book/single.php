
		<?php if ( have_posts() ) { while ( have_posts() ) : the_post(); ?>
		<?php get_header(); ?>
		<?php if ( pb_is_public() ) : ?>
			    		<!-- PASAR A LA TEMPLATE EL POST DEL BUCLE-->
			    		<!-- set_query_var( 'page', $page );
				    echo "hola";
				    get_template_part( 'item_book'); -->
			<?php
				$book_structure = pb_get_book_structure();
				#print_r($book_structure);
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
						


		</div><!-- #content -->
				<?php
				if ( pb_social_media_enabled() ) {
					get_template_part( 'content', 'social-footer' );
				} ?>
				

				<?php comments_template( '', true ); ?>
<?php else : ?>
<?php pb_private(); ?>
<?php endif; ?>
<?php get_footer(); ?>
<?php endwhile;
};?>
<script>

	</script>
