<?php
/**
 * This class has two purposes:
 *  + Handle the custom metadata post, i.e. "Book Information". There should only be one metadata post per book.
 *  + Perform upgrades on individual books as Pressbooks evolves.
 *
 * @author  Pressbooks <code@pressbooks.com>
 * @license GPLv2 (or any later version)
 */

namespace Pressbooks;

class Metadata implements \JsonSerializable {

	/**
	 * The value for option: pressbooks_metadata_version
	 *
	 * @see upgrade()
	 * @var int
	 */
	const VERSION = 12;


	/**
	 * Deprecated meta keys represented by checkboxes in the GUI.
	 * We need to upgrade these for compatibility with custom_metdata().
	 *
	 * @var array
	 */
	public $upgradeCheckboxes = [
		'chapter-export' => 1,
		'front-matter-export' => 1,
		'back-matter-export' => 1,
		'show-title' => 1,
	];


	function __construct() {
	}


	/**
	 * Returns the latest "metadata" post. There should be only one per book.
	 *
	 * @return \WP_Post|bool
	 */
	function getMetaPost() {

		$args = [
			'post_type' => 'metadata',
			'posts_per_page' => 1,
			'post_status' => 'publish',
			'orderby' => 'modified',
			'no_found_rows' => true,
			'cache_results' => true,
		];

		$q = new \WP_Query();
		$results = $q->query( $args );

		if ( empty( $results ) ) {
			return false;
		}

		return $results[0];
	}


	/**
	 * Return metadata attached to the latest "metadata" post.
	 *
	 * @return array
	 */
	function getMetaPostMetadata() {

		$meta_post = $this->getMetaPost();

		if ( ! $meta_post ) {
			return [];
		}

		return get_post_meta( $meta_post->ID );
	}


	/**
	 * Return a database ID for a given meta key.
	 *
	 * @param int $post_id
	 * @param string $meta_key
	 *
	 * @return int|bool
	 */
	function getMidByKey( $post_id, $meta_key ) {

		/** @var \wpdb $wpdb */
		global $wpdb;
		$mid = $wpdb->get_var( $wpdb->prepare( "SELECT meta_id FROM $wpdb->postmeta WHERE post_id = %d AND meta_key = %s LIMIT 1 ", $post_id, $meta_key ) );
		if ( ! empty( $mid ) ) {
			return absint( $mid );
		}

		return false;
	}

	/**
	 * Returns a JSON object of the book information which can be posted to an API.
	 *
	 * @since 4.0.0
	 *
	 * @return array
	 */
	public function jsonSerialize() {

		$request = new \WP_REST_Request( 'GET', '/pressbooks/v2/metadata' );
		$meta = new \Pressbooks\Api\Endpoints\Controller\Metadata();
		$metadata = $meta
			->get_item( $request )
			->get_data();

		return apply_filters( 'pb_json_metadata', $metadata );
	}

	// ----------------------------------------------------------------------------------------------------------------
	// Upgrades
	// ----------------------------------------------------------------------------------------------------------------

	/**
	 * Upgrade metadata.
	 *
	 * @param int $version
	 */
	function upgrade( $version ) {

		if ( $version < 1 ) {
			// Upgrade from version 0 (closed source service) to version 1 (initial open source offering)
			$this->upgradeEcommerce();
			$this->upgradeBookInformation();
			$this->upgradeBook();
		}
		if ( $version < 3 ) {
			\Pressbooks\CustomCss::upgradeCustomCss();
		}
		if ( $version < 4 ) {
			$this->fixDoubleSlashBug();
		}
		if ( $version < 5 ) {
			$this->changeDefaultBookCover();
			$this->changeDefaultFrontCover();
		}
		if ( $version < 6 || $version < 7 ) {
			$this->makeThumbnailsForBookCover();
			$this->makeThumbnailsForFrontCover();
		}
		if ( $version < 8 ) {
			$this->resetLandingPage();
		}
		if ( $version < 10 ) {
			\Pressbooks\Taxonomy::insertTerms();
			flush_rewrite_rules( false );
		}
		if ( $version < 11 ) {
			$this->migratePartContentToEditor();
		}
		if ( $version < 12 ) {
			Container::get( 'Styles' )->initPosts();
		}
	}


