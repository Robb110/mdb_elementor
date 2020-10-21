<?php
namespace MDBElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class ImageLeftTextRight extends Widget_Base
{

    public function get_name()
    {
        return 'image_left_text_right';
    }

    public function get_title()
    {
        return __('Section image left text right');
    }

    public function get_icon()
    {
        return 'fa fa-code';
    }

    public function get_categories()
    {
        return ['general'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'section_image',
            [
                'label' => __('Image settings')
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => __('Image to display'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src()
                ]
            ]
        );

        $this->add_control(
			'entrance_animation_image',
			[
				'label' => __( 'Entrance Animation'),
				'type' => \Elementor\Controls_Manager::ANIMATION,
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'section_title',
            [
                'label' => __('Title')
            ]
        );
        

        $this->add_control(
            'title',
            [
                'label' => __('Title'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Title')
            ]
        );

        $this->add_control(
			'title_color',
			[
				'label' => __( 'Text Color'),
				'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#fefefe',
                'selectors' => [
					'{{WRAPPER}} .title-color' => 'color: {{VALUE}}',
				],
			]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Typography'),
				'selector' => '{{WRAPPER}} .title',
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Content')
            ]
        );

        $this->add_control(
            'icon_image',
            [
                'label' => __('Icon to display'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src()
                ]
            ]
        );

        $this->add_control(
			'content_color',
			[
				'label' => __( 'Text Color'),
				'type' => \Elementor\Controls_Manager::COLOR,
                'default' => 'black',
                'selectors' => [
					'{{WRAPPER}} .content-color' => 'color: {{VALUE}}',
				],
			]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'content_box_shadow',
				'label' => __( 'Box Shadow'),
				'selector' => '{{WRAPPER}} .content',
			]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'content_border',
				'label' => __( 'Border'),
				'selector' => '{{WRAPPER}} .content',
			]
        );
        $this->add_control(
			'border_radius',
			[
				'label' => __( 'Border Radius'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
			'content_background_color',
			[
				'label' => __( 'Background Color'),
				'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#white',
                'selectors' => [
					'{{WRAPPER}} .content-background-color' => 'background-color: {{VALUE}}',
				],
			]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'label' => __( 'Typography'),
				'selector' => '{{WRAPPER}} .content',
			]
		);

        $this->add_control(
            'content',
            [
                'label' => __('Content'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Write here your text')
            ]
        );

        $this->add_control(
			'entrance_animation_content',
			[
				'label' => __( 'Entrance Animation'),
				'type' => \Elementor\Controls_Manager::ANIMATION,
			]
		);
        $this->add_control(
            'button_name',
            [
                'label' => __('Butto name'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Button name')
            ]
        );

        $this->add_control(
			'show_button',
			[
				'label' => __( 'Show button'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show'),
				'label_off' => __( 'Hide'),
				'return_value' => 'yes',
				'default' => 'no',
			]
        );
        
        $this->add_control(
            'button_name',
            [
                'label' => __('Butto name'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Button name')
            ]
        );
        $this->add_control(
			'button_link',
			[
				'label' => __( 'Button link'),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __('Link to redirect'),
				'show_external' => true,
				'default' => [
					'url' => $_SERVER['SERVER_NAME'],
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);
        
        $this->end_controls_section();
    }

    // PHP Render
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $this->add_inline_editing_attributes('title', 'basic');
        $this->add_inline_editing_attributes('content', 'advanced');
        $this->add_inline_editing_attributes('button_name', 'basic');
        $this->add_render_attribute(
            'content',
            [
                'class' => ['card-text', 'content', 'content-color', 'pl-5', 'pt-5', 'pb-5', 'pr-4', 'content-background-color', '', 'wow',  $settings['entrance_animation_content']]
            ]
            );
        $this->add_render_attribute(
            'title',
            [
                'class' => ['title', 'title-color' , 'mb-0', 'mt-2']
            ]
            );
        $this->add_render_attribute(
            'image',
            [
                'src' => $settings['image']['url']
            ]
            );
        $this->add_render_attribute(
            'icon_image',
            [
                'src' => $settings['icon_image']['url']
            ]
            );
        $this->add_render_attribute(
            'button_name',
            [
                'href' => $settings['button_link']['url']
            ]
        );

        ?>

            <!-- Card -->
            <div class="image-left-text-right-wrapper">
                
                <!-- Card content -->
                <div class="text-content text-right-front">
                    <div class="image-behind-wrapper wow <?php echo $settings['entrance_animation_image'];?>">
                        <img class="image-left-behind" <?php echo $this->get_render_attribute_string('image') ?> alt="">
                    </div>
                    <!-- Title -->

                    <!-- Text -->
                    <div <?php echo $this->get_render_attribute_string('content') ?>>
                        <div class="icon-image-wrapper mb-4">
                            <img <?php echo $this->get_render_attribute_string('icon_image') ?> alt="">
                        </div>
                        <div <?php echo $this->get_render_attribute_string('title') ?> ><?php echo $settings['title']?></div>
                        <div class="mt-3">
                            <?php echo $settings['content']?>
                        </div>
                        <?php if($settings['show_button'] == 'yes'){ ?>
                        <a class="btn btn-rounded btn-outline-primary text-transfrom-initial btn-smaller waves-effect btn-size-fixed mt-4 mb-4" <?php echo $this->get_render_attribute_string('button_name') ?>>
                            <?php echo $settings['button_name']?>
                        </a>
                        <?php } ?>

                    </div>
                    <!-- Button -->

                </div>
            </div>
            

        <!-- Card -->

        <?php

    }

    // JS Render
    protected function _content_template()
    {
        ?>

<#
            view.addInlineEditingAttributes('title', 'basic');
            view.addInlineEditingAttributes('content', 'advanced');
            view.addRenderAttribute(
                'title',
                {
                    'class': ['title', 'title-color' ,'mb-0', 'mt-2']
                }
            );
            view.addRenderAttribute(
                'content',
                {
                    'class': ['card-text', 'content', 'content-color', 'p-4-5', 'content-background-color', settings.entrance_animation_content]
                }
            );
            
            view.addRenderAttribute(
                'image',
                {
                    'src': settings.image.url
                }
            );
            view.addRenderAttribute(
                'icon_image',
                {
                    'src': settings.icon_image.url
                }
            );
            view.addRenderAttribute(
                'button_name',
                {
                    'src': settings.button_link.url
                }
            );
            

        #>
        <div class="image-left-text-right-wrapper">
                
                <!-- Card content -->
                <div class="text-content text-right-front">
                    <div class="image-behind-wrapper mb-4 wow {{ settings.entrance_animation_image }}">
                        <img class="image-left-behind" {{{ view.getRenderAttributeString('image') }}} alt="">
                    </div>
                    <!-- Title -->

                    <!-- Text -->
                    <div {{{ view.getRenderAttributeString('content') }}}>
                        <div class="icon-image-wrapper mb-4">
                            <img {{{ view.getRenderAttributeString('icon_image') }}} alt="">
                        </div>
                        <div {{{ view.getRenderAttributeString('title') }}} >{{{ settings.title }}}</div>
                        <div class="mt-3" >
                            {{{ settings.content }}}
                        </div>
                        <#
                            if(settings.show_button == "yes"){
                        #>
                        <a class="btn btn-rounded btn-outline-primary text-transfrom-initial mt-4 mb-4 btn-smaller waves-effect btn-size-fixed" {{{ view.getRenderAttributeString('button_name') }}}>
                            {{{ settings.button_name }}}
                        </a>
                        <#
                            }
                        #>
                    </div>
                    <!-- Button -->

                </div>
            </div>
            


        <?php
    }
}
