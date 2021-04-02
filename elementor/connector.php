<?php
namespace MDBElementor;

class Connector_Widgets {

    private static $_instance = null;

    public static function instance(){
        if(is_null(self::$_instance)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    private function include_widgets_files(){
        require_once(__DIR__ . '/widgets/fullscreen-hamburger-menu/widget.php');
        //require_once(__DIR__ . '/widgets/image-left-text-right.php');
        //require_once(__DIR__ . '/widgets/title-with-content.php');
        //require_once(__DIR__ . '/widgets/title-with-content-logo.php');
        //require_once(__DIR__ . '/widgets/title-with-content-avatar.php');
        //require_once(__DIR__ . '/widgets/card-mini.php');

    }

    public function register_widgets(){

        $this->include_widgets_files();

        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\FullscreenHamburgerMenu());
        //\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\ImageLeftTextRight());
        //\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\TitleWithContent());
        //\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\TitleWithContentLogo());
        //\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\TitleWithContentAvatar());
        //\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\CardMini());
    }

    public function widget_styles(){
        wp_register_style( 'mdbe_global_style', plugins_url( 'css/style.css', __FILE__ ) );
        wp_register_style( 'mdbe_font_icons', plugins_url( 'css/mdbe-icons/style.css', __FILE__ ) );
    }

    public function add_elementor_widget_categories( $elements_manager ) {

        $elements_manager->add_category(
            'mdbe-widgets',
            [
                'title' => __( 'MDB Widgets', 'mdb-elementor' ),
                'icon' => 'mdbe-icons mdbe-icons-logo',
            ]
        );
    
    }

    public function __construct(){
        add_action('elementor/elements/categories_registered', [$this, 'add_elementor_widget_categories'], 98);
        add_action('elementor/widgets/widgets_registered', [$this, 'register_widgets'], 99);
    }

}


Connector_Widgets::instance();