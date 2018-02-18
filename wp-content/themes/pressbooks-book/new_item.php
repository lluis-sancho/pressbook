<?php
$first = false;
if( !defined('FIRST_RENDERED') ){
    $first = true;
    define('FIRST_RENDERED', TRUE);
}
?>
<div class="bb-item" id="item<?php echo $page["ID"];	 ?>" style="display: <?php echo $first ? 'block' : 'none'; ?>;">
				<div class="book-content jspScrollable" tabindex="0" style="overflow: hidden; padding: 0px; width: 1276px; outline: none;">
					
					<div class="jspContainer" style="width: 1276px; height: 250px;">
							<div class="jspPane" style="padding: 0px; width: 1267px; top: -144px;">
								<div class="scroller">

    <?php edit_post_link( __( 'Edit', 'pressbooks-book' ), '<span class="edit-link">', '</span>',$page["ID"]  ); ?>
		<?php
		// add part title to chapters
		$web_options = get_option( 'pressbooks_theme_options_web' );
		if ( isset( $web_options['part_title'] ) && absint( $web_options['part_title'] ) === 1 ) {
			if ( 'chapter' === get_post_type( $page["ID"] ) ) {
				$part_title = get_post_field( 'post_title', $page["post_parent"] );
				if ( ! is_wp_error( $part_title ) ) {
					echo "<div class='part-title'><small>" . $part_title . '</small></div>';
				}
			}
		}
		?>
	<h1 class="chapter-heading"><?php
	$chapter_number = pb_get_chapter_number( $page["post_name"] );
	if ( $chapter_number ) {
		echo "<span>$chapter_number</span>  ";
	}
		#the_title();
		echo $page["post_name"]
		?></h1>
			<?php pb_get_links(); ?>
		<!--<div id="post-<?php the_ID(); ?>" <?php post_class( pb_get_section_type( $page ) ); ?>> -->

			<!-- <div class="entry-content"> -->
				
				<?php $subtitle = get_post_meta( $page["ID"], 'pb_subtitle', true );
				if ( $subtitle ) : ?>
				<h2 class="chapter_subtitle"><?php echo $subtitle; ?></h2>
			<?php endif;?>
			<?php $chap_author = get_post_meta( $page["ID"], 'pb_section_author', true );
			if ( $chap_author ) : ?>
			   <h2 class="chapter_author"><?php echo $chap_author; ?></h2>
			<?php endif; ?>
			<?php
					$content_post = get_post($page["ID"]);
					$content = $content_post->post_content;

			?>
			<?php if ( get_post_type( $page["ID"] ) !== 'part' ) {
				if ( pb_should_parse_subsections() ) {
					$content = pb_tag_subsections( apply_filters( 'the_content', $content ), $page["ID"] );
					echo $content;
				} else {
					$content = apply_filters( 'the_content', $content );
					echo $content;
				}
				global $multipage;
				if ( $multipage ) {
					$args = [ 'before' => '<p class="pb-nextpage">' . __( 'Continue reading:', 'pressbooks' ) ];
					wp_link_pages( $args );
				}
	} else {
		echo apply_filters( 'the_content', $content);
	} ?>

	<!--</div> .entry-content -->
<!--</div> #post-## -->
<hr>
</div>
</div>
						<div class="jspVerticalBar">
							<div class="jspCap jspCapTop"></div>
								<div class="jspTrack" style="height: 170px;">
									<div class="jspDrag" style="height: 51px; top: 27.5261px;">
										<div class="jspDragTop"></div>
										<div class="jspDragBottom"></div>
									</div>
								</div>
							<div class="jspCap jspCapBottom"></div>
						</div>
				</div>
			</div>
		</div><!-- end bb-item -->