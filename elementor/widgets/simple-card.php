<?php

namespace MDBElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class SimpleCard extends Widget_Base
{

    public function get_name()
    {
        return 'simple_card';
    }

    public function get_title()
    {
        return __('Simple Card');
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
                'label' => __('Lateral icon')
            ]
        );
        $this->add_control(
            'icon',
            [
                'label' => __('Icon to display'),
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
                'label' => __('Text Color'),
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
                'label' => __('Typography'),
                'selector' => '{{WRAPPER}} .title',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_subtitle',
            [
                'label' => __('Subtitle')
            ]
        );


        $this->add_control(
            'subtitle',
            [
                'label' => __('Subtitle'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Subtitle')
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => __('Text Color'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#fefefe',
                'selectors' => [
                    '{{WRAPPER}} .subtitle-color' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_typography',
                'label' => __('Typography'),
                'selector' => '{{WRAPPER}} .subtitle',
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
                'label' => __('Text Color'),
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
                'label' => __('Typography'),
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

        $this->end_controls_section();


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

        $this->end_controls_section();
    }

    // PHP Render
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $this->add_inline_editing_attributes('title', 'basic');
        $this->add_inline_editing_attributes('subtitle', 'basic');
        $this->add_inline_editing_attributes('content', 'advanced');
        $this->add_render_attribute(
            'title',
            [
                'class' => ['card-title', 'title', 'title-color', 'mb-0']
            ]
        );
        $this->add_render_attribute(
            'subtitle',
            [
                'class' => ['subtitle', 'subtitle-color']
            ]
        );
        $this->add_render_attribute(
            'content',
            [
                'class' => ['card-text', 'content', 'content-color', 'mt-3']
            ]
        );

        $this->add_render_attribute(
            'image',
            [
                'src' => $settings['image']['url']
            ]
            );
        $this->add_render_attribute(
            'icon',
            [
                'src' => $settings['icon']['url']
            ]
        )
?>

        <!-- Card -->

        <img class="card-img-top" <?php echo $this->get_render_attribute_string('image') ?> alt="">
        <!-- Card content -->
        <div class="card-body py-5">

            <div class="row no-gutters">
                <div class="col-2">
                    <img <?php echo $this->get_render_attribute_string('icon') ?> alt="">
                </div>
                <div class="col-10">
                    <!-- Title -->
                    <h4 <?php echo $this->get_render_attribute_string('title') ?>><?php echo $settings['title'] ?></h4>
                    <div <?php echo $this->get_render_attribute_string('subtitle') ?>><?php echo $settings['subtitle'] ?></div>

                    <!-- Text -->
                    <div <?php echo $this->get_render_attribute_string('content') ?>><?php echo $settings['content'] ?></div>
                    <!-- Button -->
                </div>
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
        view.addInlineEditingAttributes('title', 'basic' );
        view.addInlineEditingAttributes('subtitle', 'basic' );
        view.addInlineEditingAttributes('content', 'advanced' );
        view.addRenderAttribute( 'title' , { 'class' : [ 'title' , 'title-color' , 'mb-0' ] } );
        view.addRenderAttribute( 'subtitle' , { 'class' : [ 'subtitle' , 'subtitle-color' ] } );
        view.addRenderAttribute( 'content' , { 'class' : [ 'card-text' , 'content' , 'content-color' , 'mt-3' ] } );
        view.addRenderAttribute( 'image' , { 'src' : settings.image.url } );
        view.addRenderAttribute( 'icon' , { 'src' : settings.icon.url } );
        #>
            <img class="card-img-top" {{{ view.getRenderAttributeString('image') }}} alt="Card image cap">
            <!-- Card content -->
            <div class="card-body py-5">

                <div class="row no-gutters">
                    <div class="col-2">
                        <img {{{ view.getRenderAttributeString('image') }}} alt="">
                    </div>
                    <div class="col-10">
                        <!-- Title -->
                        <h4 {{{ view.getRenderAttributeString('title') }}}>{{{ settings.title }}}</h4>
                        <div {{{ view.getRenderAttributeString('subtitle') }}}>{{{ settings.subtitle }}}</div>

                        <!-- Text -->
                        <div {{{ view.getRenderAttributeString('content') }}}>{{{ settings.content }}}</div>
                        <!-- Button -->
                    </div>
                </div>

            </div>

            <!-- Card -->

    <?php
    }
}
