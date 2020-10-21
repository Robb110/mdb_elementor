let content = document.getElementsByTagName('body')[0];
options = {
    subTree: true,
    childList: true
}
observer = new MutationObserver(mCallback);
observer.observe(content, options);


function mCallback(mutations) {
    for (let mutation of mutations) {
        if(mutation.addedNodes.length>0){
            if(mutation.addedNodes[0].classList.contains('pen-menu')){
                $('.image-left-text-right-wrapper .text-right-front .content').each( (index, value)=>{
                    var content = $(value);
                    var parent = $(content).parent();
                    if($(content).outerHeight() >= 520){
                        parent.css('height', $(content).outerHeight() + 60 + 'px');
                    }else{
                        parent.css('height', 560 + 'px');
                    }
                    console.log($(content).outerHeight());

                } )

            }
        }else if(mutation.removedNodes.length>0){
            if(mutation.removedNodes[0].classList.contains('pen-menu')){
                $('.image-left-text-right-wrapper .text-right-front .content').each( (index, value)=>{
                    var content = $(value);
                    var parent = $(content).parent();
                    if($(content).outerHeight() >= 520){
                        parent.css('height', $(content).outerHeight() + 60 + 'px');
                    }else{
                        parent.css('height', 560 + 'px');
                    }

                    console.log($(content).outerHeight());
                } )
            }
        }
    }
}