<?php

namespace MDBElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Repeater;

class FullscreenHamburgerMenu extends Widget_Base
{

    public function get_name()
    {
        return 'fullscreen_hamburger_menu';
    }

    public function get_title()
    {
        return __('Fullscreen Hamburger Menu');
    }

    public function get_icon()
    {
        return 'mdbe-icons mdbe-icons-hamburger';
    }

    public function get_categories()
    {
        return ['mdbe-widgets'];
    }

    protected function _register_controls()
    {
        
        $this->start_controls_section(
            'section_menu',
            [
                'label' => __('Menu Settings')
            ]
        );

        $menus = $this->get_available_menus();

        if ( ! empty( $menus ) ) {
			$this->add_control(
				'menu',
				[
					'label' => __( 'Menu', 'mdb_elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => $menus,
					'default' => array_keys( $menus )[0],
					'save_default' => true,
					'separator' => 'after',
					'description' => sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'mdb_elementor' ), admin_url( 'nav-menus.php' ) ),
				]
			);
		} else {
			$this->add_control(
				'menu',
				[
					'type' => \Elementor\Controls_Manager::RAW_HTML,
					'raw' => '<strong>' . __( 'There are no menus in your site.', 'mdb_elementor' ) . '</strong><br>' . sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'mdb_elementor' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
					'separator' => 'after',
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				]
			);
        }
        $this->add_control(
			'menu_background_color',
			[
				'label' => __( 'Colore sfondo', 'mdb_elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .main-menu' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .has-submenu.fhm-page .submenu' => 'background-color: {{VALUE}}'
				]
			]
        );
        $this->add_control(
			'elements_color',
			[
				'label' => __( 'Colore voci menu', 'mdb_elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
                    '{{WRAPPER}} .nav-link' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .nav-link:before' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .nav-link:before' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .nav-link:after' => 'color: {{VALUE}}',
					'{{WRAPPER}} .nav-link:after' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .fhm-page-back' => 'color: {{VALUE}}',
					'{{WRAPPER}} .open-submenu' => 'color: {{VALUE}}'
				]
			]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'elements_typography',
                'label' => __( 'Font voci menu', 'mdb_elementor' ),
				'selector' => '{{WRAPPER}} .main-menu ul .nav-item'
			]
        );
        $this->add_responsive_control(
			'elements_font_size_mobile',
			[
				'label' => __( 'Font size responsive', 'mdb_elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					]
                ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => 100,
					'unit' => '%',
				],
				'tablet_default' => [
					'size' => 80,
					'unit' => '%',
				],
				'mobile_default' => [
					'size' => 60,
					'unit' => '%',
				],
				'selectors' => [
					'{{WRAPPER}} .nav-link' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
        );

        $this->add_control(
            'elements_hover_effect',
            [
                'label' => __( 'Effetto Hover', 'mdb_elementor' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
					'no-effect' => __('No effect', 'mdb_elementor'),
					'underline-grow'  => __( 'Underline Grow', 'mdb_elementor' ),
					'highlight-grow-left' => __( 'Highlight Grow Left', 'mdb_elementor' ),
				],
                'default' => 'underline_grow',
                'save_default' => true,
                'separator' => 'after',
            ]
        );

        $this->add_responsive_control(
			'elements_spacing_between',
			[
				'label' => __( 'Spazio tra le voci', 'mdb_elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' , '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
                    ],
                    '%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .nav-item:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				]
			]
        );

        $this->add_control(
			'menu_horizontal_position',
			[
				'label' => __( 'Posizione orizzontale', 'mdb_elementor' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'mdb_elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'mdb_elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'mdb_elementor' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
				'toggle' => false,
			]
        );

        $this->add_control(
			'menu_vertical_position',
			[
				'label' => __( 'Posizione verticale', 'mdb_elementor' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'top' => [
						'title' => __( 'Top', 'mdb_elementor' ),
						'icon' => 'fas fa-arrow-up',
					],
					'middle' => [
						'title' => __( 'Middle', 'mdb_elementor' ),
						'icon' => 'fas fa-grip-lines',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'mdb_elementor' ),
						'icon' => 'fas fa-arrow-down',
					],
				],
				'default' => 'top',
				'toggle' => false,
			]
		);
		$this->add_control(
            'submenu_display_mode',
            [
                'label' => __( 'Modalità sottomenu', 'mdb_elementor' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
					'fhm-dropdown' => __('Dropdown', 'mdb_elementor'),
					'fhm-page'  => __( 'Scorrimento pagina', 'mdb_elementor' ),
				],
                'default' => 'fhm-dropdown',
                'save_default' => true,
                'separator' => 'after',
            ]
        );
        
        $this->add_control(
			'show_logo',
			[
				'label' => __( 'Mostra Logo', 'mdb_elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'mdb_elementor' ),
				'label_off' => __( 'Hide', 'mdb_elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
        );
        $this->add_control(
			'logo_icon',
			[
				'label' => __( 'Logo Icon', 'mdb_elementor' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
			]
		);
        
        $this->add_responsive_control(
			'logo_width',
			[
				'label' => __( 'Width', 'mdb_elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 30,
				],
				'selectors' => [
					'{{WRAPPER}} .logo' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);


        $this->end_controls_section();

        $this->start_controls_section(
            'section_hamburger_menu',
            [
                'label' => __('Hamburger Menu')
            ]
        );


        $this->add_control(
			'hamburger_menu_width',
			[
				'label' => __( 'Hamburger Width', 'mdb_elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 35,
				],
				'selectors' => [
					'{{WRAPPER}} .nav-button' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
        );

        $this->add_control(
			'hamburger_menu_label_text',
			[
				'label' => __( 'Testo menu label', 'mdb_elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Menu', 'mdb_elementor' ),
				'placeholder' => __( 'Type your title here', 'mdb_elementor' ),
			]
        );
        
        $this->add_control(
			'hr',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

        $this->start_controls_tabs(
			'hamburger_menu_style_tabs'
		);

		$this->start_controls_tab(
			'hamburger_menu_style_normal_tab',
			[
				'label' => __( 'Normal', 'mdb_elementor' ),
			]
		);
        $this->add_control(
			'hamburger_menu_color',
			[
				'label' => __( 'Colore Hamburger', 'mdb_elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
                    '{{WRAPPER}} .menu-label' => 'color: {{VALUE}}',
					'{{WRAPPER}} .nav-button #nav-icon3 span' => 'background-color: {{VALUE}}',
				]
			]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
			'hamburger_menu_style_active_tab',
			[
				'label' => __( 'Active', 'mdb_elementor' ),
			]
        );
        

        $this->add_control(
			'hamburger_menu_active_color',
			[
				'label' => __( 'Colore Hamburger Active', 'mdb_elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
                    '.hamburger-menu-{{ID}}-body {{WRAPPER}} .nav-button .menu-label' => 'color: {{VALUE}}',
					'.hamburger-menu-{{ID}}-body {{WRAPPER}} .nav-button #nav-icon3 span' => 'background-color: {{VALUE}}',
				]
			]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
			'hr-1',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

        $this->add_control(
			'show_menu_label',
			[
				'label' => __( 'Mostra menu Label', 'mdb_elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Mostra', 'mdb_elementor' ),
				'label_off' => __( 'Nascondi', 'mdb_elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'hamburger_menu_label_font',
				'label' => __( 'Font label menu', 'mdb_elementor' ),
				'selector' => '{{WRAPPER}} .menu-label'
			]
        );
        
        $this->add_control(
			'hamburger_menu_align',
			[
				'label' => __( 'Alignment', 'mdb_elementor' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'mdb_elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'mdb_elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'mdb_elementor' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
			]
        );
        
        $this->add_control(
			'hamburger_lines_height',
			[
				'label' => __( 'Altezza righe hamburger', 'mdb_elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 1,
				],
				'selectors' => [
					'{{WRAPPER}} .nav-button #nav-icon3 span' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
        );

        $this->add_control(
			'hamburger_lines_spacing',
			[
				'label' => __( 'Spacing righe hamburger', 'mdb_elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 12,
				],
				'selectors' => [
                    '{{WRAPPER}} .nav-button #nav-icon3 span:nth-child(2)' => 'top: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .nav-button #nav-icon3 span:nth-child(3)' => 'top: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .nav-button #nav-icon3 span:nth-child(4)' => 'top: calc({{SIZE}}{{UNIT}} * 2);',
				],
			]
        );
        

        $this->end_controls_section();

        $this->start_controls_section(
			'section_social_icon',
			[
				'label' => __( 'Social Icons', 'elementor' ),
			]
		);

		$repeater = new Repeater();

        $this->add_control(
			'show_social_icons',
			[
				'label' => __( 'Mostra Icone Social', 'mdb_elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'mdb_elementor' ),
				'label_off' => __( 'Hide', 'mdb_elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
        );

		$repeater->add_control(
			'social_icon',
			[
				'label' => __( 'Icon', 'elementor' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'social',
				'default' => [
					'value' => 'fab fa-wordpress',
					'library' => 'fa-brands',
				],
				'recommended' => [
					'fa-brands' => [
						'android',
						'apple',
						'behance',
						'bitbucket',
						'codepen',
						'delicious',
						'deviantart',
						'digg',
						'dribbble',
						'elementor',
						'facebook',
						'flickr',
						'foursquare',
						'free-code-camp',
						'github',
						'gitlab',
						'globe',
						'houzz',
						'instagram',
						'jsfiddle',
						'linkedin',
						'medium',
						'meetup',
						'mix',
						'mixcloud',
						'odnoklassniki',
						'pinterest',
						'product-hunt',
						'reddit',
						'shopping-cart',
						'skype',
						'slideshare',
						'snapchat',
						'soundcloud',
						'spotify',
						'stack-overflow',
						'steam',
						'telegram',
						'thumb-tack',
						'tripadvisor',
						'tumblr',
						'twitch',
						'twitter',
						'viber',
						'vimeo',
						'vk',
						'weibo',
						'weixin',
						'whatsapp',
						'wordpress',
						'xing',
						'yelp',
						'youtube',
						'500px',
					],
					'fa-solid' => [
						'envelope',
						'link',
						'rss',
					],
				],
			]
		);

		$repeater->add_control(
			'link',
			[
				'label' => __( 'Link', 'elementor' ),
				'type' => \Elementor\Controls_Manager::URL,
				'default' => [
					'is_external' => 'true',
				],
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'https://your-link.com', 'elementor' ),
			]
		);

		$repeater->add_control(
			'item_icon_color',
			[
				'label' => __( 'Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __( 'Official Color', 'elementor' ),
					'custom' => __( 'Custom', 'elementor' ),
				],
			]
		);

		$repeater->add_control(
			'item_icon_primary_color',
			[
				'label' => __( 'Primary Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'item_icon_color' => 'custom',
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.elementor-social-icon' => 'background-color: {{VALUE}};',
				],
			]
		);

		$repeater->add_control(
			'item_icon_secondary_color',
			[
				'label' => __( 'Secondary Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'item_icon_color' => 'custom',
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.elementor-social-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} {{CURRENT_ITEM}}.elementor-social-icon svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'social_icon_list',
			[
				'label' => __( 'Social Icons', 'elementor' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'social_icon' => [
							'value' => 'fab fa-facebook',
							'library' => 'fa-brands',
						],
					],
					[
						'social_icon' => [
							'value' => 'fab fa-twitter',
							'library' => 'fa-brands',
						],
					],
					[
						'social_icon' => [
							'value' => 'fab fa-youtube',
							'library' => 'fa-brands',
						],
					],
				],
				'title_field' => '<# var migrated = "undefined" !== typeof __fa4_migrated, social = ( "undefined" === typeof social ) ? false : social; #>{{{ elementor.helpers.getSocialNetworkNameFromIcon( social_icon, social, true, migrated, true ) }}}',
			]
		);

		$this->add_control(
			'shape',
			[
				'label' => __( 'Shape', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'rounded',
				'options' => [
					'rounded' => __( 'Rounded', 'elementor' ),
					'square' => __( 'Square', 'elementor' ),
					'circle' => __( 'Circle', 'elementor' ),
				],
				'prefix_class' => 'elementor-shape-',
			]
		);

		$this->add_responsive_control(
			'columns',
			[
				'label' => __( 'Columns', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '0',
				'options' => [
					'0' => __( 'Auto', 'elementor' ),
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
				],
				'prefix_class' => 'elementor-grid%s-',
				'selectors' => [
					'{{WRAPPER}}' => '--grid-template-columns: repeat({{VALUE}}, auto);',
				],
			]
		);

		$start = is_rtl() ? 'end' : 'start';
		$end = is_rtl() ? 'start' : 'end';

		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'elementor' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' => __( 'Left', 'elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'elementor' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'view',
			[
				'label' => __( 'View', 'elementor' ),
				'type' => \Elementor\Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_social_style',
			[
				'label' => __( 'Icon', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __( 'Official Color', 'elementor' ),
					'custom' => __( 'Custom', 'elementor' ),
				],
			]
		);

		$this->add_control(
			'icon_primary_color',
			[
				'label' => __( 'Primary Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'icon_color' => 'custom',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-social-icon' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_secondary_color',
			[
				'label' => __( 'Secondary Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'icon_color' => 'custom',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-social-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-social-icon svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Size', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--icon-size: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'icon_padding',
			[
				'label' => __( 'Padding', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .elementor-social-icon' => '--icon-padding: {{SIZE}}{{UNIT}}',
				],
				'default' => [
					'unit' => 'em',
				],
				'tablet_default' => [
					'unit' => 'em',
				],
				'mobile_default' => [
					'unit' => 'em',
				],
				'range' => [
					'em' => [
						'min' => 0,
						'max' => 5,
					],
				],
			]
		);

		$this->add_responsive_control(
			'icon_spacing',
			[
				'label' => __( 'Spacing', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'size' => 5,
				],
				'selectors' => [
					'{{WRAPPER}}' => '--grid-column-gap: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'row_gap',
			[
				'label' => __( 'Rows Gap', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}}' => '--grid-row-gap: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'image_border', // We know this mistake - TODO: 'icon_border' (for hover control condition also)
				'selector' => '{{WRAPPER}} .elementor-social-icon',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_social_hover',
			[
				'label' => __( 'Icon Hover', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'hover_primary_color',
			[
				'label' => __( 'Primary Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'icon_color' => 'custom',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-social-icon:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_secondary_color',
			[
				'label' => __( 'Secondary Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'icon_color' => 'custom',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-social-icon:hover i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-social-icon:hover svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_border_color',
			[
				'label' => __( 'Border Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'image_border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-social-icon:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => __( 'Hover Animation', 'elementor' ),
				'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_section();

    }

    private function get_available_menus() {
		$menus = wp_get_nav_menus();

		$options = [];

		foreach ( $menus as $menu ) {
			$options[ $menu->slug ] = $menu->name;
		}

		return $options;
    }
    private function searchForSubCategories($menuItems, $toCompare, $count, $widget, $settings)
	{
		$countFirst = 0;
		foreach ((array) $menuItems as $key => $menu_item) {

				if ($menu_item->menu_item_parent == $toCompare->ID) {
					
					if ($countFirst == 0) {
						?>
							<li class="nav-item has-submenu <?php echo $settings['submenu_display_mode']; ?>"><a class="nav-link <?php echo $settings['elements_hover_effect']; ?>" href="<?php echo $toCompare->url; ?>"><?php echo $toCompare->title; if($settings['submenu_display_mode'] == 'fhm-page'){ ?><i class="fas fa-chevron-right"></i><?php } ?></a>
						<?php
						echo "\t\t" . '<ul class="submenu">' ."\n";
						if($settings['submenu_display_mode'] == "fhm-page"){
							echo "\t\t\t" . '<li class="arrow-left fhm-page-back"></li>' ."\n";
						}
						$count++;
					}
					$countFirst++;
					$this->searchForSubCategories($menuItems, $menu_item, $count, $widget, $settings);
					if ($menu_item->ID != $menuItems[$key + 1]->menu_item_parent) {
						$itemAction = "onclick=\"closeFullscreenHamburgerMenu('" . 'hamburger-menu-' . $widget->get_id() . '-body' . "')\"";
						?>
						<li class="nav-item" <?php echo $itemAction; ?>><a class="nav-link <?php echo $settings['elements_hover_effect']; ?>" href="<?php echo $menu_item->url; ?>"><?php echo $menu_item->title; ?></a></li>
						<?php
					}
					if ($menuItems[$key + 1]->menu_item_parent != $toCompare->ID && $menuItems[$key + 1]->menu_item_parent < $toCompare->ID) {
						echo '</ul></li>';
					}
				}
			}
	}
    // PHP Render
    protected function render(){
        $available_menus = $this->get_available_menus();

		if ( ! $available_menus ) {
			return;
		}
        $settings = $this->get_settings_for_display();
        $menuItems = wp_get_nav_menu_items($settings['menu']);

        $navButtonClass = "";
        switch($settings['hamburger_menu_align']){
            case 'center':
                $navButtonClass = "mx-auto";
                break;
            case 'right':
                $navButtonClass = "ml-auto";
                break;
            case 'left':
                $navButtonClass = "mr-auto";
                break;
        }

        $menuHorizontalAlign = "";
        switch($settings['menu_horizontal_position']){
            case 'center':
                $menuHorizontalAlign = "margin-left: auto; margin-right: auto;";
                break;
            case 'right':
                $menuHorizontalAlign = "margin-left: auto;";
                break;
            case 'left':
                $menuHorizontalAlign = "margin-right: auto;";
                break;
        }

        $menuVerticalAlign = "";
        switch($settings['menu_vertical_position']){
            case 'middle':
                $menuVerticalAlign = "top: 50%; transform: translate(0, -50%); -webkit-transform: translate(0, -50%);";
                break;
            case 'top':
                $menuVerticalAlign = "top: 0;";
                break;
            case 'bottom':
                $menuVerticalAlign = "bottom: 0;";
                break;
        }

        if($settings['show_menu_label'] === 'yes'){
            $fontSpacing = $settings['hamburger_menu_label_font_font_size']['size'];
        }else{
            $fontSpacing = 0;
        }

        $buttonHeight = ((($settings['hamburger_lines_spacing']['size'] - $settings['hamburger_lines_height']['size']) * 2) +
                        ($settings['hamburger_lines_height']['size'] * 3) +
                        $fontSpacing) . 'px';
        ?>
        <a class="nav-button <?php echo $navButtonClass?> pt-2" onclick="toggleFullscreenHamburgerMenu('<?php echo 'hamburger-menu-' . $this->get_id() . '-body'; ?>'); return false;">
            <span id="nav-icon3">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </span>
            <?php if ( 'yes' === $settings['show_menu_label'] ) { ?>
                <span class="menu-label"><?php echo $settings['hamburger_menu_label_text']; ?></span>
            <?php } ?>
        </a>
        <div class="main-menu">
            <div class="logo mx-auto mt-3 mt-md-4 mt-lg-5">
                <?php if("yes" === $settings['show_logo']) {
                    if($settings['logo_icon']['value'] != ''){
                        \Elementor\Icons_Manager::render_icon( $settings['logo_icon'], [ 'aria-hidden' => 'true' ] );
                    }else{
                        echo get_custom_logo();
                    }
                } ?>
            </div>
			<div class="flex-center p-5 flex-column">
			<ul class="nav flex-column flex-nowrap overflow-scroll wow fadeInUp delay-1s">

<?php 
	$count = 0;
	$submenu = false;
	$parent_id = 0;
	$previous_item_has_submenu = false;
	
	
	foreach ((array) $menuItems as $key => $menu_item) {
		if ($menu_item->menu_item_parent == 0) {
			$parent_id = $menu_item->ID;
			$countSubMenus = 0;
			if ($menuItems[$count + 1]->menu_item_parent == $parent_id) {
				$this->searchForSubCategories($menuItems, $menu_item, $countSubMenus, $this, $settings);
			} else {
				$itemAction = "onclick=\"closeFullscreenHamburgerMenu('" . 'hamburger-menu-' . $this->get_id() . '-body' . "')\"";
			?>
				<li class="nav-item" <?php echo $itemAction; ?>><a class="nav-link <?php echo $settings['elements_hover_effect']; ?>" href="<?php echo $menu_item->url; ?>"><?php echo $menu_item->title; ?></a></li>
			<?php
			}
		}
		$count++;
	}

	
	





	/*foreach ((array) $menuItems as $key => $menu_item) {
		$title = $menu_item->title;
		$url = $menu_item->url;

		// check if it's a top-level item
		if ($menu_item->menu_item_parent == 0) {
			$parent_id = $menu_item->ID;
		   	// write the item but DON'T close the A or LI until we know if it has children!
		   	if ($menuItems[ $count + 1 ]->menu_item_parent == $parent_id )
			{
				$addClassItem = "has-submenu";
				$itemAction = "";
				?>
					<li class="nav-item <?php echo $addClassItem; ?>" <?php echo $itemAction; ?>><a class="nav-link <?php echo $settings['elements_hover_effect']; ?>" ><?php echo $menu_item->title; ?></a>
				<?php
			}else{
				$addClassItem = "";
				$itemAction = "onclick=\"closeFullscreenHamburgerMenu('" . 'hamburger-menu-' . $this->get_id() . '-body' . "')\"";
				?>
					<li class="nav-item <?php echo $addClassItem; ?>" <?php echo $itemAction; ?>><a class="nav-link <?php echo $settings['elements_hover_effect']; ?>" href="<?php echo $menu_item->url; ?>"><?php echo $menu_item->title; ?></a>
				<?php
			}
			
		} else {
			if ( !$submenu ) { // first item
				// add the dropdown arrow to the parent
				echo '' . "\n";
				// start the child list
				$submenu = true;
				$previous_item_has_submenu = true;
				echo "\t\t" . '<ul class="submenu">' ."\n";
		   }

		   if ($menuItems[ $count + 1 ]->menu_item_parent == $parent_id ){
				$parent_id = $menu_item->ID;
				$addClassItem = "has-submenu";
		   }
		   ?>
		   <li class="nav-item <?php echo $addClassItem;?>" onclick="closeFullscreenHamburgerMenu('<?php echo 'hamburger-menu-' . $this->get_id() . '-body'; ?>')"><a class="nav-link <?php echo $settings['elements_hover_effect']; ?>" href="<?php echo $menu_item->url; ?>"><?php echo $menu_item->title; ?></a></li>
		   <?php
		   
		   

			// if it's the last child, close the submenu code
			if ( $menuItems[ $count + 1 ]->menu_item_parent != $parent_id && $submenu ){
				echo "\t\t" . '</ul></li>' ."\n";
				$submenu = false;
			}
		}

		// close the parent (top-level) item
		if (empty($menuItems[$count + 1]) || $menuItems[ $count + 1 ]->menu_item_parent != $parent_id )
		{
		   if ($previous_item_has_submenu)
			{
				// the a link and list item were already closed
				$previous_item_has_submenu = false; //reset
			}
			else {
				// close a link and list item
				echo '</li>' . "\n";
			}
		}

		$count++;
	}*/
?>




</ul>
                <?php if("yes" === $settings['show_social_icons']) {
                        $fallback_defaults = [
                            'fa fa-facebook',
                            'fa fa-twitter',
                            'fa fa-google-plus',
                        ];

                        $class_animation = '';

                        if ( ! empty( $settings['hover_animation'] ) ) {
                            $class_animation = ' elementor-animation-' . $settings['hover_animation'];
                        }

                        $migration_allowed = \Elementor\Icons_Manager::is_migration_allowed();

                        ?>
                        <div class="elementor-social-icons-wrapper elementor-grid mt-3 mt-md-4">
                            <?php
                            foreach ( $settings['social_icon_list'] as $index => $item ) {
                                $migrated = isset( $item['__fa4_migrated']['social_icon'] );
                                $is_new = empty( $item['social'] ) && $migration_allowed;
                                $social = '';

                                // add old default
                                if ( empty( $item['social'] ) && ! $migration_allowed ) {
                                    $item['social'] = isset( $fallback_defaults[ $index ] ) ? $fallback_defaults[ $index ] : 'fa fa-wordpress';
                                }

                                if ( ! empty( $item['social'] ) ) {
                                    $social = str_replace( 'fa fa-', '', $item['social'] );
                                }

                                if ( ( $is_new || $migrated ) && 'svg' !== $item['social_icon']['library'] ) {
                                    $social = explode( ' ', $item['social_icon']['value'], 2 );
                                    if ( empty( $social[1] ) ) {
                                        $social = '';
                                    } else {
                                        $social = str_replace( 'fa-', '', $social[1] );
                                    }
                                }
                                if ( 'svg' === $item['social_icon']['library'] ) {
                                    $social = get_post_meta( $item['social_icon']['value']['id'], '_wp_attachment_image_alt', true );
                                }

                                $link_key = 'link_' . $index;

                                $this->add_render_attribute( $link_key, 'class', [
                                    'elementor-icon',
                                    'elementor-social-icon',
                                    'elementor-social-icon-' . $social . $class_animation,
                                    'elementor-repeater-item-' . $item['_id'],
                                ] );

                                $this->add_link_attributes( $link_key, $item['link'] );

                                ?>
                                <div class="elementor-grid-item">
                                    <a <?php echo $this->get_render_attribute_string( $link_key ); ?>>
                                        <span class="elementor-screen-only"><?php echo ucwords( $social ); ?></span>
                                        <?php
                                        if ( $is_new || $migrated ) {
                                            \Elementor\Icons_Manager::render_icon( $item['social_icon'] );
                                        } else { ?>
                                            <i class="<?php echo esc_attr( $item['social'] ); ?>"></i>
                                        <?php } ?>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                <?php } ?>
            </div>
        </div>
        <style>
        <?php echo '.elementor-element-' . $this->get_id(); ?> .main-menu {
            position: fixed;
            right: 0;
            left: 0;
            <?php echo $menuVerticalAlign; ?>
            <?php echo $menuHorizontalAlign; ?>
            width: 0%;
            height: 0%;
            overflow: hidden;
            opacity: 0;
            z-index: 100;
            visibility: hidden;
            transition: all 0.3s ease-in-out;
        }
        <?php echo '.hamburger-menu-' . $this->get_id() . '-body'; ?> <?php echo '.elementor-element-' . $this->get_id(); ?> .main-menu {
            width: 100%;
            height: 100%;
            opacity: 1;
            visibility: visible;
            transition: all 0.3s ease-in-out;
        }
        <?php echo '.hamburger-menu-' . $this->get_id() . '-body'; ?>{
            overflow: hidden;
        }

        <?php echo '.elementor-element-' . $this->get_id(); ?> .main-menu .nav li {
            opacity: 0;
            margin-bottom: 0;
            display: flex;
            justify-content: center;
        }
		<?php echo '.elementor-element-' . $this->get_id(); ?> .main-menu .nav-item{
			display: flex;
			flex-direction: row;
		}
		<?php echo '.elementor-element-' . $this->get_id(); ?> .main-menu .has-submenu.fhm-dropdown .submenu{
			padding: 0;
			max-height: 0;
			transition: all 0.5s ease;
			overflow: hidden;
		}
		<?php echo '.elementor-element-' . $this->get_id(); ?> .main-menu .has-submenu.fhm-dropdown .submenu.active{
			max-height: 1000px;
			transition: all 0.5s ease;
		}
		<?php echo '.elementor-element-' . $this->get_id(); ?> .main-menu .has-submenu{
			
		}
		<?php echo '.elementor-element-' . $this->get_id(); ?> .main-menu .has-submenu.fhm-page .submenu{
			padding: 0;
			position: absolute;
			display: none;
			top: 0;
			left: 0;
			bottom: 0;
			right: 0;
			z-index: 1;
			flex-direction: column;
			justify-content: center;
			padding: 3rem;
		}
		
		<?php echo '.elementor-element-' . $this->get_id(); ?> .main-menu .has-submenu.fhm-page .submenu.active{
			display: flex;
		}
		<?php echo '.elementor-element-' . $this->get_id(); ?> .main-menu .has-submenu.fhm-dropdown{
			flex-direction: column;
		}
		<?php echo '.elementor-element-' . $this->get_id(); ?> .main-menu .has-submenu.fhm-page{
			flex-direction: row;
		}
		<?php echo '.elementor-element-' . $this->get_id(); ?> .main-menu .has-submenu > .nav-link{
			
		}
		<?php echo '.elementor-element-' . $this->get_id(); ?> .main-menu .has-submenu > .nav-link:after{
			<?php if($settings['submenu_display_mode'] == "fhm-page"){ ?>
			display: none;
			<?php } ?>
			font-family: "Font Awesome 5 Free";
			font-weight: 900;
			-moz-osx-font-smoothing: grayscale;
			-webkit-font-smoothing: antialiased;
			font-style: normal;
			font-variant: normal;
			text-rendering: auto;
			line-height: 1;
			background: none;
			margin-left: 10px;
		}
		<?php echo '.elementor-element-' . $this->get_id(); ?> .main-menu .has-submenu.fhm-dropdown > .nav-link:after{
			content: "\f107";
		}
		<?php echo '.elementor-element-' . $this->get_id(); ?> .main-menu .has-submenu.fhm-page > .nav-link:after{
			content: "\f054";
		}
		<?php echo '.elementor-element-' . $this->get_id(); ?> .main-menu .has-submenu.fhm-dropdown > .nav-link.arrow:after{
			content: "\f106";
		}
		<?php echo '.elementor-element-' . $this->get_id(); ?> .main-menu .has-submenu.fhm-page > .nav-link.arrow:after{
			content: "\f054";
		}
		<?php echo '.elementor-element-' . $this->get_id(); ?> .main-menu .has-submenu.fhm-page > .nav-link > i{
			margin-left: 10px;
			font-size: smaller;
		}
		<?php echo '.elementor-element-' . $this->get_id(); ?> .main-menu .has-submenu.fhm-page > .submenu > .fhm-page-back{
			position: absolute;
			top: 20px;
			left: 20px;
		}
		<?php echo '.elementor-element-' . $this->get_id(); ?> .main-menu ul{
		}
		<?php echo '.elementor-element-' . $this->get_id(); ?> .main-menu ul.hidden{
			width: 0;
		}
        <?php echo '.elementor-element-' . $this->get_id(); ?> .main-menu .nav-link{
            display: inline-block;
            text-align: center;
        }
		<?php echo '.elementor-element-' . $this->get_id(); ?> .main-menu .has-submenu.fhm-page > .submenu > .fhm-page-back:after{
			content: "\f053";
			font-family: "Font Awesome 5 Free";
			font-weight: 900;
			-moz-osx-font-smoothing: grayscale;
			-webkit-font-smoothing: antialiased;
			display: inline-block;
			font-style: normal;
			font-variant: normal;
			text-rendering: auto;
			line-height: 1;
			background: none;
			margin-left: 10px;
		}
        <?php echo '.elementor-element-' . $this->get_id(); ?> .main-menu .logo{
            top: 0;
            left: 0;
            right: 0;
            position: absolute;
        }

        <?php echo '.hamburger-menu-' . $this->get_id() . '-body'; ?> <?php echo '.elementor-element-' . $this->get_id(); ?> .main-menu .nav li {
            opacity: 1;
        }

        <?php echo '.elementor-element-' . $this->get_id(); ?> .nav-button {
            position: relative;
            display: block;
            z-index: 1111;
        }

        <?php echo '.elementor-element-' . $this->get_id(); ?> .nav-button #nav-icon3 {
            width: 100%;
            height: <?php echo $buttonHeight; ?>;
            display: inline-block;
            position: relative;
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
            -webkit-transition: .5s ease-in-out;
            -moz-transition: .5s ease-in-out;
            -o-transition: .5s ease-in-out;
            transition: .5s ease-in-out;
            cursor: pointer;
        }

        <?php echo '.elementor-element-' . $this->get_id(); ?> .nav-button #nav-icon3 span {
            display: block;
            position: absolute;
            width: 100%;
            border-radius: 9px;
            opacity: 1;
            left: 0;
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
            -webkit-transition: .25s ease-in-out;
            -moz-transition: .25s ease-in-out;
            -o-transition: .25s ease-in-out;
            transition: .25s ease-in-out
        }
        <?php echo '.elementor-element-' . $this->get_id(); ?> .nav-button #nav-icon3 span:nth-child(4){
            top: <?php echo ($settings['hamburger_lines_spacing']['size'] * 2) . $settings['hamburger_lines_spacing']['unit'] ?>
        }

        <?php echo '.hamburger-menu-' . $this->get_id() . '-body'; ?> <?php echo '.elementor-element-' . $this->get_id(); ?> #nav-icon3 span:nth-child(1) {
            top: 9px;
            width: 0;
            left: 50%;
        }

        <?php echo '.elementor-element-' . $this->get_id(); ?> .nav-button > span:nth-child(2){
            bottom: 0px;
            position: absolute;
            text-align: center;
            left: 0;
            right: 0;
        }

        <?php echo '.hamburger-menu-' . $this->get_id() . '-body'; ?> <?php echo '.elementor-element-' . $this->get_id(); ?> #nav-icon3 span:nth-child(2) {
            -webkit-transform: rotate(45deg);
            -moz-transform: rotate(45deg);
            -o-transform: rotate(45deg);
            transform: rotate(45deg);
        }

        <?php echo '.hamburger-menu-' . $this->get_id() . '-body'; ?> <?php echo '.elementor-element-' . $this->get_id(); ?> #nav-icon3 span:nth-child(3) {
            -webkit-transform: rotate(-45deg);
            -moz-transform: rotate(-45deg);
            -o-transform: rotate(-45deg);
            transform: rotate(-45deg);
        }

        <?php echo '.hamburger-menu-' . $this->get_id() . '-body'; ?> <?php echo '.elementor-element-' . $this->get_id(); ?> #nav-icon3 span:nth-child(4) {
            top: 9px;
            width: 0;
            left: 50%;
        }
        <?php echo '.hamburger-menu-' . $this->get_id() . '-body'; ?> <?php echo '.elementor-element-' . $this->get_id(); ?> .nav-button > span:nth-child(2){
            color: #767575;
        }
        <?php echo '.hamburger-menu-' . $this->get_id() . '-body'; ?> <?php echo '.elementor-element-' . $this->get_id(); ?> .nav-button{
            visibility: visible;
        }
        <?php echo '.hamburger-menu-' . $this->get_id() . '-body'; ?> <?php echo '.elementor-element-' . $this->get_id(); ?> #nav-icon3 span{
            background-color: #767575;
        }
        <?php echo '.elementor-element-' . $this->get_id(); ?> .flex-center {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: center;
            -webkit-justify-content: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -webkit-align-items: center;
            -ms-flex-align: center;
            align-items: center;
            height: 100%;
        }
        </style>
		<script>
			jQuery("<?php echo '.elementor-element-' . $this->get_id(); ?> .has-submenu.fhm-dropdown > a").on('click', function(e){
				e.preventDefault();
				console.log(event.target.nodeName);
				let submenu = jQuery(this).parent().children('.submenu').first();
				if($(submenu).hasClass('active')){
					$(submenu).removeClass('active');
					jQuery(this).removeClass('arrow');
				}else{
					$(submenu).addClass('active');
					jQuery(this).addClass('arrow');
				}
			});
			jQuery("<?php echo '.elementor-element-' . $this->get_id(); ?> .has-submenu.fhm-page > .nav-link > i").on('click', function(e){
				if(e.target.nodeName == "I"){
					let submenu = jQuery(this).parent().parent().children('.submenu').first();
					let parent = jQuery(submenu).parent().parent('ul');

					$(submenu).css("display", "flex").hide().fadeIn(400);
				}
				e.preventDefault();

			});
			jQuery("<?php echo '.elementor-element-' . $this->get_id(); ?> .has-submenu.fhm-page > .submenu > .fhm-page-back").on('click', function(){
				let submenu = $(this).parent('.submenu').first();
				let parent = $(submenu).parent().parent('ul');
				
				$(submenu).fadeOut(400);
				
			});
			jQuery("<?php echo '.elementor-element-' . $this->get_id(); ?> > .elementor-widget-container > .nav-button").on('click', function(){
				if($(this).next('.main-menu').find('.fhm-page').length > 0){
					$('.has-submenu.fhm-page > .submenu').fadeOut(300);
				}
			});
		</script>
        <?php
    }
}
