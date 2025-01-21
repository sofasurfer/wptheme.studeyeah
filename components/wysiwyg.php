<?php

// Namespace declaration
namespace Neofluxe;

// Exit if accessed directly 
defined( 'ABSPATH' ) or die;


/**
 * WysiwygSettings hooks
 */
class WysiwygSettings {

	/**
	 * The singleton instance of this class.
	 * @var WysiwygSettings
	 */
	private static $instance;

	/**
	 * Gets the singleton instance of this class.
	 * This instance is lazily instantiated if it does not already exist.
	 * The given instance can be used to unregister from filter and action hooks.
	 *
	 * @return WysiwygSettings The singleton instance of this class.
	 */
	public static function instance() {
		return self::$instance ?: ( self::$instance = new self() );
	}


	/**
	 * Creates a new instance of this singleton.
	 */
	private function __construct() {
        add_filter( 'use_block_editor_for_post', '__return_false' );
		add_filter( 'acf/fields/wysiwyg/toolbars', [ $this, 'c_toolbars' ] );
		add_filter( 'tiny_mce_before_init', [ $this, 'c_tiny_mce_before_init' ] );


		add_filter( 'acf/format_value/type=textarea', [ $this, 'c_format_value' ], 10, 3 );
	}

    /*
		wysiwyg settings
	*/
	public function c_toolbars( $toolbars ) {

		$toolbars['Neofluxe default']    = array();
		$toolbars['Neofluxe default'][1] = array(
			'formatselect',
			'styleselect',
			'bold',
			'italic',
			'link',
			'unlink',
			'removeformat',
			'charmap',
			'numlist',
			'bullist'
		);

		return $toolbars;
	}

	public function c_tiny_mce_before_init( $settings ) {

		$settings['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;';
		$style_formats             = array(
			array(
				'title'    => 'Lead',
				'selector' => 'p',
				'classes'  => 'c-lead',
				'wrapper'  => false,
			),
		);

		$settings['style_formats'] = json_encode( $style_formats );

		return $settings;

	}


	/*
		Run do_shortcode on all textarea values
	*/
	public function c_format_value( $value, $post_id, $field ) {
		$value = do_shortcode( $value );

		return $value;
	}


}

// Trigger initialization
WysiwygSettings::instance();