	/**
	 * Upgrade Ecommerce metadata
	 */
	function upgradeEcommerce() {

		$options = get_option( 'ecomm-url' );
		$compare = $this->getDeprecatedComparisonTable( 'ecommerce' );
		$new_options = [];

		if ( $options ) {
			foreach ( $options as $meta_key => $meta_value ) {
				$new_meta_key = ( isset( $compare[ $meta_key ] ) ) ? $compare[ $meta_key ] : false;
				if ( $new_meta_key ) {
					$new_options[ $new_meta_key ] = $meta_value;
				}
			}
		}

		update_option( 'pressbooks_ecommerce_links', $new_options );
		delete_option( 'ecomm-url' );
	}


	/**
	 * Upgrade book information.
	 */
	function upgradeBookInformation() {

		// Metadata

		$meta_post = $this->getMetaPost();
		if ( ! $meta_post ) {
			return; // Do nothing
		}

		$metadata = $this->getMetaPostMetadata();
		$compare = $this->getDeprecatedComparisonTable( 'metadata' );

		foreach ( $metadata as $meta_key => $meta_value ) {
			$new_meta_key = ( isset( $compare[ $meta_key ] ) ) ? $compare[ $meta_key ] : false;
			if ( $new_meta_key ) {
				$meta_id = $this->getMidByKey( $meta_post->ID, $meta_key );
				if ( $meta_id ) {
					if ( isset( $this->upgradeCheckboxes[ $meta_key ] ) ) {
						$meta_value = 'on';
					} elseif ( is_array( $meta_value ) ) {
						$meta_value = array_values( $meta_value );
						$meta_value = array_pop( $meta_value );
					}

					// Overrides
					if ( 'pb_language' === $new_meta_key ) {
						$meta_value = substr( strtolower( $meta_value ), 0, 2 );
					}
					if ( 'pb_publication_date' === $new_meta_key ) {
						$meta_value = strtotime( $meta_value );
					}

					// Update the original $meta_key to the $new_meta_key
					update_metadata_by_mid( 'post', $meta_id, $meta_value, $new_meta_key );
				}
			}
		}
		// Force title change
		update_metadata( 'post', $meta_post->ID, 'pb_title', get_bloginfo( 'name' ) );
	}


	/**
	 * Upgrade book metadata.
	 */
	function upgradeBook() {

		$book_structure = Book::getBookStructure();
		foreach ( $book_structure['__order'] as $post_id => $_ ) {

			$meta = get_post_meta( $post_id );
			$compare = $this->getDeprecatedComparisonTable( get_post_type( $post_id ) );

			foreach ( $meta as $meta_key => $meta_value ) {
				$new_meta_key = ( isset( $compare[ $meta_key ] ) ) ? $compare[ $meta_key ] : false;
				if ( $new_meta_key ) {
					$meta_id = $this->getMidByKey( $post_id, $meta_key );
					if ( $meta_id ) {
						if ( isset( $this->upgradeCheckboxes[ $meta_key ] ) ) {
							$meta_value = 'on';
						} elseif ( is_array( $meta_value ) ) {
							$meta_value = array_values( $meta_value );
							$meta_value = array_pop( $meta_value );
						}
						// Update the original $meta_key to the $new_meta_key
						update_metadata_by_mid( 'post', $meta_id, $meta_value, $new_meta_key );
					}
				}
			}
		}

	}


