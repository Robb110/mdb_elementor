<?php 
    $bottom_bar_enabled = true;
    $display = "";
    if(!$bottom_bar_enabled){
        $display = "d-none";
    }
?>

<div class="bottom-bar grey lighten-3 fixed-bottom animated <?php echo $display ?>">
    <div class="container my-2">
        <div class="row">
            <div class="col-lg-4 text-center">
                <div class="d-flex justify-content-center align-items-center flex-nowrap">
                    <img class="mr-2" height="20" src="<?php echo get_template_directory_uri()?>/img/icons/sede.svg" />
                    <div class="text">Via dei Cappuccini, 12 50134 Firenze</div>
                </div>
            </div>
            <div class="col-lg-4 text-center">
                <div class="d-flex justify-content-center align-items-center flex-nowrap">
                    <img class="mr-2" height="20" src="<?php echo get_template_directory_uri()?>/img/icons/tel-footer.svg" />
                    <div class="text"><a href="tel:0550763804">Tel. 055 0763804</a></div>
                </div>
            </div>
            <div class="col-lg-4 text-center">
                <div class="d-flex justify-content-center align-items-center flex-nowrap">
                    <img class="mr-2" height="14" src="<?php echo get_template_directory_uri()?>/img/icons/mail-footer.svg" />
                    <div class="text"><a href="mailto:danilo.b@viverediturismo.com">danilo.b@viverediturismo.com</a></div>
                </div>
            </div>
        </div>
    </div>
</div>