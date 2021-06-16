<?php

/**
 * Include external files
 */
require_once('inc/pagination.inc.php');
require_once('inc/template-tags.inc.php');
require_once('classes/class-tgm-plugin-activation.php');

//require_once('classes/class-mdb-walker-nav-menu.php');
//require_once('plugins/slider_home.php');
require_once('elementor/connector.php');



/**
 * Include CSS files
 */
function theme_enqueue_scripts()
{
        wp_enqueue_style('Font_Awesome', 'https://use.fontawesome.com/releases/v5.6.1/css/all.css');
        wp_enqueue_style('Bootstrap_css', get_template_directory_uri() . '/css/bootstrap.min.css');
        wp_enqueue_style('MDB', get_template_directory_uri() . '/css/mdb.min.css');
        wp_enqueue_style('MDB_Elementor_Icons', get_template_directory_uri() . '/css/mdbe-icons/style.css');
        wp_enqueue_style('MDB_Style', get_template_directory_uri() . '/css/style.css');
        wp_enqueue_style('Effects', get_template_directory_uri() . '/css/effects.css');
        wp_enqueue_style('Colors', get_template_directory_uri() . '/css/colors.css');
        wp_enqueue_style('Pickr_Nano', get_template_directory_uri() . '/css/pickr.nano.min.css');
        wp_enqueue_style('Style', get_template_directory_uri() . '/style.css');
        wp_enqueue_style('Responsive', get_template_directory_uri() . '/css/responsive.css');
        wp_enqueue_script('jQuery', get_template_directory_uri() . '/js/jquery.min.js', array(), '3.5.1', true);
        wp_enqueue_script('jQueryUI', 'https://code.jquery.com/ui/1.12.0/jquery-ui.js', array(), '1.12.0', true);
        wp_enqueue_script('Tether', get_template_directory_uri() . '/js/popper.min.js', array(), '1.0.0', true);
        wp_enqueue_script('Bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '1.0.0', true);
        wp_enqueue_script('MDB', get_template_directory_uri() . '/js/mdb.min.js', array(), '1.0.0', true);
        wp_enqueue_script('Pickr', get_template_directory_uri() . '/js/pickr.min.js', array(), '1.8.0', true);
        wp_enqueue_script('Main', get_template_directory_uri() . '/js/main.js', array(), '1.0.0', true);
        wp_enqueue_script('Body_End', get_template_directory_uri() . '/js/finish-body.js', array(), '1.0.0', true);

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
 * Github Theme Updater
 */
function mdb_elementor_github_updater() {
        get_template_part( 'plugins/github-theme-updater/Updater' );
}
add_action( 'after_setup_theme', 'mdb_elementor_github_updater');

/**
 * Register our sidebars and widgetized areas.
 */


/*function mdb_widgets_init()
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
add_action('widgets_init', 'mdb_widgets_init');*/

function mdb_menu()
{
        register_nav_menu('mdb-menu', __('Menu Principale'));
}
add_action('init', 'mdb_menu');


function mdb_nav_menu_link_css_class($atts, $item, $args, $depth)
{
        /*if ($args->walker->has_children) {
                if (is_array($atts)) {
                        $atts['class'] = 'dropdown-toggle';
                        $atts['type'] = "button";
                        $atts['data-toggle'] = "dropdown";
                        $atts['aria-haspopup'] = "true";
                        $atts['href'] = '#';
                }
        }*/

        if (is_array($atts)) {
                $atts['class'] .= ' nav-link';
        }

        return $atts;
}
add_filter('nav_menu_link_attributes', 'mdb_nav_menu_link_css_class', 10, 4);


/*function mdb_nav_menu_submenu_css_class($classes, $args, $depth)
{
        if (is_array($classes)) {
                $classes[] = 'dropdown-menu';
        }

        return $classes;
}
add_filter('nav_menu_submenu_css_class', 'mdb_nav_menu_submenu_css_class', 10, 3);*/

/*function mdb_menu_set_dropdown($sorted_menu_items, $args)
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
add_filter('wp_nav_menu_objects', 'mdb_menu_set_dropdown', 10, 2);*/


/*function mdb_nav_menu_css_class($classes, $item, $args, $depth)
{
        if (is_array($classes)) {
                $classes[] = "nav-item";
                if ($item->menu_item_parent > 0) {
                        $classes[] = "dropdown-item";
                }
        }
        return $classes;
}
add_filter('nav_menu_css_class', 'mdb_nav_menu_css_class', 10, 4);*/

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



function mdb_dependencies() {
  if( ! is_plugin_active('elementor/elementor.php') )
    echo '<div class="error"><p>' . __( 'Error: MDB Elementor Theme needs Elementor to work') . '</p></div>';
}
add_action( 'admin_notices', 'mdb_dependencies' );


function mdb_elementor_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		// This is an example of how to include a plugin from the WordPress Plugin Repository.
		array(
			'name'      => 'Elementor',
			'slug'      => 'elementor',
			'required'  => true,
		),
	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'mdb_elementor',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'mdb_elementor_register_required_plugins' );

/**
 * Shortcode for MDB Edit Mode
 */
function mdb_elementor_edit_mode_widget(){
        require('components/mdb_edit_mode.inc.php');
}

add_shortcode('mdb_edit_mode', 'mdb_elementor_edit_mode_widget');

/**
 * Shortcode for Current Year
 */
function current_year_shortcode() {
        $year = date('Y');
        return $year;
}
add_shortcode('current_year', 'current_year_shortcode');


/**
 * Shortcode for FAQ Template
 */
function mdb_faq_template_shortcode()
{
        $html_code = "";

        $args = array(
                'post_type' => 'faqs',
                'post_status' => 'publish',
                'order' => 'desc'
        );
        $query = new WP_Query($args);

        if ($query->have_posts()) {
                $html_code .= '<div class="row"><div class="col-lg-3"><div class="nav flex-column nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">';
                $count = 0;
                while ($query->have_posts()) {
                        $query->the_post();
                        $title = get_the_title();
                        $post_name = get_post_field('post_name');

                        $addClass= "";
                        $addAriaSelected = "false";
                        if($count == 0){
                                $addClass = "active";
                                $addAriaSelected = "true";
                        }

                        $html_code .= '<a class="'.$addClass.'" data-mdb-toggle="pill" id="'.$post_name.'-tab" href="#'.$post_name.'" role="tab" aria-controls="'.$post_name.'" aria-selected="'.$addAriaSelected.'"><h5>'.$title.'</h5></a>';
                        $count++;
                }
                $html_code .= '</div></div><div class="col-lg-9"><div class="tab-content" id="v-pills-tabContent">';

                $count = 0;
                while ($query->have_posts()) {
                        $query->the_post();
                        $faqs = get_field('domande_frequenti');
                        $post_name = get_post_field('post_name');

                        $addClass= "";

                        if($count == 0){
                                $addClass = "show active";
                        }
                        $html_code .= '<div class="tab-pane fade '.$addClass.'" id="'.$post_name.'" role="tabpanel" aria-laballedby="'.$post_name.'-tab">';

                        $html_code .= '<div class="accordion" id="accordion-'.$post_name.'">';
                        $count_faq = 0;
                        foreach($faqs as $faq){
                                $html_code .= '<div class="accordion-item">';

                                $html_code .= '<h5 class="accordion-header" id="question_'.$post_name.'-'.$count_faq.'"><button class="accordion-button collapsed" type="button" data-mdb-toggle="collapse" data-mdb-target="#answer_'.$post_name.'-'.$count_faq.'" aria-expanded="false" aria-controls="#answer_'.$post_name.'-'.$count_faq.'">'.$faq['domanda'].'</button></h5>';
                                $html_code .= '<div class="accordion-collapse collapse" id="answer_'.$post_name.'-'.$count_faq.'" aria-labbeledby="question_'.$post_name.'-'.$count_faq.'" data-mdb-parent="#accordion-'.$post_name.'"><div class="accordion-body">'.$faq['risposta'].'</div></div>';

                                $html_code .= '</div>';

                                $count_faq++;
                        }
                        $html_code .= '</div></div>';
                        $count++;
                }
                $html_code .= "</div></div></div>";
        }
        wp_reset_postdata();
        return $html_code;
}

add_shortcode('mdb_faq_template', 'mdb_faq_template_shortcode');