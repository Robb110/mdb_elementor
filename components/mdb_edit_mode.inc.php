<?php
    namespace Elementor;
?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri() . "/css/mdb_edit_mode.css"; ?>">
<div class="hover-floating-menu-right">
    
    <div class="edit-menu active">
        <div class="card">
            <nav class="nav nav-pills m-0 flex-column flex-sm-row flex-nowrap overflow-hidden" id="nav-tab" role="tablist">
                <a class="flex-sm-fill text-sm-center nav-link active" id="colors-tab" data-toggle="tab" href="#colors" role="tab" aria-controls="fonts" aria-selected="true">Colors</a>
                <a class="flex-sm-fill text-sm-center nav-link" id="fonts-tab" data-toggle="tab" role="tab" aria-controls="fonts" aria-selected="true" aria-current="page" href="#fonts">Fonts</a>
            </nav>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="colors" role="tabpanel" aria-labelledby="colors-tab">
                        <div class="colors-list overflow-hidden">
                         <?php
                            $global_colors = Plugin::$instance->kits_manager->get_current_settings();

                            $system_colors = $global_colors["system_colors"];
                            $custom_colors = $global_colors["custom_colors"];

                            if(sizeof($system_colors) > 0){
                                foreach($system_colors as $color){
                            ?>
                                    <div class="d-flex align-items-center my-2 flex-nowrap text-nowrap overflow-hidden"><div class="color-picker" data-color-id="<?php echo $color['_id']; ?>" data-default-color="<?php echo $color['color'];?>" data-css-variable-id="--e-global-color-<?php echo $color['_id']; ?>"></div><?php echo $color['title']; ?></div>
                            <?php
                                }
                            }

                            if(sizeof($custom_colors) > 0){
                                foreach($custom_colors as $color){
                            ?>
                                    <div class="d-flex align-items-center my-2 flex-nowrap text-nowrap overflow-hidden"><div class="color-picker" data-color-id="<?php echo $color['_id']; ?>" data-default-color="<?php echo $color['color'];?>" data-css-variable-id="--e-global-color-<?php echo $color['_id']; ?>"></div><?php echo $color['title']; ?></div>
                            <?php
                                }
                            }
                         ?>
                        </div>
                        <div class="reset-colors-button mt-3 mb-2"><button type="button" class="btn btn-primary" id="reset-colors">RESET</button></div>
                    </div>
                    <div class="tab-pane fade" id="fonts" role="tabpanel" aria-labelledby="fonts-tab">
                        <div class="fonts-options overflow-hidden">
                            <div class="my-2 text-nowrap">
                                <div class="label text-nowrap overflow-hidden"> Font Family</div>
                                <select id="font-family-selector" class="form-select my-2" aria-label="Select Font Family">
                                    <option value="Roboto" selected>Default</option>
                                    <?php

                                    $fonts = Fonts::get_fonts_by_groups(['googlefonts']);
                                    foreach($fonts as $key => $value){
                                        ?>
                                        <option value="<?php echo $key ?>"><?php echo $key ?></option>
                                        <?
                                    }
                                ?>
                                </select>
                                
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="hover-button">
        <div class="round"></div>
        <i class="arrow left"></i>
        <div class="round"></div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri() . "/js/mdb_edit_mode.js"; ?>"></script>