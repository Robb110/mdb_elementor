<!-- Navbar -->

<?php require_once('topbar.inc.php'); ?>
<?php
$admin_padding_class = "";
if (current_user_can('manage_options') && $topbar_enabled == false) {
    $admin_padding_class = "admin-showed";
} else if (current_user_can('manage_options') && $topbar_enabled == true) {
    $admin_padding_class = "admin-showed topbar-showed";
} else if($topbar_enabled == true){
    $admin_padding_class = "topbar-showed";
}
?>
<nav class="navbar fixed-top navbar-expand-lg navbar-light scrolling-navbar <?php echo $admin_padding_class; ?>">


    <div class="container-lg">

        <!-- Brand -->
        <a class="navbar-brand pt-0 waves-effect mx-auto mx-md-initial" href="/">
            <?php
            $custom_logo_id = get_theme_mod('custom_logo');
            $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
            if (has_custom_logo()) {
                echo '<img src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '">';
            } else {
                '<h3 class="text-uppercase">'. get_bloginfo( 'name' ) .'</h3>';
            }
            ?>
        </a>

        <!-- Collapse -->

        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- Left -->

            <!-- Navbar -->
            <?php
            wp_nav_menu(array(
                'theme_location' => 'mdb-menu',
                'container' => '',
                'container_class' => '',
                'menu_class' => 'text-center',
                'items_wrap' => '<ul id="%1$s" class="%2$s navbar-nav ml-auto">%3$s</ul>'
                //'walker' => new Mdb_Walker_Nav_Menu,
            ));
            ?>

            <!-- Right -->
            <!--<ul class="navbar-nav nav-flex-icons justify-content-center ml-auto">
                <li class="nav-item">
                    <a href="#footer" class="btn btn-outline-primary btn-rounded waves-effect">Contattaci</a>
                </li>
            </ul>-->

        </div>

    </div>
</nav>