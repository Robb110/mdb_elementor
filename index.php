<?php get_header(); ?>
<?php require_once('components/navbar.inc.php'); ?>
<!--Main Navigation-->
<?php
    $header_class = "";
    if (current_user_can('manage_options')){
        $header_class = "admin-showed";
    }
?>
<header class="<?php echo $header_class; ?>" id="home">

    <?php render_slider_home() ?>

</header>
<!--Main Navigation-->

<!--Main layout-->
<main>
    <?php the_content() ?>
</main>
<!--Main layout-->

<?php require_once('components/bottombar.inc.php'); ?>
<?php get_footer(); ?>