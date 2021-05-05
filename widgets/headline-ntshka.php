<?php

// Initialize Namespace
namespace Elementor;
class ntshka_addons_headline extends Widget_Base {

    public function get_name() {
        return  'ntshka-headline-widget';
    }

    public function get_title() {
        return esc_html__( 'Ntshka Headline', 'ntshka-addons' );
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
        return ' eicon-animated-headline';
    }

    public function get_categories() {
        return [ 'ntshka-addons-category' ];
    }

    public function _register_controls() {
        // Section Starts
        $this->start_controls_section(
			'ntshk_section_title',
			[
				'label' => __( 'General', 'ntshka-addons' ),
			]
		);
        // TEXT
        $this->add_control(
			'ntshk_text_title',
			[
				'label' => __( 'Title', 'ntshka-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'NTSHKA ADDONS', 'ntshka-addons' ),
				'placeholder' => __( 'Type your title here', 'ntshka-addons' ),
			]
		);
        // ALIGNMENT
        $this->add_responsive_control(
			'ntshk_align',
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
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
			]
		);
        
		$this->add_control(
			'ntshka_typing',
			[
				'label' => __( 'Typing Effect', 'ntshka-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'ntshka-addons' ),
				'label_off' => __( 'Hide', 'ntshka-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        $this->end_controls_section();
        // STYLE TAB BEGINs
        
       $this->start_controls_section(
           'ntshka_headline_color',
           [
               'label' => __( 'Headline Styling', 'ntshka-addons' ),
               'tab' => Controls_Manager::TAB_STYLE,
           ]
           
       );
       // Headline Color
       $this->add_control(
           'ntshka_headline_colora',
           [
               'label' => __( 'Headline Color', 'ntshka-addons' ),
               'type' => \Elementor\Controls_Manager::COLOR,
               'scheme' => [
                   'type' => \Elementor\Scheme_Color::get_type(),
                   'value' => \Elementor\Scheme_Color::COLOR_1,
               ],
               'selectors' => [
                   '{{WRAPPER}} .ntsh-title' => 'color: {{VALUE}}',
               ],
           ]
       );
       
    
       // TEXT HOVER 
       $this->add_control(
           'ntshka_headline_text_hover',
           [
               'label' => __( 'headline Text Hover', 'ntshka-addons' ),
               'type' => \Elementor\Controls_Manager::COLOR,
               'scheme' => [
                   'type' => \Elementor\Scheme_Color::get_type(),
                   'value' => \Elementor\Scheme_Color::COLOR_1,
               ],
               'selectors' => [
                   '{{WRAPPER}} .ntsh-title:hover ' => 'color: {{VALUE}}',
               ],
           ]
       );
       // headline Typography
       $this->add_group_control(
           \Elementor\Group_Control_Typography::get_type(),
           [
               'name' => 'ntshka_headline_typography',
               'label' => __( 'Typography', 'ntshka-addons' ),
               'scheme' => Scheme_Typography::TYPOGRAPHY_1,
               'selector' => '{{WRAPPER}} .ntsh-title ',
           ]
       );
           // BOX SHADOW
           $this->add_group_control(
               \Elementor\Group_Control_Box_Shadow::get_type(),
               [
                   'name' => 'ntshka_box_shadow_headline',
                   'label' => __( 'Box Shadow', 'ntshka-addons' ),
                   'selector' => '{{WRAPPER}} .ntsh-title',
               ]
           );
       // ENTRANCE ANIMATION
       $this->add_control(
           'ntshka_entrance_animation_headline',
           [
               'label' => __( 'Entrance Animation Headline', 'ntshka_addons' ),
               'type' => \Elementor\Controls_Manager::ANIMATION,
               'prefix_class' => 'animated ',
           ]
       );
   
       $this->end_controls_section();
    }
    // Render the widget
    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <?php
        if ( 'yes' === $settings['ntshka_typing'] ) {
            echo "<h2 class='ntsh-title' id='ntshk-typing'>" . $settings['ntshk_text_title'] . "</h2>"; 
        }else{
            echo "<h2 class='ntsh-title'>" . $settings['ntshk_text_title'] . "</h2>"; 
        }
        
        ?>
        <?php
    }

}
Plugin::instance()->widgets_manager->register_widget_type( new ntshka_addons_headline() );