	/**
	 * @deprecated
	 *
	 * @param string $table
	 * @param bool $new_as_keys
	 *
	 * @return array
	 */
	function getDeprecatedComparisonTable( $table, $new_as_keys = false ) {
		if ( 'chapter' === $table ) {
			// Chapter
			$metadata = [
				'short-title' => 'pb_short_title',
				'subtitle' => 'pb_subtitle',
				'chap_author' => 'pb_section_author',
				'chapter-export' => 'pb_export',
				'show-title' => 'pb_show_title',
			];
		} elseif ( 'front-matter' === $table ) {
			// Front Matter
			$metadata = [
				'short-title' => 'pb_short_title',
				'subtitle' => 'pb_subtitle',
				'chap_author' => 'pb_section_author',
				'front-matter-export' => 'pb_export',
				'show-title' => 'pb_show_title',
			];
		} elseif ( 'back-matter' === $table ) {
			// Back Matter
			$metadata = [
				'back-matter-export' => 'pb_export',
				'show-title' => 'pb_show_title',
			];
		} elseif ( 'ecommerce' === $table ) {
			// Ecommerce
			$metadata = [
				'url1' => 'amazon',
				'url2' => 'oreilly',
				'url3' => 'barnesandnoble',
				'url4' => 'kobo',
				'url5' => 'ibooks',
				'url6' => 'otherservice',
			];
		} elseif ( 'metadata' === $table ) {
			// Book Information
			$metadata = [
				'Title' => 'pb_title',
				'Short Title' => 'pb_short_title',
				'Subtitle' => 'pb_subtitle',
				'Author' => 'pb_author',
				'Author, file as' => 'pb_author_file_as',
				'Publisher' => 'pb_publisher',
				'Book Color' => 'pb_book_color',
				'Dossier' => 'pb_dossier',
				'Publication Date' => 'pb_publication_date',
				'Publisher City' => 'pb_publisher_city',
				'Cover Image' => 'pb_cover_image',
				'Web Image' => 'pb_front_image',
				'Copyright Year' => 'pb_copyright_year',
				'Copyright Holder' => 'pb_copyright_holder',
				'Copyright Extra Info' => 'pb_custom_copyright',
				'About (140 characters)' => 'pb_about_140',
				'About (50 words)' => 'pb_about_50',
				'About (Unlimited)' => 'pb_about_unlimited',
				'Series Title' => 'pb_series_title',
				'Series Number' => 'pb_series_number',
				'Editor' => 'pb_editor',
				'Translator' => 'pb_translator',
				'Keywords/Tags' => 'pb_keywords_tags',
				'Hashtag' => 'pb_hashtag',
				'Print ISBN' => 'pb_print_isbn',
				'Ebook ISBN' => 'pb_ebook_isbn',
				'Language' => 'pb_language',
				'List Price (Print)' => 'pb_list_price_print',
				'List Price (PDF)' => 'pb_list_price_pdf',
				'List Price (ePub)' => 'pb_list_price_epub',
				'List Price (Web)' => 'pb_list_price_web',
				'Bisac Subject 1' => 'pb_bisac_subject',
				'Bisac Regional Theme' => 'pb_bisac_regional_theme',
				'catalogue_order' => 'pb_catalogue_order',
			];
		} else {
			$metadata = [];
		}

		if ( $new_as_keys ) {
			$metadata = array_flip( $metadata );
		}

		return $metadata;
	}

	/**
	 * Fix a double slash bug by reactivating theme with new settings.
	 *
	 * @see \Pressbooks\Pressbooks::registerThemeDirectories
	 */
	function fixDoubleSlashBug() {

		$theme = wp_get_theme();
		if ( ! $theme->exists() || ! $theme->is_allowed() ) {
			return; // Do nothing
		} else {
			switch_theme( $theme->get_stylesheet() );
		}
	}


	/**
	 * Change default book cover from PNG to JPG
	 */
	function changeDefaultBookCover() {

		$post = $this->getMetaPost();

		if ( $post ) {
			$pb_cover_image = get_post_meta( $post->ID, 'pb_cover_image', true );
			if ( preg_match( '~assets/images/default-book-cover\.png$~', $pb_cover_image ) ) {
				update_post_meta( $post->ID, 'pb_cover_image', \Pressbooks\Image\default_cover_url() );
				Book::deleteBookObjectCache();
			}
		}
	}

