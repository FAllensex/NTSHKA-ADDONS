<?php

// Initialize Namespace
namespace Elementor;
class ntshka_addons_card extends Widget_Base {

    public function get_name() {
        return  'ntshka-card-widget';
    }

    public function get_title() {
        return esc_html__( 'Ntshka card', 'ntshka-addons' );
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
        return 'eicon-info-box';
    }

    public function get_categories() {
        return [ 'ntshka-addons-category' ];
    }

    public function _register_controls() {

        $this->start_controls_section(
			'content_section',
			[
				'label' => __( 'General', 'Ntshka Addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

    $this->add_control(
			'card_title',
			[
				'label' => __( ' Card Main Title', 'ntshka-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Default title', 'ntshka-addons' ),
				'placeholder' => __( 'Type your title here', 'ntshka-addons' ),
			]
		);
    $this->add_control(
			'card_subtitle',
			[
				'label' => __( ' Card subtitle', 'ntshka-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Default subtitle ', 'ntshka-addons' ),
				'placeholder' => __( 'Type your subtitle here', 'ntshka-addons' ),
			]
		);
    $this->add_control(
			'card_description',
			[
				'label' => __( 'Description', 'ntshka-addons' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => __( ' Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad eum dolorum architecto obcaecati enim dicta praesentium, quam nobis! Neque ad aliquam facilis numquam. Veritatis, sit.', 'ntshka-addons' ),
				'placeholder' => __( 'Type your description here', 'ntshka-addons' ),
			]
		);
    $this->add_control(
			'card-image',
			[
				'label' => __( 'Choose Image', 'ntshka-addons' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src('https://images.pexels.com/photos/4107897/pexels-photo-4107897.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
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
		'card_color',
		[
			'label' => __( 'NTSHKA card Styling', 'ntshka-addons' ),
			'tab' => Controls_Manager::TAB_STYLE,
		]
		  
	);
    
    // COLOR
      $this->add_control(
        'headline_colora',
        [
            'label' => __( 'Card Color', 'ntshka-addons' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'scheme' => [
                'type' => \Elementor\Scheme_Color::get_type(),
                'value' => \Elementor\Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .description' => 'color: {{VALUE}}',
            ],
        ]
    );
    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'card_typography',
            'label' => __( 'Typography', 'ntshka-addons' ),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .blog-card ',
        ]
        
    );
    // ENTRANCE ANIMATION
    $this->add_control(
        'entrance_animation_headline',
        [
            'label' => __( 'Entrance Animation Card', 'ntshka_addons' ),
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
        'selector' => '{{WRAPPER}} .blog-card',
    ]
);
    $this->end_controls_section();
    }
    // Render the widget
    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
<div class="blog-card">
    <div class="meta">
      <div class="photo" style="background-image: url(<?php echo $settings['card-image']['url']; ?>)"></div>
    </div>
    <div class="description">
      <h1><?php echo $settings['card_title']; ?></h1>
      <h2><?php echo $settings['card_subtitle']; ?></h2>
      <p><?php echo $settings['card_description']; ?></p>
    </div>
  </div>
  
        <?php
    }

}
Plugin::instance()->widgets_manager->register_widget_type( new ntshka_addons_card() );