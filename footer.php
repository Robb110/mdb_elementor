<!--Footer-->
<footer class="page-footer text-center font-small" id="footer">

    <!--Call to action-->
    <div class="pt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <label class="text-left d-block text-color">CONTATTI</label>
                    <h2 class="primary-color-text text-bold text-left">DANILO BELTRANTE</h2>
                    <label class="text-left d-block font-italic">Imprenditore, formatore e direttore della Vivere di Turismo Business School</label>
                    <hr class="footer-separator">
                    <!--<div class="logo">
                        <?php the_custom_logo(); ?>
                    </div>-->
                    <div class="contact-info mt-4 mb-5 mt-md-0">
                        <div class="item">
                            <div class="icon">
                                <img src="<?php echo get_template_directory_uri()?>/img/icons/tel-footer.svg" alt="Telefono">
                            </div>
                            <label class="ml-2 text-left">Segreteria<br>Tel. <a href="tel:0550763804">055 0763804</a></label>
                        </div>
                        <div class="item">
                            <div class="icon">
                                <img src="<?php echo get_template_directory_uri()?>/img/icons/mail-footer.svg" alt="Email">
                            </div>
                            <label class="ml-2 text-left"><a href="mailto:danilo.b@viverediturismo.com">danilo.b@viverediturismo.com</a></label>
                        </div>
                        <div class="item">
                            <div class="icon">
                                <img src="<?php echo get_template_directory_uri()?>/img/icons/sede.svg" alt="Posizione">
                            </div>
                            <label class="ml-2 text-left">
                                Vivere di Turismo Business school<br>Via dei Cappuccini, 12<br>50134 Firenze (FI)
                            </label>
                        </div>
                        <div class="social-icons mt-4">
                            <div class="social">
                                <a href="https://www.facebook.com/BeltranteDanilo" target="_blank"><img src="<?php echo get_template_directory_uri()?>/img/icons/fb.svg" alt=""></a>
                            </div>
                            <div class="social">
                                <a href="https://www.linkedin.com/in/danilo-beltrante-42352314/?originalSubdomain=it" target="_blank"><img src="<?php echo get_template_directory_uri()?>/img/icons/linkedin.svg" alt=""></a>
                            </div>
                        </div>
                    </div>
                    <!--<div class="social-icons mt-5 mb-3">
                        <div class="social">
                            <div class="icon">
                                <a href="#"><img src="<?php echo get_template_directory_uri()?>/img/icons/instagram.svg" alt="Instagram"></a>
                            </div>
                        </div>
                        <div class="social">
                            <div class="icon">
                                <a href="#"><img src="<?php echo get_template_directory_uri()?>/img/icons/fb.svg" alt="Facebook"></a>
                            </div>
                        </div>
                    </div>-->
                </div>
                <div class="col-md-6" id="contatti">
                    <label class="text-left d-block text-color">SCRIVIMI</label>
                    <div class="contact-form-7-custom">
                        <?php
                            echo do_shortcode('[contact-form-7 title="Scrivimi"]');
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-end-links">
        <ul class="links py-2 d-flex align-items-center justify-content-center mb-5 mb-md-0 flex-wrap">
            <li class="">Copyright © 2020</li>
            <li class="">Silicon Villa Lab srl</li>
            <li class="">Via dei Cappuccini n. 12, 50134 Firenze</li>
            <li class="">P.IVA 06455110483</li>
            <li class=""><a href="/privacy-policy">Privacy Policy</a></li>
            <li class=""><a href="/privacy-policy">Cookie Policy</a></li>
        </ul>
    </div>
    <div class="mobile-hamburger-menu animated">
        <div class="whatsapp"><a href="mailto:danilo.b@viverediturismo.com"><i class="fas fa-envelope"></i></a></div>
        <div class="mobile_menu_button"><button class="c-hamburger c-hamburger--htx navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span>toggle menu</span></button></div>
        <div class="book-tel"><a href="tel:0550763804"><i class="fas fa-phone"></i></a></div>
    </div>
    <?php wp_footer(); ?>
    <script>
(function($){
    $(window).on("load",function(){
        setTimeout(function(){
            var doc=$(document),
                $events=$("a[href*='#']").length ? $._data(doc[0],"events") : null;
            if($events){
                for(var i=$events.click.length-1; i>=0; i--){
                    var handler=$events.click[i];
                    if(handler && handler.namespace != "mPS2id" && handler.selector === 'a[href*="#"]' ) doc.off("click",handler.handler);
                }
            }
        },300);
    });
})(jQuery);
</script>
    </body>
    <script>
        $("#mdb-navigation > ul > li").addClass("page-item")
        $("#mdb-navigation > ul > li > a").addClass("page-link")
    </script>

    </html>