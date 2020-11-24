<?php
/*
* Plugin Name: My Custom ShortCodes
* Description: Create your WordPress shortcode.
* Version: 1.0
* Author: John Porra
* Author URI: https://www.pum.com.au
*/

function mdb_slides_create_type() {
 
    register_post_type( 'slides',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Slides' ),
                'singular_name' => __( 'Slide' )
            ),
            'public' => true,
            'has_archive' => true,
            'show_in_menu' => 'edit.php?post_type=slides',
            'description' => 'Slides for Slider',
            'rewrite' => array('slug' => 'slides'),
            'supports' => array('title','editor','thumbnail'),
            'menu_icon' => 'dashicons-images-alt2'
        )
    );
}
add_action( 'init', 'mdb_slides_create_type' );


function mdb_slides_checkbox_callback_function( $post ) {
    global $post;
    $isFeatured=get_post_meta( $post->ID, 'is_on_slider_home', true );
 ?>
    
    <input type="checkbox" name="is_on_slider_home" value="yes" <?php echo (($isFeatured=='yes') ? 'checked="checked"': '');?>"/> YES
 <?php
 }
function mdb_slides_add_checkbox_function() {
    add_meta_box('slide_in_home','Add slide to Home Page ?', 'mdb_slides_checkbox_callback_function', 'slides', 'side', 'high');
}
add_action( 'add_meta_boxes', 'mdb_slides_add_checkbox_function' );



function save_slide_in_home_post($post_id){ 
   update_post_meta( $post_id, 'is_on_slider_home', $_POST['is_on_slider_home']);
}
add_action('save_post', 'save_slide_in_home_post'); 




function mdb_slider_home_plugin_options_validate( $options ) {
    if( !is_array( $options ) || empty( $options ) || ( false === $options ) )
        return array();

    $clean_options = array();
    if(isset( $options['show_slider'] ) && ( 1 == $options['show_slider'] ))
        $clean_options['show_slider'] = 1;

    if(isset( $options['show_bullets'] ) && ( 1 == $options['show_bullets'] ))
        $clean_options['show_bullets'] = 1;
    
    if(isset( $options['show_arrows'] ) && ( 1 == $options['show_arrows'] ))
        $clean_options['show_arrows'] = 1;
    
    if(isset( $options['auto_slide'] ) && ( 1 == $options['auto_slide'] ))
        $clean_options['auto_slide'] = 1;

    $clean_options['slide_effect'] = $options['slide_effect'];
    

    unset($options);
    return $clean_options;
}
function mdb_slider_home_section_text() {
    echo '<p>Here you can set all the options for using the API</p>';
}

function mdb_slider_home_setting_show_arrows() {
    $options = get_option( 'mdb_slider_home_plugin_options' );?>
    <input id="mdb_slider_home_setting_show_arrows" name="mdb_slider_home_plugin_options[show_arrows]" type="checkbox" value="1" <?php checked(isset( $options["show_arrows"] )); ?> />
    <?php
}

function mdb_slider_home_setting_show_bullets() {
    $options = get_option( 'mdb_slider_home_plugin_options' );?>
    <input id="mdb_slider_home_setting_show_bullets" name="mdb_slider_home_plugin_options[show_bullets]" type="checkbox" value="1" <?php checked(isset( $options["show_bullets"] )); ?> />
    <?php
}

function mdb_slider_home_setting_show_slider() {
    $options = get_option( 'mdb_slider_home_plugin_options' );?>
    <input id="mdb_slider_home_setting_show_slider" name="mdb_slider_home_plugin_options[show_slider]" type="checkbox" value="1" <?php checked(isset( $options["show_slider"] )); ?> />
    <?php
}

function mdb_slider_home_setting_auto_slide() {
    $options = get_option( 'mdb_slider_home_plugin_options' );?>
    <input id="mdb_slider_home_setting_auto_slide" name="mdb_slider_home_plugin_options[auto_slide]" type="checkbox" value="1" <?php checked(isset( $options["auto_slide"] )); ?> />
    <?php
}

function mdb_slider_home_setting_slide_effect() {
    $options = get_option( 'mdb_slider_home_plugin_options' );?>
    <select id="mdb_slider_home_setting_slide_effect" name="mdb_slider_home_plugin_options[slide_effect]" >
        <option value="slide" <?php selected('slide',$options['slide_effect']); ?>>Slide</option>
        <option value="fade" <?php selected('fade',$options['slide_effect']); ?>>Fade</option>
    </select>
    <?php
}

