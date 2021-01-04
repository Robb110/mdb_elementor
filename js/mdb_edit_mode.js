/**
 * Edit Mode for Live mod of Colors/Fonts on MDB Elementor Theme Elements
 */

/*jQuery('.hover-floating-menu-right #edit-menu-btn').on('click', function(){
    if( jQuery('.hover-floating-menu-right .menu').hasClass('active')){
         jQuery('.hover-floating-menu-right .menu').toggleClass('active', false);
         jQuery('.hover-floating-menu-right .edit-menu').toggleClass('active', true);
         jQuery(this).text('Nav menu');
    }else{
        jQuery('.hover-floating-menu-right .menu').toggleClass('active', true);
        jQuery('.hover-floating-menu-right .edit-menu').toggleClass('active', false);
        jQuery(this).text('Edit menu');
    }
});*/

window.onload = function(){
    let colors_elements = new Array();

    jQuery('.color-picker').each(function( index, element){

        let default_color = jQuery(element).attr('data-default-color');

        let newColor = Pickr.create({
            el: element,
            theme: 'nano', // or 'monolith', or 'nano'
            default: jQuery(element).attr('data-default-color'),
            swatches: [
                'rgba(244, 67, 54, 1)',
                'rgba(233, 30, 99, 0.95)',
                'rgba(156, 39, 176, 0.9)',
                'rgba(103, 58, 183, 0.85)',
                'rgba(63, 81, 181, 0.8)',
                'rgba(33, 150, 243, 0.75)',
                'rgba(3, 169, 244, 0.7)',
                'rgba(0, 188, 212, 0.7)',
                'rgba(0, 150, 136, 0.75)',
                'rgba(76, 175, 80, 0.8)',
                'rgba(139, 195, 74, 0.85)',
                'rgba(205, 220, 57, 0.9)',
                'rgba(255, 235, 59, 0.95)',
                'rgba(255, 193, 7, 1)'
            ],
        
            components: {
        
                // Main components
                preview: true,
                opacity: true,
                hue: true,
        
                // Input / output Options
                interaction: {
                    hex: true,
                    rgba: true,
                    hsla: true,
                    hsva: true,
                    cmyk: true,
                    input: true,
                    clear: true,
                    save: true
                }
            }
        });

        newColor.data_css_id = jQuery(element).attr('data-css-variable-id');
        newColor.default_color = default_color;
        colors_elements.push(newColor);
    });

    colors_elements.forEach(function(color){
        color.on('init', instance => {
        }).on('changestop', instance => {
            color.applyColor();
            document.getElementsByClassName('elementor-kit-6')[0].style.setProperty(color.data_css_id, color.getSelectedColor().toRGBA().toString(0));
            color.hide();
        }).on('swatchselect', instance => {
            color.applyColor();
            document.getElementsByClassName('elementor-kit-6')[0].style.setProperty(color.data_css_id, color.getSelectedColor().toRGBA().toString(0));
            color.hide();
        }).on('save', instance => {
            document.getElementsByClassName('elementor-kit-6')[0].style.setProperty(color.data_css_id, color.getSelectedColor().toRGBA().toString(0));
            color.hide();
        });
    });

    jQuery('.hover-floating-menu-right #font-family-selector').on('change', function(){
        jQuery('body').css('font-family', this.value);
        let newFont = this.value;
        WebFont.load({
            google: { 
                   families: [newFont] 
             } 
        }); 
    });
    
    jQuery('.hover-floating-menu-right #reset-colors').on('click', function(){
        colors_elements.forEach(function(color){
            document.getElementsByClassName('elementor-kit-6')[0].style.setProperty(color.data_css_id, color.default_color);
            color.setColor(color.default_color);
        });
    });
};