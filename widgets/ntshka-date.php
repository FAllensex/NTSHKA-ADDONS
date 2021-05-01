<?php

// Initialize Namespace
namespace Elementor;
class ntshka_addons_date extends Widget_Base {

    public function get_name() {
        return  'ntshka-date-widget';
    }

    public function get_title() {
        return esc_html__( 'Ntshka date', 'ntshka-addons' );
    }

    public function get_script_depends() {
        return [
            'ntshka-script'
        ];
    }
    public function get_style_depends() {
        return [
            'ntshka-style'
        ];
    }
    public function get_icon() {
        return 'eicon-date';
    }

    public function get_categories() {
        return [ 'ntshka-addons-category' ];
    }

    public function _register_controls() {

        $this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'Ntshka Addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        
		$this->add_control(
			'date_picker',
			[
				'label' => __( 'Options For date ', 'ntshka-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'l jS  F Y',
				'options' => [
					'l jS  F Y '  => __( 'Saturday 24th April 2021', 'ntshka-addons' ),
					'l' => __( 'Week Day', 'ntshka-addons' ),
					'l \t\h\e jS' => __( 'Week day and Date', 'ntshka-addons' ),
				],
			]
		);
		$this->end_controls_section();
            /**
             *
             * STYLE TAB STARTS
             *
             */
	$this->start_controls_section(
		'date_color',
		[
			'label' => __( 'NTSHKA Styling', 'ntshka-addons' ),
			'tab' => Controls_Manager::TAB_STYLE,
		]
		  
	);
    $this->add_responsive_control(
        'date_align',
        [
            'label' => __( 'Alignment', 'ntshka-addons' ),
            'type' => Controls_Manager::CHOOSE,
            'options' => [
                'left' => [
                    'title' => __( 'Left', 'ntshka-addons' ),
                    'icon' => 'eicon-text-align-left',
                ],
                'center' => [
                    'title' => __( 'Center', 'ntshka-addons' ),
                    'icon' => 'eicon-text-align-center',
                ],
                'right' => [
                    'title' => __( 'Right', 'ntshka-addons' ),
                    'icon' => 'eicon-text-align-right',
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .date' => 'text-align: {{VALUE}};',
            ],
        ]
    );
    // COLOR
      $this->add_control(
        'headline_colora',
        [
            'label' => __( 'Date Color', 'ntshka-addons' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'scheme' => [
                'type' => \Elementor\Scheme_Color::get_type(),
                'value' => \Elementor\Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .date' => 'color: {{VALUE}}',
            ],
        ]
    );
    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'date_typography',
            'label' => __( 'Typography', 'ntshka-addons' ),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .date ',
        ]
        
    );
    // ENTRANCE ANIMATION
    $this->add_control(
        'entrance_animation_headline',
        [
            'label' => __( 'Entrance Animation Headline', 'ntshka_addons' ),
            'type' => \Elementor\Controls_Manager::ANIMATION,
            'prefix_class' => 'animated ',
        ]
    );
    
// BOX SHADOW
$this->add_group_control(
    \Elementor\Group_Control_Box_Shadow::get_type(),
    [
        'name' => 'box_shadow_headline',
        'label' => __( 'Box Shadow', 'ntshka-addons' ),
        'selector' => '{{WRAPPER}} .date',
    ]
);
    $this->end_controls_section();
    }
    // Render the widget
    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
       
       <h3 class="date"><?php echo date($settings['date_picker']); ?></h3>
        <?php
    }

}
Plugin::instance()->widgets_manager->register_widget_type( new ntshka_addons_date() );