function mdb_slider_home_register_settings() {
    register_setting( 'mdb_slider_home_plugin_options', 'mdb_slider_home_plugin_options', 'mdb_slider_home_plugin_options_validate' );
    add_settings_section( 'slider_home_settings', 'Slider Home Settings', 'mdb_slider_home_section_text', 'mdb_slider_home_plugin' );

    add_settings_field( 'mdb_slider_home_setting_show_slider', 'Show Slider', 'mdb_slider_home_setting_show_slider', 'mdb_slider_home_plugin', 'slider_home_settings' );
    add_settings_field( 'mdb_slider_home_setting_auto_slide', 'Auto slide', 'mdb_slider_home_setting_auto_slide', 'mdb_slider_home_plugin', 'slider_home_settings' );
    add_settings_field( 'mdb_slider_home_setting_slide_effect', 'Slide effect', 'mdb_slider_home_setting_slide_effect', 'mdb_slider_home_plugin', 'slider_home_settings' );
    add_settings_field( 'mdb_slider_home_setting_show_arrows', 'Show Arrows', 'mdb_slider_home_setting_show_arrows', 'mdb_slider_home_plugin', 'slider_home_settings' );
    add_settings_field( 'mdb_slider_home_setting_show_bullets', 'Show Bullets', 'mdb_slider_home_setting_show_bullets', 'mdb_slider_home_plugin', 'slider_home_settings' );
}
add_action( 'admin_init', 'mdb_slider_home_register_settings' );

/* Slider home */
function mdb_render_admin_slider_home(){
    if ( !current_user_can( 'manage_options' ) )  {
    wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }
    load_template(get_template_directory()."/admin/templates/admin_slider_home.php");

}

function mdb_slider_home_admin(){
    add_menu_page( "Slider home page", 
    "Slider Home", "manage_options", 
    "slider_home_admin", 'mdb_render_admin_slider_home', 
    'dashicons-images-alt', 8);
    add_submenu_page( 'slider_home_admin', 'Custom Post Type Slides', 'Slides', 'manage_options','edit.php?post_type=slides');
}
add_action('admin_menu', 'mdb_slider_home_admin');


function render_slider_home(){
    $options = get_option( 'mdb_slider_home_plugin_options' );
    if($options['show_slider'] != 1){
        return '';
    }else{
        if($options['slide_effect'] == 'fade'){
            $slide_effect = 'carousel-fade';
        }else{
            $slide_effect = '';
        }
        if($options['auto_slide'] == 0){
            $auto_slide = "false";
        }else{
            $auto_slide = "4000";
        }
        echo '<div id="slider-home" class="carousel fixed-navbar-margin slide '.$slide_effect.'" data-ride="carousel" data-interval="'.$auto_slide.'" >';
        echo '<div class="carousel-inner" role="listbox">';
        $args = array(
            'post_type' => 'slides',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'orderby' => 'title',
            'order' => 'ASC',
            'cat' => 'home'
        );
    
        $loop = new WP_Query($args);

        while($loop->have_posts()) : $loop->the_post();
            global $post;
            $featured_img = get_the_post_thumbnail_url($post->ID);
            $check_meta = get_post_meta($post->ID, 'is_on_slider_home', true);
            if ($check_meta == "yes") {
                ?>
                <div class="carousel-item <?php if($loop->current_post == 0) echo 'active'; ?>">
                    <div class="view">
                        <!-- <img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(6).jpg" alt="Second slide"> -->
                        <img class="d-block w-100" src="<?php echo esc_url($featured_img); ?>" alt="" />
                        <!--<div class="mask rgba-black-light"></div>-->
                    </div>
                    <div class="carousel-caption">
                        <div class="container">
                            <h1><?php the_title(); ?></h1>
                            <?php the_content();?>      
                        </div>
                    </div>
                </div>
                <?php
            }
        endwhile;
        if($options['show_bullets']){
            ?>
            <!--Indicators-->
            <ol class="carousel-indicators">
            <?php
            while($loop->have_posts()) : $loop->the_post();

            ?>
                <li data-target="#slider-home" data-slide-to="<?php echo $loop->current_post ; ?>" class="<?php if($loop->current_post == 0) echo 'active'; ?>"></li>
            <?php
                endwhile;
            ?>
            </ol>
            <!--/.Indicators-->
            <?php
        }

        

        if($options['show_arrows'] == 1){
            echo '<!--Controls-->
                <a class="carousel-control-prev" href="#slider-home" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#slider-home" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
                <!--/.Controls-->';
        }
        echo '</div>';
        echo '</div>';
        wp_reset_postdata();
    }
}


function slider_home_enqueue_scritps(){
    wp_enqueue_style('Slider Home Style', get_template_directory_uri() . '/plugins/slider_home/css/style.css');
    wp_enqueue_style('Admin Slider Home Style', get_template_directory_uri() . '/plugins/slider_home/admin/css/style.css');
}
add_action('wp_enqueue_scripts', 'slider_home_enqueue_scritps');



?>