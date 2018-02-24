<?php
/**
 * Filter the WP_Site_Query args for the catalog display.
 *
 * @since 3.9.7
 */
$args = apply_filters( 'pb_publisher_catalog_query_args', array( 'public' => '1' ) );
$books = new WP_Site_Query( $args );
foreach ( $books->sites as $book ) {
	if ( get_blog_option( $book->blog_id, 'pressbooks_publisher_in_catalog' ) ) {
		switch_to_blog( $book->blog_id );
		$metadata = pb_get_book_information();
		restore_current_blog(); ?>

		<div class="col-md-3">
			<a href="//<?php echo $book->domain . $book->path; ?>" title="<?php echo $metadata['pb_title']; ?>">
				<img src="<?php echo $metadata['pb_cover_image']; ?>" class="img-responsive" alt="<?php echo $metadata['pb_title']; ?>" />
			</a>				
		</div>

<?php }
} ?>
</div>
