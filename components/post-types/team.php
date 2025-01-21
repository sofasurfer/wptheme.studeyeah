<?php

// Namespace declaration
namespace Neofluxe\PostType;

use Neofluxe\PostTypes;

// Exit if accessed directly 
defined('ABSPATH') or die;

class Team {

    private static $instance;

    public static function instance() {
        return self::$instance ?: (self::$instance = new self());
    }

    private function __construct() {
        add_action('init', [$this, 'register']);
    }

    public function register() {
        PostTypes::instance()->register_post_type('team', 'dashicons-groups', [
            'name' => __('Team', 'neofluxe'),
            'singular_name' => __('Team', 'neofluxe'),
            'menu_name' => __('Team', 'neofluxe'),
            'all_items' => __('All Members', 'neofluxe'),
            'add_new' => __('Add Member', 'neofluxe'),
            'add_new_item' => __('New Member', 'neofluxe'),
            'edit_item' => __('Edit Member', 'neofluxe'),
            'new_item' => __('New Member', 'neofluxe'),
            'view_item' => __('Show Member', 'neofluxe'),
            'search_items' => __('Search Member', 'neofluxe'),
            'not_found' => __('Member has not been found.', 'neofluxe'),
            'not_found_in_trash' => __('Member not found in the trash', 'neofluxe'),
            'publicly_queryable'  => false,
        ], [
            'en' => 'team'
        ], false, false, true, ['title','thumbnail',  'page-attributes']);
    }
}

Team::instance();