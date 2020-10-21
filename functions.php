<?php

/**
 * Include external files
 */
require_once('classes/class-mdb-walker-nav-menu.php');
require_once('inc/pagination.inc.php');
require_once('inc/template-tags.inc.php');

require_once('plugins/slider_home.php');
require_once('elementor/connector.php');



/**
 * Include CSS files
 */
function theme_enqueue_scripts()
{
        wp_enqueue_style('Font_Awesome', 'https://use.fontawesome.com/releases/v5.6.1/css/all.css');
        wp_enqueue_style('Bootstrap_css', get_template_directory_uri() . '/css/bootstrap.min.css');
        wp_enqueue_style('MDB', get_template_directory_uri() . '/css/mdb.min.css');
        wp_enqueue_style('MDB Style', get_template_directory_uri() . '/css/style.css');
        wp_enqueue_style('Colors', get_template_directory_uri() . '/css/colors.css');
        wp_enqueue_style('Style', get_template_directory_uri() . '/style.css');
        wp_enqueue_style('Responsive', get_template_directory_uri() . '/css/responsive.css');
        wp_enqueue_style('Admin Slider Home', get_template_directory_uri() . '/admin/css/admin_slider_home.css');
        wp_enqueue_script('jQuery', get_template_directory_uri() . '/js/jquery.min.js', array(), '3.5.1', true);
        wp_enqueue_script('jQueryUI', 'https://code.jquery.com/ui/1.12.0/jquery-ui.js', array(), '1.12.0', true);
        
        wp_enqueue_script('Tether', get_template_directory_uri() . '/js/popper.min.js', array(), '1.0.0', true);
        wp_enqueue_script('Bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '1.0.0', true);
        wp_enqueue_script('MDB', get_template_directory_uri() . '/js/mdb.min.js', array(), '1.0.0', true);
        wp_enqueue_script('Main', get_template_directory_uri() . '/js/main.js', array(), '1.0.0', true);

}
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');

/**
 * Setup Theme
 */
function mdbtheme_setup()
{
        // Add featured image support
        add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'mdbtheme_setup');

/**
 * Register our sidebars and widgetized areas.
 */
function mdb_widgets_init()
{

        register_sidebar(array(
                'name'          => 'Sidebar',
                'id'            => 'sidebar',
                'before_widget' => '',
                'after_widget'  => '',
                'before_title'  => '',
                'after_title'   => '',
        ));
}
add_action('widgets_init', 'mdb_widgets_init');

function mdb_menu()
{
        register_nav_menu('mdb-menu', __('Primary Menu'));
}
add_action('init', 'mdb_menu');


function mdb_nav_menu_link_css_class($atts, $item, $args, $depth)
{
        if ($args->walker->has_children) {
                if (is_array($atts)) {
                        $atts['class'] = 'dropdown-toggle';
                        $atts['type'] = "button";
                        $atts['data-toggle'] = "dropdown";
                        $atts['aria-haspopup'] = "true";
                        $atts['href'] = '#';
                }
        }

        if (is_array($atts)) {
                $atts['class'] .= ' nav-link';
        }

        return $atts;
}
add_filter('nav_menu_link_attributes', 'mdb_nav_menu_link_css_class', 10, 4);


function mdb_nav_menu_submenu_css_class($classes, $args, $depth)
{
        if (is_array($classes)) {
                $classes[] = 'dropdown-menu';
        }

        return $classes;
}
add_filter('nav_menu_submenu_css_class', 'mdb_nav_menu_submenu_css_class', 10, 3);

function mdb_menu_set_dropdown($sorted_menu_items, $args)
{
        $last_top = 0;
        foreach ($sorted_menu_items as $key => $obj) {
                // it is a top lv item?
                if (0 == $obj->menu_item_parent) {
                        // set the key of the parent
                        $last_top = $key;
                } else {
                        $sorted_menu_items[$last_top]->classes[] = 'dropdown';
                }
        }
        return $sorted_menu_items;
}
add_filter('wp_nav_menu_objects', 'mdb_menu_set_dropdown', 10, 2);


function mdb_nav_menu_css_class($classes, $item, $args, $depth)
{
        if (is_array($classes)) {
                $classes[] = "nav-item";
                if ($item->menu_item_parent > 0) {
                        $classes[] = "dropdown-item";
                }
        }
        return $classes;
}
add_filter('nav_menu_css_class', 'mdb_nav_menu_css_class', 10, 4);

function mdb_custom_logo_setup()
{
        $defaults = array(
                'height'      => 100,
                'width'       => 400,
                'flex-height' => true,
                'flex-width'  => true,
                'header-text' => array('site-title', 'site-description'),
                'unlink-homepage-logo' => true,
        );
        add_theme_support('custom-logo', $defaults);
}
add_action('after_setup_theme', 'mdb_custom_logo_setup');

