<?php

/**
 * The template for displaying 404 pages (Not Found).
 * 
 * @package mdb_theme
 */
?>
<?php get_header(); ?>
<?php require_once('components/navbar.inc.php'); ?>
<!--Main Navigation-->
<?php
$header_class = "";
if (current_user_can('manage_options')) {
    $header_class = "admin-showed";
}
?>
<header class="page-header header-404">
    <div class="container text-center pt-5">
        <h1 class="page-title primary-color-text"><?php _e('Pagina non trovata', 'mdb_theme'); ?></h1>
    </div>
</header>
<!--Main Navigation-->

<!--Main layout-->
<main>
    <section class="error-404">
        <div class="container text-center mb-5 pb-5">
            <h2 class="text-color"><?php _e('Torna all\' homepage ', 'mdb_theme'); ?></h2>
            <a href="/" class="btn btn-lg btn-rounded btn-outline-primary">Home</a>
        </div>
    </section>
</main>
<!--Main layout-->


<?php get_footer(); ?>