<?php

// Initialize Namespace
namespace Elementor;
class ntshka_addons_pricing extends Widget_Base {

    public function get_name() {
        return  'ntshka-pricing-widget';
    }

    public function get_title() {
        return esc_html__( 'Ntshka pricing', 'ntshka-addons' );
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
			'ntshka_pricing_content_section',
			[
				'label' => __( 'General', 'Ntshka Addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        $this->add_control(
            'ntshka_pricing_card_title',
            [
                'label' => __( 'Card Label', 'ntshka-addons' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Basic' , 'ntshka-addons' ),

            ]
        );
        $this->add_control(
			'ntshka_pricing_show_button',
			[
				'label' => __( 'Show Button', 'ntshka-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'ntshka-addons' ),
				'label_off' => __( 'Hide', 'ntshka-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        $this->add_control(
            'ntshka_pricing_price',
            [
                'label' => __( 'Price', 'ntshka-addons' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( '99.9$' , 'ntshka-addons' ),

            ]
        );
        $repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'ntshka_pricing_list_title', [
				'label' => __( 'Title', 'ntshka-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'List Title' , 'ntshka-addons' ),
				'label_block' => true,
			]
		);

		

		$repeater->add_control(
			'ntshka_pricing_list_color',
			[
				'label' => __( 'Color', 'ntashka-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}'
				],
			]
		);
		$this->add_control(
			'ntshka_pricing_list',
			[
				'label' => __( 'Repeater List', 'ntashka-addons' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'ntshka_pricing_list_title' => __( 'Title #1', 'ntashka-addons' ),
					],
					[
						'ntshka_pricing_list_title' => __( 'Title #2', 'ntashka-addons' ),
					],
				],
				'title_field' => '{{{ ntshka_pricing_list_title }}}',
			]
		);
        $this->add_control(
			'ntshka_pricing_button_text', [
				'label' => __( 'Title', 'ntshka-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'List Title' , 'ntshka-addons' ),
				'label_block' => true,
			]
		);
    $this->end_controls_section();
      


        // STYLE BEGINS
    $this->start_controls_section(
        'ntshka_pricing_style',
        [
            'label' => __( 'Pricing Styling', 'ntshka-addons' ),
            'tab' => Controls_Manager::TAB_STYLE,
        ]
        
    );
 // Background COLOR
    $this->add_control(
        'ntshka_pricing_bg_color',
        [
            'label' => __( 'Background Color', 'ntshka-addons' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'scheme' => [
                'type' => \Elementor\Scheme_Color::get_type(),
                'value' => \Elementor\Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .ntshka-pricing-card ' => 'background-color: {{VALUE}}',
            ],
        ]
    );
     //  FAQ Typography
     $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
          'name' => 'ntshka_pricing_main_typography',
          'label' => __( 'Typography', 'ntshka-addons' ),
          'scheme' => Scheme_Typography::TYPOGRAPHY_1,
          'selector' => '{{WRAPPER}} .ntshka-pricing-card li ',
      ]
  );
  // BTN COLOR
  $this->add_control(
    'ntshka_pricing_button_color',
    [
        'label' => __( ' Button Background Color', 'ntshka-addons' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'scheme' => [
            'type' => \Elementor\Scheme_Color::get_type(),
            'value' => \Elementor\Scheme_Color::COLOR_1,
        ],
        'selectors' => [
            '{{WRAPPER}} .ntshka-pricing-btn' => 'background: {{VALUE}}',
        ],
    ]
);
    $this->end_controls_section();
    }
    // Render the widget
    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>


    <div class="ntshka-pricing-card ntshka-pricing-shadow">
      <ul>
        <li class="ntshka-pricing-pack"><?php echo $settings['ntshka_pricing_card_title']; ?></li>
        <li id="basic" class="ntshka-pricing-price bottom-bar"><?php echo $settings['ntshka_pricing_price']?></li>
      <?php
      if ( $settings['ntshka_pricing_list'] ) {

        foreach (  $settings['ntshka_pricing_list'] as $item ) {
            echo '<li class="bottom-bar' . $item['_id'] . '">' . $item['ntshka_pricing_list_title'] . '</li>';
        }
    
    }
?>

        <?php
if ( 'yes' === $settings['ntshka_pricing_show_button'] ) {?>
<li><button class="ntshka-pricing-btn"><?php echo $settings['ntshka_pricing_button_text']; ?></button></li>
<?php
}
?>
      </ul>
    </div>
        <?php
    }

}
Plugin::instance()->widgets_manager->register_widget_type( new ntshka_addons_pricing() );