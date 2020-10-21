<?php 
    $topbar_enabled = false;
    $admin_padding_class = "";
    if($topbar_enabled){
        if(current_user_can( 'manage_options' )){
            $admin_padding_class = "admin-showed";
        }
    }else{
        $admin_padding_class = "d-none";
    }
?>

<div class="topbar grey lighten-3 fixed-top <?php echo $admin_padding_class ?>">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="text-left">
                    <label class="bold">Verifica impianto messa a terra Prato</label>
                    
                </div>
            </div>
            <div class="col-lg-6">
                <div class="text-right">
                    <label>Tel. <a  href="">+39 0574 29190</a> | <a  href="">info@rimaispezioni.it</a></label>
                </div>
            </div>
        </div>
    </div>
</div>