<?php 
class Overlay_Walker_Nav_Menu extends Walker_Nav_Menu {
    
    // Start Level (ul sub-menus)
    function start_lvl( &$output, $depth = 0, $args = null ) {
        $indent = str_repeat("\t", $depth);

        if ($depth == 0) {
            $output .= "\n$indent<ul class=\"c-offcanvas-menu-content\">\n";
        }else{
            $output .= "\n$indent<ul class=\"c-offcanvas-nav-list\">\n";
        }
    }

    // End Level (ul sub-menus)
    function end_lvl( &$output, $depth = 0, $args = null ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    // Start Element (li menu items)
    function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $indent = ( $depth ) ? str_repeat("\t", $depth) : '';
        
        // Add CSS classes to li elements
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        // Create the list item (li) and add a class to the first-level items
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
        
        
        // error_log(print_r($args,true));

        // Create the link with a custom label, title, and attributes
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

        // If the menu item is at the first level, add a custom label
        if ($depth === 0) {
            if ( in_array( 'menu-item-has-children', $classes ) ) {
                $checked = (in_array( 'current-menu-parent', $classes ) || in_array( 'current_page_item', $classes )) ? 'checked="checked"':'';
                $item_output =  '<input ' . $checked  . ' class="c-offcanvas-menu-check" id="offcanvas-menu-'.$item->ID.'" name="offcanvas-menu-1" type="checkbox">';
                $item_output .= '<label class="c-offcanvas-menu-title" for="offcanvas-menu-'.$item->ID.'">'.apply_filters( 'the_title', $item->title, $item->ID ).'</label>';
                $classes[] = 'current-menu-parent';
            }else{
                $item_output = sprintf( '<a%1$s>%2$s%3$s%4$s</a>',
                    $attributes,
                    $args->before,
                    apply_filters( 'the_title', $item->title, $item->ID ),
                    ''
                );
            }
        } else {
            $item_output = sprintf( '<a%1$s>%2$s%3$s</a>',
                $attributes,
                $args->before,
                apply_filters( 'the_title', $item->title, $item->ID )
            );
        }

        $class_names = ' class="' . esc_attr( $class_names ) . '"';
        $output .= $indent . '<li' . $class_names . '>';

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

    // End Element (li menu items)
    function end_el( &$output, $item, $depth = 0, $args = null ) {
        $output .= "</li>\n";
    }
}