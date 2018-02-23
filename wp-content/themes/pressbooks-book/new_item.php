<?php
$first = false;
if( !defined('FIRST_RENDERED') ){
    $first = true;
    define('FIRST_RENDERED', TRUE);
}
?>
<div class="bb-item <?php echo get_the_ID() === $page["ID"] ? ' actived_manually' : '' ?>" id="item<?php echo $page["ID"];	 ?>" style="display: <?php  echo (get_the_ID() === $page["ID"] && !$first ? 'block' : 'none'); ?>;">
				<div class="book-content " tabindex="0">

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
			<?php# pb_get_links(); ?>
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
</div>
		</div><!-- end bb-item -->