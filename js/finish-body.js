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