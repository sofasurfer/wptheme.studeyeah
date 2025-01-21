<?php

// Namespace declaration
namespace Neofluxe;

// Exit if accessed directly 
defined( 'ABSPATH' ) or die;


/**
 * AdminSettings hooks
 */
class AdminSettings {

	/**
	 * The singleton instance of this class.
	 * @var AdminSettings
	 */
	private static $instance;

	/**
	 * Gets the singleton instance of this class.
	 * This instance is lazily instantiated if it does not already exist.
	 * The given instance can be used to unregister from filter and action hooks.
	 *
	 * @return AdminSettings The singleton instance of this class.
	 */
	public static function instance() {
		return self::$instance ?: ( self::$instance = new self() );
	}


	/**
	 * Creates a new instance of this singleton.
	 */
	private function __construct() {		
		add_action( 'login_head', [$this, 'add_site_favicon']);
        	add_action( 'admin_head', [$this, 'add_site_favicon']);		
        	add_action( 'admin_head', [ $this, 'my_custom_admin_css' ] );
        	add_filter( 'robots_txt', [ $this, 'c_add_robots_entries' ], 99, 2 );
        	add_action( 'admin_menu', [ $this, 'c_dynamic_archive_pages' ], 100 );
		add_action('login_enqueue_scripts', [$this, 'my_login_logo'] );
	}



	/*
		Adds custom CSS to admin
	*/
	public function my_custom_admin_css() {
		echo '<style>
        .acf-fc-layout-handle{
            color: white!important;
            background-color: #0073aa;
        }
        p.c-lead{
            font-size: 2rem;
        }
        </style>';
	}

	public function add_site_favicon() {
		echo '<link rel="shortcut icon" href="' . get_stylesheet_directory_uri() . '/images/ico/favicon-32x32.png" />';
	}    
	
	public function my_login_logo() { ?>
	        <style type="text/css">
	            #login h1 a, .login h1 a {
	                background-image: url(<?=  do_shortcode("[c_option key='logo_image']"); ?>);
	                height:100px;
	                width:333px;
	                background-size: 333px 100px;
	                background-repeat: no-repeat;
	            }
	
	            body.login{

		    }
	        </style>
	    <?php }


	/**
	 * Adds rules/entries to the WP Robots.txt file.
	 *
	 * Add Disallow for some file types.
	 * Add "Disallow: /wp-login.php/\n".
	 * Remove "Allow: /wp-admin/admin-ajax.php\n".
	 * Calculate and add a "Sitemap:" link.
	 *
	 * @param $output
	 * @param $public
	 *
	 * @return string
	 */
	function c_add_robots_entries( $output, $public ) {
		/**
		 * If "Search engine visibility" is disabled,
		 * strongly tell all robots to go away.
		 */
		if ( '0' == $public ) {

			$output = "User-agent: *\nDisallow: /\nDisallow: /*\nDisallow: /*?\n";

		} else {

			/**
			 * Get site path.
			 */
			$site_url = parse_url( site_url() );
			$path     = ( ! empty( $site_url['path'] ) ) ? $site_url['path'] : '';

			/**
			 * Add new disallow.
			 */
			$output .= "Disallow: $path/wp-login.php\n";
			$output .= "Disallow: $path/wp-admin\n";

			/**
			 * Disallow some file types
			 */
			foreach ( [ 'jpeg', 'jpg', 'gif', 'png', 'mp4', 'webm', 'woff', 'woff2', 'ttf', 'eot' ] as $ext ) {
				$output .= "Disallow: /*.{$ext}$\n";
			}

			/**
			 * Remove line that allows robots to access AJAX interface.
			 */
			$robots = preg_replace( '/Allow: [^\0\s]*\/wp-admin\/admin-ajax\.php\n/', '', $output );

			/**
			 * If no error occurred, replace $output with modified value.
			 */
			if ( null !== $robots ) {
				$output = $robots;
			}
			/**
			 * Calculate and add a "Sitemap:" link.
			 * Modify as needed.
			 */
			$output .= "Sitemap: {$site_url[ 'scheme' ]}://{$site_url[ 'host' ]}/wp_sitemap.xml\n";
		}

		return $output;

	}


	/**
	 * The c_dynamic_archive_pages function adds an options page to the WordPress admin area.
	 * That page is titled “Archive Pages” and is accessible from the Settings menu.
	 *
	 * The options page contains a form with a dropdown for each custom post type.
	 * Those dropdowns allow the user to select a page from a list of all available pages in the WordPress instance.
	 * When the form is submitted, the selected pages are saved to the WordPress database using the update_option function.
	 *
	 * Nore that "post" is the blog
	 *
	 * @example
	 * $post_type   = 'my_custom_post_type';
	 * $page_id     = get_option('archive_' . $post_type);
	 *
	 * @return void
	 */
	function c_dynamic_archive_pages(): void {
		add_options_page( 'Archive Pages', 'Archive Pages 🔗', 'manage_options', 'c-archive-pages', function () {
			if ( ! current_user_can( 'manage_options' ) ) {
				wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
			}
			$args       = array(
				'public'   => true,
				'_builtin' => false
			);
			$output     = 'names';
			$operator   = 'and';
			// used for blog posts
			$post_types = get_post_types( $args, $output, $operator );
			$post_types[] = 'post';
			$pages      = get_pages();

			echo '<div class="wrap">';
			echo '<h2>' . __( 'Archive Page Linking', 'neofluxe' ) . '</h2>';

			if ( isset( $_POST['submit'] ) ) {
				foreach ( $post_types as $post_type ) {
					$option_name = 'archive_' . $post_type;
					update_option( $option_name, $_POST[ $post_type ] );
				}
				echo '<div id="message" class="updated"><p>' . __( 'Option saved.', 'neofluxe' ) . '</p></div>';
			}

			echo '<form method="post" action="" class="c-archivepage-form">';

			foreach ( $post_types as $post_type ) {
				$option_name = 'archive_' . $post_type;
				$title = $post_type;

				if ($title === 'post') {
					$title = 'post (blog)';
				}

				echo '<h3>' . $title . '</h3>';
				echo '<select name="' . $post_type . '">';
				echo '<option value=""></option>';
				foreach ( $pages as $page ) {
					echo '<option value="' . $page->ID . '"' . selected( get_option( $option_name ), $page->ID ) . '>' . $page->post_title . '</option>';
				}
				echo '</select>';
				echo '<br />';
			}

			echo '<input type="submit" class="button button-primary" name="submit" value="' . __( 'Save', 'neofluxe' ) . '" style="margin-top: 10px;" />';
			echo '</form>';
			echo '</div>';
		} );
	}

}

// Trigger initialization
AdminSettings::instance();