	/**
	 * Change default book cover from PNG to JPG
	 */
	function changeDefaultFrontCover() {

		$post = $this->getMetaPost();

		if ( $post ) {
			$pb_front_image = get_post_meta( $post->ID, 'pb_front_image', true );
			if ( preg_match( '~assets/images/default-book-cover\.png$~', $pb_front_image ) ) {
				update_post_meta( $post->ID, 'pb_front_image', \Pressbooks\Image\default_cover_url() );
				Book::deleteBookObjectCache();
			}
		}
	}

	/**
	 * Generate thumbnails for a user uploaded cover
	 */
	function makeThumbnailsForBookCover() {

		$post = $this->getMetaPost();
		if ( $post ) {

			$pb_cover_image = get_post_meta( $post->ID, 'pb_cover_image', true );
			if ( $pb_cover_image && ! preg_match( '~assets/dist/images/default-book-cover\.jpg$~', $pb_cover_image ) ) {

				$path = \Pressbooks\Utility\get_media_path( $pb_cover_image );
				$type = wp_check_filetype( $path );
				$type = $type['type'];

				// Insert new image, create thumbnails
				$args = [
					'post_mime_type' => $type,
					'post_title' => __( 'Cover Image', 'pressbooks' ),
					'post_content' => '',
					'post_status' => 'inherit',
				];

				include_once( ABSPATH . 'wp-admin/includes/image.php' );
				$id = wp_insert_attachment( $args, $path, $post->ID );
				wp_update_attachment_metadata( $id, wp_generate_attachment_metadata( $id, $path ) );
				Book::deleteBookObjectCache();
			}
		}
	}


	/**
	 * Generate thumbnails for a user uploaded cover
	 */
	function makeThumbnailsForFrontCover() {

		$post = $this->getMetaPost();
		if ( $post ) {

			$pb_front_image = get_post_meta( $post->ID, 'pb_front_image', true );
			if ( $pb_front_image && ! preg_match( '~assets/dist/images/default-book-cover\.jpg$~', $pb_front_image ) ) {

				$path = \Pressbooks\Utility\get_media_path( $pb_front_image );
				$type = wp_check_filetype( $path );
				$type = $type['type'];

				// Insert new image, create thumbnails
				$args = [
					'post_mime_type' => $type,
					'post_title' => __( 'Cover Image', 'pressbooks' ),
					'post_content' => '',
					'post_status' => 'inherit',
				];

				include_once( ABSPATH . 'wp-admin/includes/image.php' );
				$id = wp_insert_attachment( $args, $path, $post->ID );
				wp_update_attachment_metadata( $id, wp_generate_attachment_metadata( $id, $path ) );
				Book::deleteBookObjectCache();
			}
		}
	}

	/**
	 * Fix broken landing page
	 */
	function resetLandingPage() {

		/** @var $wpdb \wpdb */
		global $wpdb;

		update_option( 'show_on_front', 'page' );

		$id = $wpdb->get_var( "SELECT ID FROM {$wpdb->posts} WHERE post_name = 'cover' AND post_type = 'page' AND post_status = 'publish' " );
		if ( $id ) {
			update_option( 'page_on_front', $id );
		}

		$id = $wpdb->get_var( "SELECT ID FROM {$wpdb->posts} WHERE post_name = 'table-of-contents' AND post_type = 'page' AND post_status = 'publish' " );
		if ( $id ) {
			update_option( 'page_for_posts', $id );
		}
	}


	/**
	 * Migrate part content to content editor
	 */
	function migratePartContentToEditor() {

		/** @var $wpdb \wpdb */
		global $wpdb;

		$parts = $wpdb->get_results( "SELECT ID FROM {$wpdb->posts} WHERE post_type = 'part' AND post_status = 'publish' " );
		foreach ( $parts as $part ) {
			$pb_part_content = trim( get_post_meta( $part->ID, 'pb_part_content', true ) );
			if ( $pb_part_content ) {
				$success = wp_update_post( [
					'ID' => $part->ID,
					'post_content' => $pb_part_content,
					'comment_status' => 'closed',
				] );
				if ( $success === $part->ID ) {
					delete_post_meta( $part->ID, 'pb_part_content' );
				}
			}
		}

		Book::deleteBookObjectCache();
	}

}
