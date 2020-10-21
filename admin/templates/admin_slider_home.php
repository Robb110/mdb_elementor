<form action="options.php" method="post">
    <?php 
    settings_fields( 'mdb_slider_home_plugin_options' );
    do_settings_sections( 'mdb_slider_home_plugin' ); ?>
    <input name="submit" class="button button-primary" type="submit" value="<?php esc_attr_e( 'Save' ); ?>" />
</form>