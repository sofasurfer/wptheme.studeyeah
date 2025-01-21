<?php

// Namespace declaration
namespace Neofluxe;

// Exit if accessed directly 
defined( 'ABSPATH' ) or die;


/**
 * General hooks
 */
class general {

	/**
	 * The singleton instance of this class.
	 * @var General
	 */
	private static $instance;

	/**
	 * Gets the singleton instance of this class.
	 * This instance is lazily instantiated if it does not already exist.
	 * The given instance can be used to unregister from filter and action hooks.
	 *
	 * @return General The singleton instance of this class.
	 */
	public static function instance() {
		return self::$instance ?: ( self::$instance = new self() );
	}


	/**
	 * Creates a new instance of this singleton.
	 */
	private function __construct() {

		add_action( 'wp_enqueue_scripts', [ $this, 'c_wp_enqueue_scripts' ], 100 );
		add_action( 'admin_enqueue_scripts', [ $this, 'c_admin_enqueue_scripts' ], 100 );

		add_action( 'init', [ $this, 'c_init' ] );
		add_action( 'init', [ $this, 'c_register_main_menu' ] );
		add_action( 'init', [ $this, 'register_blocks' ] );
		add_action( 'wp_print_styles', [ $this, 'c_remove_dashicons' ], 100 );

		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );

		add_shortcode( 'wp_version', [ $this, 'c_shortcode_version' ] );

		add_shortcode( 'c_get_categories', [ $this, 'c_shortcode_get_categories' ] );
		add_shortcode( 'c_option', [ $this, 'c_shortcode_option' ] );
		add_shortcode( 'c_contact_info', [ $this, 'c_shortcode_contact_info' ] );

		add_filter( 'c_get_pagetitle', [ $this, 'c_get_pagetitle' ] );
		add_filter( 'c_convert_phone_number', [ $this, 'c_convert_phone_number' ] );
		add_filter( 'c_get_ogobj', [ $this, 'c_get_ogobj' ] );
		add_filter( 'login_redirect', [ $this, 'glue_login_redirect' ], 999 );
		add_filter( 'upload_mimes', [ $this, 'cc_mime_types' ] );


		add_filter( 'c_latest_post', [ $this, 'c_latest_post' ] );
		add_filter( 'c_get_document_info', [ $this, 'c_get_document_info' ], 10, 1 );
		add_filter( 'c_get_team_paging', [ $this, 'c_get_team_paging' ], 10 );
		add_filter( 'c_get_option', [ $this, 'c_get_option' ], 10, 1 );
		add_filter( 'c_check_linktype', [ $this, 'c_check_linktype' ] );
		add_filter( 'c_get_breadcrumbs', [ $this, 'the_breadcrumbs' ], 10, 1 );
		add_filter( 'c_render_picturetag', [ $this, 'c_shortcode_render_picture' ] );
		add_filter( 'c_render_socialmedia', [ $this, 'c_render_socialmedia' ] );

		add_filter( 'nav_menu_css_class', [ $this, 'c_special_nav_class' ], 10, 2 );
		add_filter( 'nav_menu_link_attributes', [ $this, 'add_class_to_menu' ], 10, 4 );

		add_filter( 'get_file_from_dist', [ $this, 'c_get_file_with_hash_from_manifest' ], 10, 2 );

		add_filter( 'acf/fields/google_map/api', [ $this, 'my_acf_google_map_api' ] );        


