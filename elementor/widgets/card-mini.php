<?php

namespace MDBElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class CardMini extends Widget_Base
{

    public function get_name()
    {
        return 'card_mini';
    }

    public function get_title()
    {
        return __('Mini Card');
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
            'section_icon',
            [
                'label' => __('Icon')
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => __('Icon'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src()
                ]
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
			'content_color',
			[
				'label' => __( 'Text Color'),
				'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#fefefe',
                'selectors' => [
					'{{WRAPPER}} .content-color' => 'color: {{VALUE}}',
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
                'type' => Controls_Manager::TEXT,
                'default' => __('Write here your text')
            ]
        );

        $this->end_controls_section();
    }

    // PHP Render
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $this->add_inline_editing_attributes('title', 'basic');
        $this->add_inline_editing_attributes('content', 'basic');
        $this->add_render_attribute(
            'title',
            [
                'class' => ['title', 'title-color']
            ]
            );
        
        $this->add_render_attribute(
            'content',
            [
                'class' => ['content', 'content-color']
            ]
            );
        $this->add_render_attribute(
            'icon',
            [
                'src' => $settings['icon']['url']
            ]
        );
?>

        <!-- Card -->

            <!-- Card content -->
            <div class="text-center card-mini  d-flex align-items-center">
                <div class="icon">
                    <img <?php echo $this->get_render_attribute_string('icon') ?>  alt="">
                </div>
                <div class="text text-left">
                    <!-- Title -->
                    <div <?php echo $this->get_render_attribute_string('title') ?>><?php echo $settings['title']?></div>
                    <!-- Text -->
                    <div <?php echo $this->get_render_attribute_string('content') ?>><?php echo $settings['content']?></div>
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
                    'class': [ 'title', 'title-color']
                }
            );
            view.addRenderAttribute(
                'content',
                {
                    'class': [ 'content', 'content-color']
                }
            );
            view.addRenderAttribute(
                'icon',
                {
                    'src': settings.icon.url
                }
            );
            

        #>
            <!-- Card content -->
            <div class="text-center card-mini d-flex align-items-center">
                <div class="icon">
                    <img <?php echo $this->get_render_attribute_string('icon') ?>  alt="">
                </div>

                <div class="text text-left">
                    <!-- Title -->
                    <div {{{ view.getRenderAttributeString('title') }}}>{{{ settings.title }}}</div>

                    <!-- Text -->
                    <div {{{ view.getRenderAttributeString('content') }}}>{{{ settings.content }}}</div>
                    <!-- Button -->
                </div>

            </div>

        <!-- Card -->

        <?php
    }
}
