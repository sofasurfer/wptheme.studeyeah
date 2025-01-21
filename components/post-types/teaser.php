<?php

// Namespace declaration
namespace Neofluxe\PostType;

use Neofluxe\PostTypes;

// Exit if accessed directly 
defined('ABSPATH') or die;

class Teaser {

    private static $instance;

    public static function instance() {
        return self::$instance ?: (self::$instance = new self());
    }

    private function __construct() {
        add_action('init', [$this, 'register']);
    }

    public function register() {
        PostTypes::instance()->register_post_type('teaser', 'dashicons-clipboard', [
            'name' => __('Teaser', 'neofluxe'),
            'singular_name' => __('Teaser', 'neofluxe'),
            'menu_name' => __('Teasers', 'neofluxe'),
            'all_items' => __('All Teasers', 'neofluxe'),
            'add_new' => __('Add Teaser', 'neofluxe'),
            'add_new_item' => __('New Teaser', 'neofluxe'),
            'edit_item' => __('Edit Teaser', 'neofluxe'),
            'new_item' => __('New Teaser', 'neofluxe'),
            'view_item' => __('Show Teaser', 'neofluxe'),
            'search_items' => __('Search Teasers', 'neofluxe'),
            'not_found' => __('Teaser has not been found.', 'neofluxe'),
            'not_found_in_trash' => __('Teaser not found in the trash', 'neofluxe'),
            'publicly_queryable'  => false,
        ], [
            'en' => 'teaser'
        ], false, false, true, ['title','thumbnail',  'page-attributes']);
    }
}

Teaser::instance();