		add_filter( 'wpcf7_autop_or_not', '__return_false' );

		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );

		load_theme_textdomain( 'neofluxe', get_stylesheet_directory() . '/languages' );

		if ( function_exists( 'acf_add_options_page' ) ) {
			acf_add_options_page();
		}
	}


	/**
	 * Registers the block using the metadata loaded from the `block.json` file.
	 * Behind the scenes, it registers also all assets so they can be enqueued
	 * through the block editor in the corresponding context.
	 *
	 * @see https://developer.wordpress.org/reference/functions/register_block_type/
	 */
	function register_blocks() {
		$directory = get_template_directory() . '/src/scripts/blocks';
		register_block_type(
			$directory . '/anchors/block.json',
//			[ 'render_callback' => [$this, 'render_block_core_notice'] ]
		);
		register_block_type(
			$directory . '/anchors/inner-block.json',
//			[ 'render_callback' => [$this, 'render_block_core_notice'] ]
		);

	}

	/**
	 * Load the CSS & Javascript files
	 */
	function c_wp_enqueue_scripts() {
		$theme             = wp_get_theme();
		$file_with_path_js = apply_filters( 'get_file_from_dist', 'index.js', true );
		wp_enqueue_script( 'nf-scripts', $file_with_path_js, '', $theme->Version, true );

		$file_with_path_css = apply_filters( 'get_file_from_dist', 'index.css', true );
		wp_enqueue_style( 'nf-styles', $file_with_path_css, '', $theme->Version, 'all' );
	}

	/**
	 * Load the CSS & Javascript files for the admin
	 */
	function c_admin_enqueue_scripts() {
		$theme             = wp_get_theme();
		$file_with_path_js = apply_filters( 'get_file_from_dist', 'editor.js', true );
		wp_enqueue_script( 'nf-editor-scripts', $file_with_path_js, '', $theme->Version, true );

		$file_with_path_css = apply_filters( 'get_file_from_dist', 'editor.css', true );
		wp_enqueue_style( 'nf-editor-styles', $file_with_path_css, '', $theme->Version, 'all' );
	}

	/** Remove Dashicons from Admin Bar for non logged in users **/
	function c_remove_dashicons() {
		if ( ! is_admin_bar_showing() && ! is_customize_preview() ) {
			wp_dequeue_style( 'dashicons' );
			wp_deregister_style( 'dashicons' );
		}
	}

	/**
	 * Returns a list of all the breadcrumbs for the current page.
	 * usage: apply_filters( 'c_get_breadcrumbs', false )
	 *
	 * @param $max_depth int
	 *
	 * @return string
	 */
	function the_breadcrumbs() {
		$crumbs          = '';
		$current_page_id = get_the_ID();
		$parent          = wp_get_post_parent_id( $current_page_id );
		$index           = 0;

		while ( $parent ) {
			$index ++;
			$crumbs = '<li><a href="' . get_permalink( $parent ) . '">' . get_the_title( $parent ) . '</a></li>' . $crumbs;
			$parent = wp_get_post_parent_id( $parent );

			if ( $index > 10 ) {
				break;
			}
		}

		return $crumbs . '<li><a>' . get_the_title( $current_page_id ) . '</a></li>';
	}

	/**
	 * Returns a List of all the social media links that are filled in the theme options.
	 * If you add a new file, check that the ACF-field is named the same as the file.
	 *
	 * Usage: apply_filters( 'c_render_socialmedia', false )
	 */
	function c_render_socialmedia(): string {
		$options = get_fields( 'options' );
		$fields  = $options['social_media'];

		$html = '<ul class="social-media">';

		foreach ( $fields as $key => $url ) {
			if ( $url ) {
				$title = $key ?? '';

				$path  = "../images/social_media/$key.svg";
				$image = apply_filters( 'get_file_from_dist', $path );

				if ( ! $image ) {
					continue;
				}

				$html .= "<li class='social-media__item'>
                        <a href='$url' target='_blank' class='social-media__item__link'>
                            <img src='$image' alt='$title' class='social-media__item__icon'>
                        </a>
                    </li>";
			}
		}

		$html .= '</ul>';

		return $html;
	}

	/**
	 * Remove Gutenberg Block Library CSS from loading on the frontend
	 */
	function c_remove_wp_block_library_css() {
		wp_dequeue_style( 'wp-block-library' );
		wp_dequeue_style( 'wp-block-library-theme' );
		wp_dequeue_style( 'wc-blocks-style' ); // Remove WooCommerce block CSS
	}

	/**
	 * Gets file from the dist folder through the manifest.json file.
	 *
	 * Usage: apply_filters( 'get_file_from_dist', 'images/ico/example.png' );
	 */
	public function c_get_file_with_hash_from_manifest( $filename, $with_template_path = true ) {
		$path_to_manifest = get_template_directory() . "/dist/manifest.json";
		// Grab contents and decode them into an array
		$data     = json_decode( file_get_contents( $path_to_manifest ), true );
		$filename = $data[ $filename ] ?? false;

		if ( ! $filename ) {
			return false;
		}

		if ( $with_template_path ) {
			$filename = get_template_directory_uri() . "/dist/" . $filename;
		}

		return $filename;

	}

	public function c_init() {

		setcookie( "hideloader", 'true' );

		add_post_type_support( 'page', 'excerpt' );
		remove_post_type_support( 'post', 'editor' );
		remove_post_type_support( 'page', 'editor' );

		// Remove comments page in menu
		add_action( 'admin_menu', function () {
			remove_menu_page( 'edit-comments.php' );
		} );
	}

	public function cc_mime_types( $mimes = [] ) {
		$mimes['svg'] = 'image/svg+xml';

		return $mimes;
	}

	public function glue_login_redirect( $redirect_to, $request = '', $user = null ) {
		//using $_REQUEST because when the login form is submitted the value is in the POST
		if ( isset( $_REQUEST['redirect_to'] ) ) {
			$redirect_to = $_REQUEST['redirect_to'];
		}

		return $redirect_to;
	}

	public function c_register_main_menu(): void {
		register_nav_menu( 'header-menu', __( 'Header Menu' ) );
		register_nav_menu( 'header-menu-offcanvas', __( 'Header Menu' ) );
		register_nav_menu( 'footer-menu', __( 'Footer Menu' ) );

	}

	public function c_special_nav_class( $classes, $item ) {
		if ( in_array( 'current-menu-item', $classes ) || in_array( 'current-page-ancestor', $classes )  ) {
			$classes[] = 'c-active';
		}
		if ( $item->object_id == get_option( 'archive_blog' ) && get_post_type( get_queried_object_id() ) == 'post' ) {
			$classes[] = 'c-active ';
		}
		if ( $item->object_id == get_option( 'archive_services' ) && get_post_type( get_queried_object_id() ) == 'service' ) {
			$classes[] = 'c-active ';
		}

		return $classes;
	}

	public function add_class_to_menu( $atts, $item, $args, $depth ) {

		$atts['class'] = 'menu-item-link';

		return $atts;
	}

	public function my_acf_google_map_api() {
		$api['key'] = $this->c_get_option( 'google_maps_api_key' );

		return $api;
	}

	public function c_shortcode_version() {
		$my_theme = wp_get_theme( 'neofluxe' );
		if ( $my_theme->exists() ) {
			return $my_theme->get( 'Version' );
		}

		return 1.0;
	}


	public function c_shortcode_contact_info() {
		ob_start();
		get_template_part( 'templates/shortcode_contact', null, array(
				'email'    => $this->c_get_option( 'company_email' ),
				'tel'      => $this->c_get_option( 'company_phone' ),
				'tel_link' => str_replace( " ", "", $this->c_get_option( 'company_phone' ) ),
			)
		);

		return ob_get_clean();
	}



	/*
		Reders categories for post
		ToDo: add link
	*/
	public function c_shortcode_get_categories( $args ) {

		$separator  = $args['separator'] ?? ' / ';
		$categories = get_the_terms( $args['pid'], $args['posttype'] );
		if ( ! empty( $categories ) && count( $categories ) > 0 ) {
			$cats = array();
			foreach ( $categories as $cat ) {
				array_push( $cats, $cat->name );
			}

			return implode( $separator, $cats );
		} else {
			return '';
		}
	}

	public function c_convert_phone_number( $number ) {
		return preg_replace( '~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '($1) $2-$3', $number ) . "\n";
	}

	public function c_get_pagetitle() {

		$pagetitle = get_the_title() . ' | ';
		if ( get_post_type() == 'service' ) {
			$pagetitle .= get_the_title( get_option( 'archive_services' ) ) . ' | ';
		} else if ( get_post_type() == 'post' ) {
			$pagetitle .= get_the_title( get_option( 'archive_blog' ) ) . ' | ';
		}

		return $pagetitle . get_bloginfo();
	}

	public function c_get_ogobj() {

		$obj                = [];
		$obj['locale']      = defined( 'ICL_LANGUAGE_CODE' ) ? ICL_LANGUAGE_CODE : get_locale();
		$obj['author']       = $this->c_get_option('company_title');
		$obj['title']       = $this->c_get_pagetitle();
		if( !empty(get_field('acf_meta_title'))){
			$obj['title'] = get_field('acf_meta_title');
		}

		if( !empty(get_field('acf_meta_description'))){
			$obj['description'] = get_field( 'acf_meta_description' );
		}else if(!empty(get_field('acf_header_lead'))){
			$obj['description'] = get_field( 'acf_header_lead' );
		}else{
			$obj['description'] = $this->c_get_option('company_slogan');
		}

		$image_id = false;
		if ( get_post_thumbnail_id() ) {
			$image_id = get_post_thumbnail_id();
		} else if ( get_field( 'acf_header_image_desktop' ) ) {
			$image_id = get_field( 'acf_header_image_desktop' );
		}
		if ( $image_id ) {
			$obj['image'] = wp_get_attachment_image_src( $image_id, 'medium' );
		}

		return $obj;
	}

	public function c_get_option( $key ) {

		$options = get_field( 'company', 'option' );
		if ( $options ) {
			$options = array_merge( $options, get_field( 'site', 'option' ) );
			$options = array_merge( $options, get_field( 'logo', 'option' ) );
			$options = array_merge( $options, get_field( 'integrations', 'option' ) );
		} else {
			$options = array();
		}

		if ( array_key_exists( $key, $options ) ) {
			return $options[ $key ];
		} else {
			return 'Key ' . $key . ' not found';
		}


	}


	public function c_get_team_paging( $args ) {
		// Get posts
		global $wp_query;
		$news_query = array(
			'post_type'      => 'team',
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
			'posts_per_page' => - 1,
		);
		$team       = get_posts( $news_query );

		$count  = 0;
		$active = false;
		$prev   = false;
		$next   = false;
		foreach ( $team as $member ) {
			if ( $member->ID == get_queried_object_id() ) {
				if ( $count > 0 ) {
					$prev = $team[ $count - 1 ];
				} else {
					$prev = $team[ count( $team ) - 1 ];
				}
				if ( $count < count( $team ) - 1 ) {
					$next = $team[ $count + 1 ];
				} else {
					$next = $team[0];
				}
				$active = $member;
			}
			$count ++;
		}

		return [
			'total'   => count( $team ),
			'current' => ( $active->menu_order + 1 ),
			'prev'    => $prev,
			'next'    => $next
		];
	}

	/*
		Shortcode to output theme options
	*/
	public function c_shortcode_option( $args ) {
		return $this->c_get_option( $args['key'] );
	}

	/**
	 *    Renders a picture, with images by their ID.
	 *    The first image is the default image, the others are for different screen sizes.
	 *
	 *    https://developer.mozilla.org/en-US/docs/Web/HTML/Element/picture
	 *
	 *    IMPORTANT:
	 *    - If using **min-width**, the the images should go from **large-viewport** to small-viewport.
	 *    - If using **max-width**, the images should go from **small-viewport** to large-viewport.
	 *
	 * ``` php
	 * <?php
	 *$args = [
	 *    'class'            => 'some-class',
	 *    'id'               => 'some-id',
	 *    'fallback_image_id' => 35,
	 *    'images'           => [
	 *        [
	 *            'id'    => 37,
	 *            'media' => '(min-width: 1500px)',
	 *            'size'  => 'large'
	 *        ],
	 *        [
	 *            'id'    => 36,
	 *            'media' => '(min-width: 1200px)',
	 *            'size'  => 'large'
	 *        ],
	 *        [
	 *            'id'    => 34,
	 *            'media' => '(min-width: 800px)',
	 *            'size'  => 'large'
	 *        ],
	 *    ]
	 *];
	 * ?>
	 * <?= apply_filters( 'c_render_picturetag', $args ); ?>
	 * ```
	 *
	 * @param $args array
	 *
	 * @return string
	 **/
	public function c_shortcode_render_picture( array $args ) {
		$images       = $args['images'];
		$id           = $args['id'] ?? false;
		$id_attribute = $id ? "id=\"$id\"" : '';
		// the <img> tag, used if nothing else matches
		$fallback_image_id = $args['fallback_image_id'] ?? $images[0]['id'] ?? false;

		if ( ! $fallback_image_id ) {
			error_log( 'fn c_shortcode_render_picture(): No image ID found for picture tag' );

			return '';
		}
		
		$fallback_image_src    = wp_get_attachment_image_src( $fallback_image_id );
		$fallback_image_srcset = wp_get_attachment_image_srcset( $fallback_image_id, 'medium' );
		$fallback_image_alt    = wp_get_attachment_caption( $fallback_image_id );
		$class_string          = $args['class'] ?? 'c-picture';
		$class_string          = $class_string === '' ? 'c-picture' : $class_string;
		$html                  = "<picture {$id_attribute} class='{$class_string}' >";


		foreach ( $images as $image ) {
			$id   = $image['id'];
			$size = $image['size'] ?? 'large';
			// the media query
			$media = $image['media'] ?? '';
			$image = wp_get_attachment_image_srcset( $id, $size );
			$html  .= "<source srcset='{$image}' media='{$media}' />";
		}

		$html .= "<img decoding='async' src='{$fallback_image_src[0]}' srcset='{$fallback_image_srcset}' alt='{$fallback_image_alt}' /></picture>";

		return $html;
	}

	/**
	 * Usage `apply_filters( 'c_check_linktype', ['url' => 'https://example.com/', 'icon_classes' => ['internal', 'download', 'external'] ] );`
	 * External links can not be download, it will always display as external. Anchor link is optional and must not be filled.
	 *
	 * @param $attributes array
	 *
	 * @return string
	 */
	public function c_check_linktype( $attributes ) {
		$url          = $attributes['url'];
		$icon_classes = is_array( $attributes['icon_classes'] ) ? $attributes['icon_classes'] : [
			'internal' => 'c-link-arrow',
			'download' => 'c-link-download',
			'external' => 'c-link-extern',
			'anchor'   => 'c-icon-anchor'
		];

		if ( ! $url ) {
			return '';
		}

		$icon_class = $icon_classes['internal'] ?? $icon_classes[0];
		$internal   = ( $url && strpos( $url, $_SERVER['SERVER_NAME'] ) );

		/**
		 * check if link is internal or external
		 */
		if ( $internal ) {
			/**
			 * check if link looks like a downloadable file (.pdf or similar)
			 */
			if ( preg_match( '/\.\w+$/', $url ) ) {
				$icon_class = $icon_classes['download'] ?? $icon_classes[1];
			}

			if ( str_contains( $url, '#' ) ) {
				$icon_class = $icon_classes['anchor'] ?? $icon_classes[3] ?? $icon_class ?? '';
			}
		} else {
			$icon_class = $icon_classes['external'] ?? $icon_classes[2];
		}

		return $icon_class;
	}

}

// Trigger initialization
General::instance();
