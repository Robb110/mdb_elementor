<!--Footer-->
    <footer class="page-footer text-center font-small" id="footer">
        <div class="mobile-hamburger-menu animated">
            <div class="whatsapp"><a href="mailto:danilo.b@viverediturismo.com"><i class="fas fa-envelope"></i></a></div>
            <div class="mobile_menu_button"><button class="c-hamburger c-hamburger--htx navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span>toggle menu</span></button></div>
            <div class="book-tel"><a href="tel:0550763804"><i class="fas fa-phone"></i></a></div>
        </div>
    <?php wp_footer(); ?>
    <script>
        (function($) {
            $(window).on("load", function() {
                setTimeout(function() {
                    var doc = $(document),
                        $events = $("a[href*='#']").length ? $._data(doc[0], "events") : null;
                    if ($events) {
                        for (var i = $events.click.length - 1; i >= 0; i--) {
                            var handler = $events.click[i];
                            if (handler && handler.namespace != "mPS2id" && handler.selector === 'a[href*="#"]') doc.off("click", handler.handler);
                        }
                    }
                }, 300);
            });
        })(jQuery);
    </script>
</body>
</html>