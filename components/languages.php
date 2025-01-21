<?php

// Namespace declaration
namespace Neofluxe;

// Exit if accessed directly 
defined( 'ABSPATH' ) or die;


/**
 * LanguageSettings hooks
 */
class LanguageSettings {

	/**
	 * The singleton instance of this class.
	 * @var LanguageSettings
	 */
	private static $instance;

	/**
	 * Gets the singleton instance of this class.
	 * This instance is lazily instantiated if it does not already exist.
	 * The given instance can be used to unregister from filter and action hooks.
	 *
	 * @return LanguageSettings The singleton instance of this class.
	 */
	public static function instance() {
		return self::$instance ?: ( self::$instance = new self() );
	}


	/**
	 * Creates a new instance of this singleton.
	 */
	private function __construct() {		
		add_shortcode( 'c_post_locale', [ $this, 'c_shortcode_post_locale' ] );
		add_shortcode( 'c_post_language_url', [ $this, 'c_shortcode_post_languages' ] );
	}


	/*
		Returns default locale
	*/
	public function c_shortcode_post_locale() {
		$lang  = defined( 'ICL_LANGUAGE_CODE' ) ? ICL_LANGUAGE_CODE : get_locale();
		$langs = icl_get_languages( 'skip_missing=0' );
		if ( isset( $langs[ $lang ]['default_locale'] ) ) {
			return $langs[ $lang ]['default_locale'];
		}

		return "en_US";
	}


	/*
		Creates language switch
	*/
	public function c_shortcode_post_languages( $args ) {
		$lswitch   = "";
		$languages = icl_get_languages( 'skip_missing=1' );
		if ( 1 < count( $languages ) ) {
			$lswitch = '';
			foreach ( $languages as $l ) {
				if ( $l['active'] != 1 ) {
					$lswitch .= $l['url'];
				}
			}
		}

		return $lswitch;
	}
}

// Trigger initialization
LanguageSettings::instance();