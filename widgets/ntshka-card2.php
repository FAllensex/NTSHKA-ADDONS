<?php
// Initialize Namespace
namespace Elementor;
class ntshka_addons_card2 extends Widget_Base {

    public function get_name() {
        return  'ntshka-card2-widget';
    }

    public function get_title() {
        return esc_html__( 'Ntshka card2', 'ntshka-addons' );
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
        return 'eicon-price-table';
    }

    public function get_categories() {
        return [ 'ntshka-addons-category' ];
    }

    public function _register_controls() {

        $this->start_controls_section(
			'ntshka_card2_content_section',
			[
				'label' => __( 'General', 'Ntshka Addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        $this->add_control(
			'ntshka_card2_title',
			[
				'label' => __( ' Card Title', 'ntshka-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'NTSHKA ADDONS', 'ntshka-addons' ),
				'placeholder' => __( 'Type your title here', 'ntshka-addons' ),
			]
		);
        $this->add_control(
			'ntshka_card2_sub',
			[
				'label' => __( ' Card SubTitle', 'ntshka-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'NTSHKA ADDONS', 'ntshka-addons' ),
				'placeholder' => __( 'Type your Subtitle here', 'ntshka-addons' ),
			]
		);
        $this->add_control(
			'ntshka_card2_desc',
			[
				'label' => __( ' Card Description', 'ntshka-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'NTSHKA ADDONS', 'ntshka-addons' ),
				'placeholder' => __( 'Type your Description here', 'ntshka-addons' ),
                'default' => __(' New York, the largest city in the U.S., is an architectural marvel with plenty of historic monuments, magnificent buildings and countless dazzling skyscrapers.','ntshka-addons')
			]
		);
        $this->add_control(
			'ntshka_image_card2',
			[
				'label' => __( 'Choose Image', 'ntshka-addons' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src('https://images.pexels.com/photos/2123337/pexels-photo-2123337.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
				],
			]
		);
    $this->end_controls_section();

    // =================STYLYNG  TAB BEGINS ============================
    $this->start_controls_section(
		'ntshka_card2_tab',
		[
			'label' => __( 'NTSHKA Card2 Styling', 'ntshka-addons' ),
			'tab' => Controls_Manager::TAB_STYLE,
		]
		  

	);
     // BOX SHADOW
     $this->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'ntshka_box_shadow_card2',
            'label' => __( 'Box Shadow', 'ntshka-addons' ),
            'selector' => '{{WRAPPER}} .ntshka-card2-column',
        ]
    );
    // COLOR
    $this->add_control(
        'ntshka_card2_title_color',
        [
            'label' => __( 'Title Color', 'ntshka-addons' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'scheme' => [
                'type' => \Elementor\Scheme_Color::get_type(),
                'value' => \Elementor\Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .ntshka-card2-title ' => 'color: {{VALUE}}',
            ],
        ]
    );
     // SubTitle COLOR
     $this->add_control(
        'ntshka_card2_subtitle_color',
        [
            'label' => __( 'Sub Title Color', 'ntshka-addons' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'scheme' => [
                'type' => \Elementor\Scheme_Color::get_type(),
                'value' => \Elementor\Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .ntshka-card2-sub_title' => 'color: {{VALUE}}',
            ],
        ]
    );
    // Description COLOR
    $this->add_control(
        'ntshka_card2_description_color',
        [
            'label' => __( 'Description Color', 'ntshka-addons' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'scheme' => [
                'type' => \Elementor\Scheme_Color::get_type(),
                'value' => \Elementor\Scheme_Color::COLOR_2,
            ],
            'selectors' => [
                '{{WRAPPER}} .ntshka-card2-description' => 'color: {{VALUE}}',
            ],
        ]
    );
      //  MAIN headline Typography
      $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'ntshka_card2_main_typography',
            'label' => __( ' Headline Typography', 'ntshka-addons' ),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .ntshka-card2-title ',
        ]
    );
         // SUB headline Typography
         $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'ntshka_card2_sub_headline_typography',
                'label' => __( 'Subheadline Typography', 'ntshka-addons' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .ntshka-card2-sub_title ',
            ]
        );
             // DESCRIPTION Typography
      $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'ntshka_card2_desc_headline_typography',
            'label' => __( ' Description Typography', 'ntshka-addons' ),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .ntshka-card2-description ',
        ]
    );
    $this->end_controls_section();
    }
    // Render the widget
    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
    <?php
    echo '<div class="ntshka-card2-column">';
    echo'<div class="ntshka-card2-post-module">';
    echo '<div class="ntshka-card2-thumbnail">';
    echo  '<img src="' . $settings['ntshka_image_card2']['url'] .'" />';
    echo  '</div>';
    echo  '<div class="ntshka-card2-post-content">';
    echo  '<h1 class="ntshka-card2-title">'.  $settings["ntshka_card2_title"] . '</h1>';
    echo  '<h2 class="ntshka-card2-sub_title">'.  $settings['ntshka_card2_sub'] . '</h2>';
    echo  '<p class="ntshka-card2-description">'. $settings['ntshka_card2_desc'] . '</p>';
    echo  '</div>';
    echo  '</div>';
    echo  '</div>';
    ?>
        <?php
    }

}
Plugin::instance()->widgets_manager->register_widget_type( new ntshka_addons_card2() );
